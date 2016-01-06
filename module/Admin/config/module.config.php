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
            'zfcadmin' => [
                'options' => [
                    'defaults' => [
                        'controller' => 'Admin\Controller\Dashboard',
                        'action'     => 'index',
                    ],
                ],
                'child_routes' => [

                    // DASHBOARD
                    'dashboard' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'       => '/dashboard[/:action]',
                            'constraints' => [
                                'controller' => 'Admin\Controller\Dashboard',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                'controller' => 'Admin\Controller\Dashboard',
                                'action'     => 'index',
                            ],
                        ],
                    ],

                    // CATEGORY
                    'category' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/category',
                            'defaults' => [
                                'controller' => 'Admin\Controller\Category',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'new' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/new',
                                    'defaults' => [
                                        'action' => 'new',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'slug' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    // BLOG
                    'blog' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/blog',
                            'defaults' => [
                                'controller' => 'Admin\Controller\Blog',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'new' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/new',
                                    'defaults' => [
                                        'action' => 'new',
                                    ],
                                ],
                            ],
                            'query' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/query',
                                    'defaults' => [
                                        'action' => 'query',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'slug' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/delete[/][:id]',
                                    'constraints' => [
                                        'slug' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    // USER
                    'moderator' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/moderator',
                            'defaults' => [
                                'controller' => 'Admin\Controller\Moderator',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'create' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/create',
                                    'defaults' => [
                                        'action' => 'register',
                                    ],
                                ],
                            ],
                            'register' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/register',
                                    'defaults' => [
                                        'action' => 'register',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    // MISSION CATEGORY
                    'mission-category' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/mission-category',
                            'defaults' => [
                                'controller' => 'Admin\Controller\MissionCategory',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'new' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/new',
                                    'defaults' => [
                                        'action' => 'new',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                            'static' => [
                                'type'    => 'Literal',
                                'options' => [
                                    'route'    => '/static',
                                    'defaults' => [
                                        'controller' => 'Admin\Controller\MissionStatic',
                                        'action'     => 'index',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes'  => [
                                    'edit' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'       => '/edit[/][:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action'     => 'edit',
                                            ],
                                        ],
                                    ],
                                    'new' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'    => '/new',
                                            'defaults' => [
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action'     => 'new',
                                            ],
                                        ],
                                    ],
                                    'manage' => [
                                        'type'    => 'Segment',
                                        'options' => [
                                            'route'       => '/manage[/][:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action'     => 'manage',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],

                    // BLOG
                    'mission-blog' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/mission-blog',
                            'defaults' => [
                                'controller' => 'Admin\Controller\MissionBlog',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'new' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/new',
                                    'defaults' => [
                                        'action' => 'new',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'slug' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    // menu
                    'menu' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/menu[/[:action[/]][:id[/]]]',
                            'defaults' => [
                                'controller' => 'Admin\Controller\Menu',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes'  => [
                            'new' => [
                                'type'    => 'literal',
                                'options' => [
                                    'route'    => '/new',
                                    'defaults' => [
                                        'action' => 'new',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/edit[/][:id]',
                                    'constraints' => [
                                        'slug' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'       => '/delete[/][:id]',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                ],
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
            'Admin\Controller\Blog'            => 'Admin\Controller\BlogController',
            'Admin\Controller\Category'        => 'Admin\Controller\CategoryController',
            'Admin\Controller\Dashboard'       => 'Admin\Controller\DashboardController',
            'Admin\Controller\Menu'            => 'Admin\Controller\MenuController',
            'Admin\Controller\MissionBlog'     => 'Admin\Controller\MissionBlogController',
            'Admin\Controller\MissionCategory' => 'Admin\Controller\MissionCategoryController',
            'Admin\Controller\MissionStatic'   => 'Admin\Controller\MissionStaticController',
            'Admin\Controller\Moderator'       => 'Admin\Controller\ModeratorController',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map'             => [
            'admin/category/index'  => __DIR__.'/../view/admin/category/index.phtml',
            'admin/category/new'    => __DIR__.'/../view/admin/category/new.phtml',
            'admin/dashboard/index' => __DIR__.'/../view/admin/dashboard/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__.'/../view',
            'zfcuser' => __DIR__.'/../view',
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
];
