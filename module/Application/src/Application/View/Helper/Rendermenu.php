<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 22/01/2015
 * Time: 17:57
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;

/**
 * Returns total value (with tax)
 *
 */
class Rendermenu extends AbstractHelper
{
    /**
     * Service Locator
     * @var ServiceManager
     */
    protected $serviceLocator;

    /**
     * __invoke
     *
     * @access public
     * @param  string
     * @return String
     */
    public function __invoke($routeMatch, $sidebar = null)
    {
        //$em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        if (null === $sidebar) {
            $menu = $this->_getMainMenu($routeMatch);
        } else {
            $menu = $this->_getSidebar($routeMatch, $sidebar);
        }

        return $menu;
    }

    protected function _getMainMenu($routeMatch)
    {
        $em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        $menuService = new \Landing\Service\Menu();

        return $menuService->renderMenu($routeMatch, $this->serviceLocator);
    }

    /**
     * Setter for $serviceLocator
     * @param ServiceManager $serviceLocator
     */
    public function setServiceLocator(ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}