<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 30/12/2014
 * Time: 11:46
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function newAction()
    {
        return new ViewModel();
    }
}
