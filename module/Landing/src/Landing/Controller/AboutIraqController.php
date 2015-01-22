<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Landing\Controller;

use Application\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AboutIraqController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function investmentAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function announcementsAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function constitutionAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function encyclopediaAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function theVirtualMuseumOfIraqAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }

    public function touristGuideAction()
    {
        return new ViewModel(['routes' => $this->getRouter('about-iraq')]);
    }
}
