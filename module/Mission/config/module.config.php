    <?php
/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'mission-menu' => [
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/mission-menu',
                    'defaults' => [
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'menu',
                    ],
                ],
            ],
            'mission-header' => [
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/mission-header',
                    'defaults' => [
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'header',
                    ],
                ],
            ],
            'mission' => [
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/mission',
                    'defaults' => [
                        'controller' => 'Mission\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
                'custom_links' => [
                    [
                        'label' => 'Iraq Mission Abroad',
                        'link'  => [
                            'en' => 'en-iraq-mission-abroad',
                            'ar' => 'ar-mofa-iraq-mission-abroad',
                        ],
                    ],
                    [
                        'label' => 'Foreign Mission in Iraq',
                        'link'  => [
                            'en' => 'foreign-mission-in-iraq',
                            'ar' => 'ar-foreign-mission-in-iraq',
                        ],
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'view' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'    => '[/:slug][/:static]',
                            'defaults' => [
                                'controller' => 'Mission\Controller\Blog',
                                'action'     => 'view',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' => [
        'locale'                    => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__.'/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Mission\Controller\Index'    => 'Mission\Controller\IndexController',
            'Mission\Controller\Category' => 'Mission\Controller\CategoryController',
            'Mission\Controller\Blog'     => 'Mission\Controller\BlogController',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map'             => [
            'article_partial' => __DIR__.'/../view/partial/article.phtml',
            'static'          => __DIR__.'/../view/partial/static-navigation.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view',
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
    // Doctrine config
    'doctrine' => [
        'driver' => [
            'Mission'.'_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__.'/../src/'.'Mission'.'/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'Mission'.'\Entity' => 'Mission'.'_driver',
                ],
            ],
        ],
    ],
];
