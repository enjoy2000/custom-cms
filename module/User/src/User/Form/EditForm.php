<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 09/01/2015
 * Time: 15:28.
 */
namespace User\Form;

use User\Entity\User;
use Zend\Form\Form as ZendForm;
use Zend\InputFilter;

class EditForm extends ZendForm
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form form-horizontal');
        $this->setAttribute('id', 'editForm');
        $this->getInputFilter();

        $this->add([
            'name'  => 'id',
            'type'  => 'hidden',
        ]);

        $this->add([
            'type'       => 'Zend\Form\Element\Text',
            'name'       => 'displayName',
            'attributes' => [
                'class'    => 'form-control col-xs-7',
                'required' => true,
            ],
            'options' => [
                'label' => 'Display name *',
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'attributes' => [
                'class'    => 'form-control',
                'required' => false,
                'type'     => 'password',
            ],
            'options' => [
                'label' => 'Password',
            ],
        ]);

        $this->add([
            'name'       => 'confirmation',
            'attributes' => [
                'class'    => 'form-control',
                'required' => false,
                'type'     => 'password',
            ],
            'options' => [
                'label' => 'Confirm your password',
            ],
            'validators' => [
                [
                    'name'    => 'Identical',
                    'options' => [
                        'token' => 'password', // name of first password field
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary',
                'type'  => 'submit',
                'value' => 'Edit',
            ],
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
        $moderator = $controller->find('User\Entity\User', (int) $data['id']);

        if ($this) {
        }
    }
}
