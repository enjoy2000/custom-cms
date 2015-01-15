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

class ForeignPolicyController extends AbstractActionController
{
    public function indexAction()
    {
        return $this->forward()->dispatch('Landing\Controller\ForeignPolicy', array(
            'action' => 'theNewIraq',
        ));
    }

    public function theNewIraqAction()
    {
        return new ViewModel(['routes' => $this->getRouter('foreign-policy')]);
    }

    public function internationalOrganizationsAction()
    {
        return new ViewModel(['routes' => $this->getRouter('foreign-policy')]);
    }
}
