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

class ForeignPolicyController extends AbstractActionController
{
    public function indexAction()
    {
        return $this->forward()->dispatch('Landing\Controller\ForeignPolicy', [
            'action' => 'theNewIraq',
        ]);
    }

    public function theNewIraqAction()
    {
        return new ViewModel([]);
    }

    public function internationalOrganizationsAction()
    {
        return new ViewModel([]);
    }

    public function arabLeagueAction()
    {
        return new ViewModel([]);
    }

    public function economicRehabilitationAction()
    {
        return new ViewModel([]);
    }

    public function humanRightsAction()
    {
        return new ViewModel([]);
    }

    public function iraqAndTheUnitedNationsAction()
    {
        return new ViewModel([]);
    }

    public function iraqSDiplomaticMissionsAction()
    {
        return new ViewModel([]);
    }

    public function iraqSSecurityAction()
    {
        return new ViewModel([]);
    }

    public function iraqiTreatiesAction()
    {
        return new ViewModel([]);
    }

    public function reformingTheMinistryAction()
    {
        return new ViewModel([]);
    }

    public function securityCouncilResolutionsAction()
    {
        return new ViewModel([]);
    }
}
