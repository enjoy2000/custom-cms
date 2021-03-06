<?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Landing\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MinistryController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([]);
    }

    public function theMinisterAction()
    {
        return new ViewModel([]);
    }

    public function ministryDepartmentsAction()
    {
        return new ViewModel([]);
    }

    public function faqAction()
    {
        return new ViewModel([]);
    }

    public function speechesInterviewsAction()
    {
        return new ViewModel([]);
    }

    public function undersecretariesAction()
    {
        return new ViewModel([]);
    }

    public function announcementsAction()
    {
        return new ViewModel([]);
    }

    public function magazineAction()
    {
        return new ViewModel([]);
    }

    public function mofaMinistersAction()
    {
        return new ViewModel([]);
    }
}
