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
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'countries' => [
        'US' => 'United State',
        'VN' => 'Vietnam',
        'CN' => 'China',
        'EN' => 'England',
    ],
    'project_create' => [
        'statuses' => [
            ['id' => 1, 'name' => 'Quote', 'decorator' => 'info'],
            ['id' => 2, 'name' => 'Ordered', 'decorator' => 'danger'],
        ],
        'priorities' => [
            ['id' => 1, 'name' => 'Normal', 'decorator' => 'primary'],
            ['id' => 2, 'name' => 'High', 'decorator' => 'danger'],
        ],
        'levels' => [
            ['id' => 1, 'name' => 'Professional', 'price' => [
                'USD' => 1.00,
                'CNY' => 10.00,
            ]],
            ['id' => 2, 'name' => 'Business', 'price' => [
                'USD' => 2.00,
                'CNY' => 20.00,
            ]],
            ['id' => 3, 'name' => 'Premium', 'price' => [
                'USD' => 3.00,
                'CNY' => 30.00,
            ]],
        ],
        'interpretingUnits' => [
            ['id' => 1, 'name' => 'Day'],
            ['id' => 2, 'name' => 'Half Day'],
        ],
        'engineeringUnits' => [
            ['id' => 1, 'name' => 'Page'],
            ['id' => 2, 'name' => 'Graphic'],
            ['id' => 3, 'name' => 'Hour'],
            ['id' => 4, 'name' => 'Day'],
            ['id' => 5, 'name' => 'Month'],
        ],
        'dtpUnits' => [
            ['id' => 1, 'name' => 'Hour'],
            ['id' => 2, 'name' => 'Page'],
        ],
    ],
);
