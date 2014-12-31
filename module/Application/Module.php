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

        // service manager
        $sm = $e->getApplication()->getServiceManager();

        // set language based on $_SERVER['HTTP_ACCEPT_LANGUAGE'] && session
        // session container
        $sessionContainer = new Container('locale');

        $sessionContainer->offsetUnset('locale');
        // test if session language exists
        if (!$sessionContainer->offsetExists('locale')) {
            // if not use the browser locale
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $localeCode = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $em = $sm->get('doctrine.entitymanager.orm_default');

                // check if we support this language or not
                $localeExist = $em->getRepository('Blog\Entity\Locale')->findOneBy(['name' => $localeCode]);
                if ($localeExist) {
                    $sessionContainer->offsetSet('locale', $localeCode);
                } else{
                    $sessionContainer->offsetSet('locale', 'en_US');
                }
            } else {
                $sessionContainer->offsetSet('locale', 'en_US');
            }

        }

        // translating system
        $translator = $sm->get('translator');
        $translator ->setLocale($sessionContainer->locale)
            ->setFallbackLocale('en_US');
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
