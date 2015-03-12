    <?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/3columns'           => __DIR__ . '/../view/layout/3columns.phtml',
            'layout/mission'           => __DIR__ . '/../view/layout/mission.phtml',
            'layout/print'           => __DIR__ . '/../view/layout/print.phtml',
            'layout/footer'           => __DIR__ . '/../view/layout/layout/footer.phtml',
            'layout/header'           => __DIR__ . '/../view/layout/layout/header.phtml',
            'layout/navigation'           => __DIR__ . '/../view/layout/layout/navigation.phtml',
            'mission/footer'           => __DIR__ . '/../view/layout/mission/footer.phtml',
            'mission/header'           => __DIR__ . '/../view/layout/mission/header.phtml',
            'mission/navigation'           => __DIR__ . '/../view/layout/mission/navigation.phtml',
            'layout/admin'           => __DIR__ . '/../view/layout/admin.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'left-sidebar'             => __DIR__ . '/../view/partial/left-sidebar.phtml',
            'right-sidebar'             => __DIR__ . '/../view/partial/right-sidebar.phtml',
            'dropdown-menu'             => __DIR__ . '/../view/partial/dropdown.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'helpers' => array(
        'factories' => array(
            'config' => function ($helperPluginManager) {
                $serviceLocator = $helperPluginManager->getServiceLocator();
                $viewHelper = new \Application\View\Helper\Config();
                $viewHelper->setServiceLocator($serviceLocator);

                return $viewHelper;
            },
            'em' => function ($helperPluginManager) {
                $serviceLocator = $helperPluginManager->getServiceLocator();
                $viewHelper = new \Application\View\Helper\Em();
                $viewHelper->setServiceLocator($serviceLocator);

                return $viewHelper;
            },
            'rendermenu' => function ($helperPluginManager) {
                $serviceLocator = $helperPluginManager->getServiceLocator();
                $viewHelper = new \Application\View\Helper\Rendermenu();
                $viewHelper->setServiceLocator($serviceLocator);

                return $viewHelper;
            },
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
