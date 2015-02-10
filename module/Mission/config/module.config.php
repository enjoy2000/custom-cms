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
            'mission-menu' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/mission-menu',
                    'defaults' => array(
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'menu',
                    ),
                ),
            ],
            'mission-header' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/mission-header',
                    'defaults' => array(
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'header',
                    ),
                ),
            ],
            'mission' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/mission',
                    'defaults' => array(
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'custom_links' => [
                    [
                        'label' => 'Iraq Mission Abroad',
                        'link' => [
                            'en' => 'en-iraq-mission-abroad',
                            'ar' => 'ar-mofa-iraq-mission-abroad'
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => array(
                    'view' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/:slug][/:static]',
                            'defaults' => array(
                                'controller' => 'Mission\Controller\Blog',
                                'action' => 'view',
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
            'Mission\Controller\Index' => 'Mission\Controller\IndexController',
            'Mission\Controller\Category' => 'Mission\Controller\CategoryController',
            'Mission\Controller\Blog' => 'Mission\Controller\BlogController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'article_partial' => __DIR__ . '/../view/partial/article.phtml',
            'static' => __DIR__ . '/../view/partial/static-navigation.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            'Mission' . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . 'Mission' . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Mission' . '\Entity' => 'Mission' . '_driver'
                )
            )
        )
    ),
);
