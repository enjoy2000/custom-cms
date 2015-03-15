<?php
/**
 * Created by PhpStorm.
 * User: antiprovn
 * Date: 1/2/15
 * Time: 7:07 PM
 */

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class MenuController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([]);
    }

    public function addAction()
    {
        return new ViewModel([

        ]);
    }

    public function editAction()
    {
        return new ViewModel([

        ]);
    }

    public function deleteAction()
    {
        return new ViewModel([

        ]);
    }
}