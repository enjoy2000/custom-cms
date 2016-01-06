<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/1/15
 * Time: 10:56 AM.
 */
namespace Mission\Form;

use Application\Helper\Util;
use Mission\Entity\StaticPage;
use Zend\Filter;
use Zend\Form\Element;
use Zend\Form\Form as ZendForm;
use Zend\InputFilter;
use Zend\Validator;

class StaticForm extends ZendForm
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
            'name'       => 'category',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
                'id'       => 'select-category',
            ],
            'options' => [
                'disable_inarray_validator' => true, // <-- disable
                'label'                     => 'Select Category',
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

        $this->add([
            'type'       => 'Zend\Form\Element\Text',
            'name'       => 'orderNumber',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => false,
            ],
            'options' => [
                'label' => 'Order',
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

        $categories = new InputFilter\Input('category');
        $categories->setRequired(true);
        $inputFilter->add($categories);

        $title = new InputFilter\Input('title');
        $title->setRequired(true);
        $inputFilter->add($title);

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
                'min' => 0,
                'max' => 255,
            ])
        );
        $urlKey->getFilterChain()->attach(
            new Validator\Regex([
                'pattern' => '/^[a-zA-Z\d]+$/',
            ])
        );
        //$inputFilter->add($urlKey);

        $content = new InputFilter\Input('content');
        $content->setRequired(true);
        $inputFilter->add($content);

        $order = new InputFilter\Input('orderNumber');
        $order->getFilterChain()->attach(
            new Validator\Between([
                'min'       => 0,
                'max'       => 1000,
            ])
        );
        //$inputFilter->add($order);

        return $inputFilter;
    }

    public function save(\Application\Controller\AbstractActionController $controller)
    {
        $em = $controller->getEntityManager();
        $formData = $this->getData();
        $blog = new StaticPage();
        $locale = $controller->find('Blog\Entity\Locale', (int) $formData['locale']);
        $user = $controller->getCurrentUser();
        $formData['category'] = $controller->find('Mission\Entity\Category', (int) $formData['category']);
        $formData['locale'] = $locale;
        if (!$formData['id']) {
            $formData['createUser'] = $user;
            $formData['createTime'] = new \DateTime('now');

            // check url key
            if (!$formData['urlKey']) {
                $slug = Util::slugify($formData['title']);
                $formData['urlKey'] = $slug;
            } else {
                $formData['urlKey'] = Util::slugify($formData['urlKey']);
            }

            // save
            $blog->setData($formData);
            $em->persist($blog);
            $em->flush();
        } else {
            $formData['updateUser'] = $user;
            $formData['updateTime'] = new \DateTime('now');

            $oldData = $controller->find('Mission\Entity\StaticPage', (int) $formData['id']);

            // save
            $oldData->setData($formData);
            $em->merge($oldData);
            $em->flush();
        }
    }
}
