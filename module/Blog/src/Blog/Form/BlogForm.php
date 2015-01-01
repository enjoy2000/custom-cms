<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/1/15
 * Time: 10:56 AM
 */

namespace Blog\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Element;
use Zend\InputFilter;
use Zend\Mvc\Application;
use Zend\Validator;


class BlogForm extends ZendForm {
    public function __construct(\Application\Controller\AbstractActionController $controller, $name = null)
    {
        // we want to ignore the name passed
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->getInputFilter();

        $this->add(array(
            'name' => 'id',
            'options' => array(
                'label' => 'id',
            ),
            'type'  => 'hidden',
        ));

        // get list options locale
        $localeEntity = $controller->getEntityManager()->getRepository('Blog\Entity\Locale')->findAll();
        $locales = [];

        /** @var \Blog\Entity\Locale $locale */
        foreach ($localeEntity as $locale) {
            $locales[] = [$locale->getId() => $locale->getName()];
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'locale',
            'options' => array(
                'label' => 'Language',
                'class' => 'input-control',
                'values' => $locales
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'categories',
            'options' => array(
                'label' => 'Categories',
                'class' => 'input-control',
                'id' => 'select-category'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'title',
            'options' => array(
                'label' => 'Title',
                'class' => 'input-control'
            ),
        ));
        $this->add(array(
            'name' => 'urlKey',
            'options' => array(
                'label' => 'Url key',
            ),
            'type'  => 'Text',
            'validators' => array(
                array('StringLength', FALSE, array(3, 255)),
                array('Regex', FALSE, array('pattern' => '/^[\w.-]*$/'))
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'published',
            'options' => array(
                'label' => 'Published',
                'class' => 'input-control',
                'values' => [
                    '1' => 'Active',
                    '2' => 'Inactive'
                ]
            ),
        ));

        // File Input
        $file = new Element\File('photo');
        $file->setLabel('Photo')
            ->setAttribute('id', 'photo');
        $this->add($file);

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'shortContent',
            'options' => array(
                'label' => 'Description',
                'id' => 'shortContent',
                'class' => 'input-control'
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'content',
            'options' => array(
                'label' => 'Content',
                'id' => 'content',
                'class' => 'input-control summernote'
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'metaDescription',
            'options' => array(
                'label' => 'Meta Description',
                'class' => 'input-control meta meta-desc'
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'metaKeywords',
            'options' => array(
                'label' => 'Meta Keywords',
                'class' => 'input-control meta meta-keywords'
            ),
        ));
        $this->add(new Element\Csrf('security'));
        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
            ),
        ));

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
        $inputFilter->add($categories);

        // File Input
        $fileInput = new InputFilter\FileInput('photo');
        $fileInput->setRequired(true);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => './public/uploads/blog-photo/blog.png',
                'randomize' => true,
            )
        );
        $inputFilter->add($fileInput);

        $published = new InputFilter\Input('published');
        $published->setRequired(true);
        $inputFilter->add($published);

        $shortContent = new InputFilter\Input('shortContent');
        $shortContent->setRequired(true);
        $inputFilter->add($shortContent);

        $content = new InputFilter\Input('content');
        $content->setRequired(true);
        $inputFilter->add($content);

        return $inputFilter;
    }
} 