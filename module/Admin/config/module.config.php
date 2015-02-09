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
            'zfcadmin' => array(
                'options' => array(
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Dashboard',
                        'action'     => 'index',
                    ),
                ),
                'child_routes' => array(

                    // DASHBOARD
                    'dashboard' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/dashboard[/:action]',
                            'constraints' => array(
                                'controller' => 'Admin\Controller\Dashboard',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Dashboard',
                                'action'     => 'index',
                            ),
                        ),
                    ),

                    // CATEGORY
                    'category' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/category',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Category',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'new' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/new',
                                    'defaults' => array(
                                        'action' => 'new',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'slug' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                        ),
                    ),

                    // BLOG
                    'blog' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/blog',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Blog',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'new' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/new',
                                    'defaults' => array(
                                        'action' => 'new',
                                    ),
                                ),
                            ),
                            'query' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/query',
                                    'defaults' => array(
                                        'action' => 'query',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'slug' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                        ),
                    ),

                    // USER
                    'moderator' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/moderator',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Moderator',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'create' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/create',
                                    'defaults' => array(
                                        'action' => 'register',
                                    ),
                                ),
                            ),
                            'register' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/register',
                                    'defaults' => array(
                                        'action' => 'register',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                        ),
                    ),

                    // MISSION CATEGORY
                    'mission-category' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/mission-category',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\MissionCategory',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'new' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/new',
                                    'defaults' => array(
                                        'action' => 'new',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'static' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/static',
                                    'defaults' => array(
                                        'controller' => 'Admin\Controller\MissionStatic',
                                        'action' => 'index',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'edit' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/edit[/][:id]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action' => 'edit',
                                            ),
                                        ),
                                    ),
                                    'new' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/new',
                                            'defaults' => array(
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action' => 'new',
                                            ),
                                        ),
                                    ),
                                    'manage' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/manage[/][:id]',
                                            'constraints' => array(
                                                'id' => '[0-9]+',
                                            ),
                                            'defaults' => array(
                                                'controller' => 'Admin\Controller\MissionStatic',
                                                'action' => 'manage',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),

                    // BLOG
                    'mission-blog' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/mission-blog',
                            'defaults' => array(
                                'controller' => 'Admin\Controller\MissionBlog',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'new' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/new',
                                    'defaults' => array(
                                        'action' => 'new',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/][:id]',
                                    'constraints' => array(
                                        'slug' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
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
            'Admin\Controller\Blog' => 'Admin\Controller\BlogController',
            'Admin\Controller\Category' => 'Admin\Controller\CategoryController',
            'Admin\Controller\Dashboard' => 'Admin\Controller\DashboardController',
            'Admin\Controller\MissionBlog' => 'Admin\Controller\MissionBlogController',
            'Admin\Controller\MissionCategory' => 'Admin\Controller\MissionCategoryController',
            'Admin\Controller\MissionStatic' => 'Admin\Controller\MissionStaticController',
            'Admin\Controller\Moderator' => 'Admin\Controller\ModeratorController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'admin/category/index' => __DIR__ . '/../view/admin/category/index.phtml',
            'admin/category/new' => __DIR__ . '/../view/admin/category/new.phtml',
            'admin/dashboard/index' => __DIR__ . '/../view/admin/dashboard/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
            'zfcuser' => __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
