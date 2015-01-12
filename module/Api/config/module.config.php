<?php

return array(
    'router' => array(
        'routes' => array(
            'api' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/api',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Api\Controller',
                        'controller' => 'Index',
                    ),
                ),
                'child_routes' => array(
                    'user' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/user/[[:id[/]][:controller[/]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Api\Controller\User',
                            ),
                        ),
                    ),
                    'blog' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/blog/[[:id[/]][:controller[/]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Api\Controller\Blog',
                            ),
                        ),
                    ),
                    'user_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/user/:user_id/:controller/:id[/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'user_id' => '[0-9]*',
                                'id' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Api\Controller\User',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Blog\Blog' => 'Api\Controller\Blog\BlogController',
            'Api\Controller\Blog\Category' => 'Api\Controller\Blog\CategoryController',
            'Api\Controller\Blog\MissionCategory' => 'Api\Controller\Blog\MissionCategoryController',
            'Api\Controller\Blog\Locale' => 'Api\Controller\Blog\LocaleController',
            'Api\Controller\Blog\Moderator' => 'Api\Controller\Blog\ModeratorController',
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
