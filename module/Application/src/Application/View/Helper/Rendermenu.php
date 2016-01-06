<?php
/**
 * Created by PhpStorm.
 * User: hat
 * Date: 22/01/2015
 * Time: 17:57.
 */
namespace Application\View\Helper;

use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\AbstractHelper;

/**
 * Returns total value (with tax).
 */
class Rendermenu extends AbstractHelper
{
    /**
     * Service Locator.
     *
     * @var ServiceManager
     */
    protected $serviceLocator;

    /**
     * __invoke.
     *
     * @param  string
     *
     * @return string
     */
    public function __invoke($routeMatch, $name = null)
    {
        //$em = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        if (null === $name) {
            $menu = $this->_getMainMenu($routeMatch);
        } elseif ($name == 'sidebar') {
            $menu = $this->_getSidebar($routeMatch);
        } elseif ($name == 'admin') {
            $menu = $this->_getAdminMenu($routeMatch);
        }

        return $menu;
    }

    protected function _getAdminMenu($routeMatch)
    {
        $menuService = new \Landing\Service\Menu();

        return $menuService->renderMenu($routeMatch, $this->serviceLocator, 'admin');
    }

    protected function _getMainMenu($routeMatch)
    {
        $menuService = new \Landing\Service\Menu();

        return $menuService->renderMenu($routeMatch, $this->serviceLocator);
    }

    protected function _getSidebar($routeMatch)
    {
        $menuService = new \Landing\Service\Menu();

        return $menuService->renderSidebar($routeMatch, $this->serviceLocator);
    }

    /**
     * Setter for $serviceLocator.
     *
     * @param ServiceManager $serviceLocator
     */
    public function setServiceLocator(ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
