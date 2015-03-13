<?php
namespace Admin\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Element;
use Zend\InputFilter;
use Zend\Validator;
use Zend\Filter;

class Menu extends ZendForm
{
    public function __construct($name = 'new')
    {
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form form-horizontal');
        $this->setAttribute('id', 'menuForm');
        $this->getInputFilter();
    }
}