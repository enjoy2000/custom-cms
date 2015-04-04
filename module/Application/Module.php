<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        /**
         * Set default time zone
         */
        date_default_timezone_set('Asia/Dhaka');


        // session container
        $sessionContainer = new Container('locale');

        $sessionContainer->offsetUnset('locale');

        if (isset($_SERVER['REQUEST_URI'])) {
            $requestUri = explode('/', $_SERVER['REQUEST_URI']);
            if (isset($requestUri[1]) && $requestUri[1] != 'en') {
                $locale = 'ar_IQ';
                \Locale::setDefault ('ar_IQ');
            } else {
                $locale = 'en_US';
                \Locale::setDefault ('en_US');
            }
            $sessionContainer->offsetSet('locale', $locale);
        }

        // service manager
        $sm = $e->getApplication()->getServiceManager();

        // TODO: why we need this line
        $em = $sm->get('doctrine.entitymanager.orm_default');
        // die('here');
        // translating system
        $translator = $sm->get('translator');
        $translator ->setLocale($sessionContainer->offsetGet('locale'))
            ->setFallbackLocale('en_US');

        // set variables to layout
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->locale = $sessionContainer->locale;

        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayout'));
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'config' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\Config();
                    $viewHelper->setServiceLocator($serviceLocator);

                    return $viewHelper;
                },
                'em' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\Em();
                    $viewHelper->setServiceLocator($serviceLocator);

                    return $viewHelper;
                },
                'rendermenu' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\Rendermenu();
                    $viewHelper->setServiceLocator($serviceLocator);

                    return $viewHelper;
                }
            ),
        );
    }

    public function selectLayout(MvcEvent $e)
    {
        $controller = $e->getTarget();
        $config          = $e->getApplication()->getServiceManager()->get('config');
        $controllerClass = get_class($controller);
        $controllers = explode('\\', $controllerClass);
        $action = str_replace('Controller', '', $controllers[2]);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

        //var_dump($controller->layout());die;
        if (!$controller->layout()->terminate()) {
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
                if (isset($config['module_layouts'][$moduleNamespace . '/' . $action])) {
                    $controller->layout($config['module_layouts'][$moduleNamespace . '/' . $action]);
                }
            }
        }
    }
}
