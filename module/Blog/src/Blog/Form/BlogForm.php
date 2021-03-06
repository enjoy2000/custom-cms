<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/1/15
 * Time: 10:56 AM.
 */
namespace Blog\Form;

use Application\Helper\Util;
use Blog\Entity\Blog;
use Zend\Filter;
use Zend\Form\Element;
use Zend\Form\Form as ZendForm;
use Zend\InputFilter;
use Zend\Validator;

class BlogForm extends ZendForm
{
    public function __construct(\Application\Controller\AbstractActionController $controller, $name = null)
    {
        // we want to ignore the name passed
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form form-horizontal');
        $this->setAttribute('id', 'blogForm');
        $this->getInputFilter();

        $this->add([
            'name'  => 'id',
            'type'  => 'hidden',
        ]);

        // get list options locale
        $localeEntity = $controller->getEntityManager()->getRepository('Blog\Entity\Locale')->findAll();
        $locales = [null => 'Please choose'];

        /** @var \Blog\Entity\Locale $locale */
        foreach ($localeEntity as $locale) {
            $locales[$locale->getId()] = $locale->getName();
        }

        $this->add([
            'type'       => 'Zend\Form\Element\Select',
            'name'       => 'locale',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
                'id'       => 'select-locale',
            ],
            'options' => [
                'label'         => 'Select language',
                'value_options' => $locales,
            ],
        ]);

        $this->add([
            'type'       => 'Zend\Form\Element\Select',
            'name'       => 'categories',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
                'id'       => 'select-category',
                'multiple' => 'multiple',
            ],
            'options' => [
                'disable_inarray_validator' => true, // <-- disable
                'label'                     => 'Select Categories',
                'value_options'             => [
                    null => 'Please select language first',
                ],
            ],
        ]);

        $this->add([
            'type'       => 'Zend\Form\Element\Text',
            'name'       => 'title',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
            ],
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name'    => 'urlKey',
            'options' => [
                'label' => 'Url key',
            ],
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => false,
            ],
            'type'  => 'Text',
        ]);

        $this->add([
            'type'       => 'Zend\Form\Element\Select',
            'name'       => 'published',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
            ],
            'options' => [
                'label'         => 'Published',
                'value_options' => [
                    '1' => 'Active',
                    '0' => 'Inactive',
                ],
            ],
        ]);

        // File Input
        $file = new Element\File('photo');
        $file->setLabel('Photo')
            ->setAttribute('class', 'form-control')
            ->setAttribute('id', 'photo');
        $this->add($file);

        $this->add([
            'type'    => 'Zend\Form\Element\Textarea',
            'name'    => 'shortContent',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'id'       => 'shortContent',
                'class'    => 'form-control col-xs-7',
                'required' => true,
            ],
        ]);
        $this->add([
            'type'    => 'Zend\Form\Element\Textarea',
            'name'    => 'content',
            'options' => [
                'label' => 'Content',
            ],
            'attributes' => [
                'id'       => 'blog-content',
                'class'    => 'form-control summernote',
                'required' => true,
            ],
        ]);
        $this->add([
            'type'    => 'Zend\Form\Element\Textarea',
            'name'    => 'metaDescription',
            'options' => [
                'label' => 'Meta Description',
            ],
            'attributes' => [
                'class' => 'form-control meta meta-desc',
            ],
        ]);
        $this->add([
            'type'    => 'Zend\Form\Element\Textarea',
            'name'    => 'metaKeywords',
            'options' => [
                'label' => 'Meta Keywords',
            ],
            'attributes' => [
                'class' => 'form-control meta meta-keywords',
            ],
        ]);
        $this->add(new Element\Csrf('security'));
        $this->add([
            'name'       => 'send',
            'type'       => 'Submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
            ],
        ]);

        // set input filter
        $this->setInputFilter($this->createInputFilter());
    }

    public function createInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $locale = new InputFilter\Input('locale');
        $locale->setRequired(true);
        $inputFilter->add($locale);

        $categories = new InputFilter\Input('categories');
        $categories->setRequired(true);
        //$inputFilter->add($categories);

        // File Input
        $fileInput = new InputFilter\FileInput('photo');
        $fileInput->setRequired(true);
        $fileInput->getFilterChain()
            ->attachByName(
            'filerenameupload',
            [
                'target'    => './public'.\Blog\Entity\Blog::DEFAULT_UPLOAD_PATH.'blog.png',
                'randomize' => true,
            ]);

        $inputFilter->add($fileInput);

        $published = new InputFilter\Input('published');
        $published->setRequired(true);
        $inputFilter->add($published);

        $urlKey = new InputFilter\Input('urlKey');
        /*
        $urlKey->getFilterChain()->attachByName(
            'slug',
            array(
                array('StringLength', FALSE, array(3, 255)),
                array('Regex', FALSE, array('pattern' => '/^[\w.-]*$/'))
            )
        );
         * */
        $urlKey->getFilterChain()->attach(
            new Validator\StringLength([
                'min' => 3,
                'max' => 255,
            ])
        );
        $urlKey->getFilterChain()->attach(
            new Validator\Regex([
                'pattern' => '/^[\w.-]*$/',
            ])
        );
        //$inputFilter->add($urlKey);

        $shortContent = new InputFilter\Input('shortContent');
        $shortContent->setRequired(true);
        $inputFilter->add($shortContent);

        $content = new InputFilter\Input('content');
        $content->setRequired(true);
        $inputFilter->add($content);

        return $inputFilter;
    }

    public function save(\Application\Controller\AbstractActionController $controller)
    {
        $em = $controller->getEntityManager();
        $formData = $this->getData();
        //var_dump($formData);die;
        $blog = new Blog();
        $locale = $controller->find('Blog\Entity\Locale', (int) $formData['locale']);
        $user = $controller->getCurrentUser();
        $categories = [];
        foreach ($formData['categories'] as $catId) {
            $categories[] = $controller->find('Blog\Entity\Category', (int) $catId);
        }
        //var_dump($formData);die;
        if (isset($formData['photo']['tmp_name'])) {
            $photo = explode('/', $formData['photo']['tmp_name']);
            $photo = end($photo);

            // modify data
            $formData['photo'] = $photo;

            // create thumbnail
            $cacheImagePath = 'public'.Blog::DEFAULT_CACHE_PATH.$photo;
            if (!file_exists($cacheImagePath)) {
                $thumbnailer = $controller->getServiceLocator()->get('WebinoImageThumb');
                $imagePath = 'public'.Blog::DEFAULT_UPLOAD_PATH.$photo;
                $thumb = $thumbnailer->create($imagePath, $options = [], $plugins = []);

                $thumb->resize(350, 0);

                $thumb->save($cacheImagePath);
            }
        }

        //var_dump($formData);die;
        $formData['categories'] = $categories;
        $formData['locale'] = $locale;
        if (!$formData['id']) {
            $formData['createUser'] = $user;
            $formData['createTime'] = new \DateTime('now');

            // check url key
            if (!$formData['urlKey']) {
                $slug = Util::slugify($formData['title']);

                // check slug exist
                $slugExist = $controller->findOneBy('Blog\Entity\Blog', ['urlKey' => $slug]);
                if ($slugExist) {
                    $slug .= '-'.date('Ymdhis');
                }
                $formData['urlKey'] = $slug;
            } else {
                $formData['urlKey'] = Util::slugify($formData['urlKey']);
                // check slug exist
                $slugExist = $controller->findOneBy('Blog\Entity\Blog', ['urlKey' => $formData['urlKey']]);
                if ($slugExist) {
                    $formData['urlKey'] .= '-'.date('Ymdhis');
                }
            }

            // save
            $blog->setData($formData);
            $em->persist($blog);
            $em->flush();
        } else {
            $formData['updateUser'] = $user;
            $formData['updateTime'] = new \DateTime('now');

            $oldData = $controller->find('Blog\Entity\Blog', (int) $formData['id']);
            if ($formData['urlKey'] != $oldData->getUrlKey()) {
                // check slug exist
                $slugExist = $controller->findOneBy('Blog\Entity\Blog', ['urlKey' => $formData['urlKey']]);
                if ($slugExist) {
                    $formData['urlKey'] .= '-'.date('Ymdhis');
                }
            }
            unset($formData['id']);

            // if upload new photo delete the old one
            if ($formData['photo']) {
                unlink('./public'.\Blog\Entity\Blog::DEFAULT_UPLOAD_PATH.$oldData->getPhoto());
                unlink('./public'.\Blog\Entity\Blog::DEFAULT_CACHE_PATH.$oldData->getPhoto());
            } else {
                unset($formData['photo']);
            }

            // save
            $oldData->setData($formData);
            $em->merge($oldData);
            $em->flush();
        }
    }
}
