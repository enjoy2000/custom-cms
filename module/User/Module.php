<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
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

    public function selectLayout(MvcEvent $e)
    {

        $controller = $e->getTarget();
        $config          = $e->getApplication()->getServiceManager()->get('config');
        $controllerClass = get_class($controller);
        $controllers = explode('\\', $controllerClass);
        $action = str_replace('Controller', '', $controllers[2]);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

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
