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
        date_default_timezone_set('UTC');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


        // session container
        $sessionContainer = new Container('locale');

        $sessionContainer->offsetUnset('locale');
        // test if session language exists
        if (!$sessionContainer->offsetExists('locale')) {
            $shortCode = \Locale::getPrimaryLanguage(\Locale::getDefault());
            if ($shortCode == 'ar') {
                $locale = 'ar_IQ';
            } else {
                $locale = 'en_US';
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
        $translator ->setLocale($sessionContainer->locale)
            ->setFallbackLocale('en_US');

        // set variables to layout
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->locale = $sessionContainer->locale;

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
}
