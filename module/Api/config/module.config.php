<?php

return [
    'router' => [
        'routes' => [
            'api' => [
                'type'    => 'Literal',
                'options' => [
                    'route'       => '/api',
                    'constraints' => [
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Api\Controller',
                        'controller'    => 'Index',
                    ],
                ],
                'child_routes' => [
                    'user' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'       => '/user/[[:id[/]][:controller[/]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Api\Controller\User',
                            ],
                        ],
                    ],
                    'blog' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'       => '/blog/[[:id[/]][:controller[/]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Api\Controller\Blog',
                            ],
                        ],
                    ],
                    'user_child' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'       => '/user/:user_id/:controller/:id[/]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'user_id'    => '[0-9]*',
                                'id'         => '[0-9]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Api\Controller\User',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Api\Controller\Blog\Blog'            => 'Api\Controller\Blog\BlogController',
            'Api\Controller\Blog\Category'        => 'Api\Controller\Blog\CategoryController',
            'Api\Controller\Blog\MissionCategory' => 'Api\Controller\Blog\MissionCategoryController',
            'Api\Controller\Blog\Locale'          => 'Api\Controller\Blog\LocaleController',
            'Api\Controller\Blog\Moderator'       => 'Api\Controller\Blog\ModeratorController',
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
