<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 09/01/2015
 * Time: 15:28
 */
namespace User\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Element;
use Zend\InputFilter;
use Zend\Validator;
use Zend\Filter;
use User\Entity\User;

class EditForm extends ZendForm {
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form form-horizontal');
        $this->setAttribute('id', 'editForm');
        $this->getInputFilter();

        $this->add(array(
            'name' => 'id',
            'type'  => 'hidden',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'displayName',
            'attributes' => array(
                'class' => 'form-control col-md-7',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Display name *',
            )
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'class' => 'form-control',
                'required' => false,
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            )
        ));

        $this->add(array(
            'name' => 'confirmation',
            'attributes' => array(
                'class' => 'form-control',
                'required' => false,
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Confirm your password',
            ),
            'validators' => array(
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password', // name of first password field
                    ),
                ),
            ),
        ));

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary',
                'type' => 'submit',
                'value' => 'Edit'
            ]
        ]);

        $this->setInputFilter($this->createInputFilter());
    }

    public function createInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $displayName = new InputFilter\Input('displayName');
        $displayName->setRequired('true');

        return $inputFilter;
    }

    public function save(\Admin\Controller\ModeratorController $controller)
    {
        $data = $this->getData();
        $em = $controller->getEntityManager();
        $moderator = $controller->find('User\Entity\User', (int)$data['id']);

        if ($this) {}
    }
}