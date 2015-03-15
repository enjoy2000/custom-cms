<?php
namespace Admin\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Element;
use Zend\InputFilter;
use Zend\Validator;
use Zend\Filter;
use Landing\Entity\Menu as MenuEntity;

class Menu extends ZendForm
{
    public function __construct(\Application\Controller\AbstractActionController $controller, $name = 'new')
    {
        parent::__construct();
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form form-horizontal');
        $this->setAttribute('id', 'menuForm');
        $this->getInputFilter();
        
        $this->add(array(
            'name' => 'id',
            'type'  => 'hidden',
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'attributes' => array(
                'class' => 'form-control col-md-7',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Type',
                'value_options' => [
                    'static' => 'Static',
                    'article' => 'Article',
                    'category' => 'Category',
                    'external' => 'External',
                ],
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'label',
            'attributes' => array(
                'class' => 'form-control col-md-7',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Label',
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'labelAr',
            'options' => array(
                'label' => 'Arabic Label',
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7',
                'required' => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'value',
            'options' => array(
                'label' => 'Url Key',
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 custom-modal',
                'required' => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'valueAr',
            'options' => array(
                'label' => 'Arabic Url Key',
            ),
            'attributes' => array(
                'class' => 'form-control col-md-7 custom-modal',
                'required' => true,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Number',
            'name' => 'orderNumber',
            'attributes' => [
                'class' => 'form-control col-md-7',
                'required' => true,
            ],
            'options' => array(
                'label' => 'Order Number',
            ),
            /*
            'validators' => [
                'name' => 'Callback',
                'options' => [
                    'callback' => function($orderNumber) {
                        if ($orderNumber == 1) {
                            return 'abc';
                        }
                    }
                ],
            ],
            */
        ));
        
        $em = $controller->getEntityManager();
        $rootMenus = $em->getRepository('Landing\Entity\Menu')->findBy(['parentMenu' => null]);
        $parentMenuOptions = [];
        $parentMenuOptions['0'] = 'No parent menu';
        foreach ($rootMenus as $menu) {
            $parentMenuOptions[$menu->getId()] = $menu->getLabel();
        }
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parentMenu',
            'attributes' => array(
                'class' => 'form-control col-md-7',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Parent Menu',
                'value_options' => $parentMenuOptions,
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'showMenu',
            'attributes' => array(
                'class' => '',
            ),
            'options' => array(
                'label' => 'Show in top menu',
            ),
        ));
        
        $this->add(new Element\Csrf('security'));
        
        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'class' => 'btn btn-primary'
            ),
        ));

        // set input filter
        $this->setInputFilter($this->createInputFilter());
    }
    
     public function createInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $type = new InputFilter\Input('type');
        $type->setRequired(true);
        $inputFilter->add($type);

        $value = new InputFilter\Input('value');
        $value->setRequired(true);
        $inputFilter->add($value);

        $valueAr = new InputFilter\Input('valueAr');
        $valueAr->setRequired(true);
        $inputFilter->add($valueAr);

        $label = new InputFilter\Input('label');
        $label->setRequired(true);
        $inputFilter->add($label);

        $labelAr = new InputFilter\Input('labelAr');
        $labelAr->setRequired(true);
        $inputFilter->add($labelAr);

        $orderNumber = new InputFilter\Input('orderNumber');
        $orderNumber->setRequired(true);
        $inputFilter->add($orderNumber);

        return $inputFilter;
    }
    
    public function save($controller)
    {
        $data = $this->getData();
        //var_dump($data);die;
        
        if ((int)$data['id'] > 0) {
            $menu = $controller->getEntityManager()->getRepository('Landing\Entity\Menu')->find((int)$data['id']);
        } else{
            $menu = new MenuEntity();
        }

        $data['parentMenu'] = $controller->find('Landing\Entity\Menu', (int) $data['parentMenu']);

        $menu->setData($data);
        if ((int)$data['id'] > 0) {
            $controller->getEntityManager()->merge($menu);
        } else{
            $controller->getEntityManager()->persist($menu);
        }
        $controller->getEntityManager()->flush();
    }
}