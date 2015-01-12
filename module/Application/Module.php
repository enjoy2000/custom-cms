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

        /**
         * Set base url for multi languages
         */
        // Trigger after matched route & before authorization modules.
        $eventManager->attach(
            MvcEvent::EVENT_ROUTE,
            array($this, 'setBaseUrl'),
            -100
        );

        // Trigger before 404s are rendered.
        $eventManager->attach(
            MvcEvent::EVENT_RENDER,
            array($this, 'setBaseUrl'),
            -1000
        );

        // service manager
        $sm = $e->getApplication()->getServiceManager();

        // set language based on $_SERVER['HTTP_ACCEPT_LANGUAGE'] && session
        // session container
        $sessionContainer = new Container('locale');

        //$sessionContainer->offsetUnset('locale');
        // test if session language exists
        if (!$sessionContainer->offsetExists('locale')) {
            // if not use the browser locale
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $shortCode = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $em = $sm->get('doctrine.entitymanager.orm_default');

                // check if we support this language or not
                /** @var \Blog\Entity\Locale $localeExist */
                $localeExist = $em->getRepository('Blog\Entity\Locale')->findOneBy(['shortCode' => $shortCode]);
                if ($localeExist) {
                    $sessionContainer->offsetSet('locale', $localeExist->getCode());
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

    public function setBaseUrl(MvcEvent $e) {
        $request = $e->getRequest();
        $baseUrl = $request->getServer('APPLICATION_BASEURL');

        if (!empty($baseUrl) && $request->getServer('HTTP_X_FORWARDED_FOR', false)) {
            $router = $e->getApplication()->getServiceManager()->get('Router');
            $router->setBaseUrl($baseUrl);
            $request->setBaseUrl($baseUrl);

            // fastcgi_param APPLICATION_BASEURL /ar/;
            $sessionContainer = new Container('locale');
            $sessionContainer->offsetSet('locale', 'ar_IQ');
        }
    }
}
