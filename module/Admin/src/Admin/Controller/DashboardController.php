<?php

namespace Admin\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DashboardController extends AbstractActionController
{
    public function indexAction()
    {
        if (!$this->getCurrentUser()) {
            return $this->redirect()->toUrl('/user/login?redirect=/admin');
        }
        return new ViewModel();
    }
}
