<?php
return [
    'bjyauthorize' => array(
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        'guards' => array(

            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'admin', 'roles' => array('moderator')),
                array('route' => 'home', 'roles' => array('guest')),
                array('route' => 'zfcuser', 'roles' => array('guest')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/changepassword', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'api/blog', 'roles' => array('guest')),
                array('route' => 'api/category', 'roles' => array('guest')),
                array('route' => 'api/locale', 'roles' => array('guest')),
                array('route' => 'zfcadmin', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/blog', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog/new', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/blog/edit', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/category', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/category/new', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/category/edit', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/dashboard', 'roles' => array('guest')),
                array('route' => 'zfcadmin/default', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/moderator', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/moderator/create', 'roles' => array('administrator')),

                /** For Landing Pages */
                array('route' => 'ministry', 'roles' => array('guest')),
                array('route' => 'ministry/faq', 'roles' => array('guest')),
                array('route' => 'ministry/ministry-departments', 'roles' => array('guest')),
                array('route' => 'ministry/the-minister', 'roles' => array('guest')),
                array('route' => 'ministry/speeches-interviews', 'roles' => array('guest')),
                array('route' => 'ministry/undersecretaries', 'roles' => array('guest')),
                array('route' => 'ministry/announcements', 'roles' => array('guest')),
                array('route' => 'ministry/magazine', 'roles' => array('guest')),
                array('route' => 'about-iraq', 'roles' => array('guest')),
                array('route' => 'about-iraq/investment', 'roles' => array('guest')),
                array('route' => 'about-iraq/constitution', 'roles' => array('guest')),
                array('route' => 'about-iraq/encyclopedia', 'roles' => array('guest')),
                array('route' => 'about-iraq/announcements', 'roles' => array('guest')),
                array('route' => 'foreign-policy', 'roles' => array('guest')),
                array('route' => 'foreign-policy/press-releases', 'roles' => array('guest')),
                array('route' => 'foreign-policy/international-organizations', 'roles' => array('guest')),
                array('route' => 'diplomatic-missions', 'roles' => array('guest')),
                array('route' => 'diplomatic-missions/iraqi-ambassadors', 'roles' => array('guest')),
                array('route' => 'consular-services', 'roles' => array('guest')),
                array('route' => 'consular-services/other-links', 'roles' => array('guest')),
                array('route' => 'contact-us', 'roles' => array('guest')),

                /** For blog pages */
                array('route' => 'blog', 'roles' => array('guest')),
                array('route' => 'blog/news-ticker', 'roles' => array('guest')),
            ),
        ),
    ),
    'zenddevelopertools' => array(
        'profiler' => array(
            'enabled' => true,
            'strict' => false,
            'flush_early' => false,
            'cache_dir' => 'data/cache',
            'matcher' => array(),
            'collectors' => array(
                'db' => false,
                'doctrine-odm' => 'DoctrineMongoODMModule\Collector\MongoLoggerCollector'
            ),
        ),
        'toolbar' => array(
            'enabled' => true,
            'auto_hide' => false,
            'position' => 'bottom',
            'version_check' => true,
            'entries' => array(
                'doctrine-odm' => 'zend-developer-tools/toolbar/doctrine-odm'
            ),
        ),
    ),
    'navigation' => [
        'admin' => [
            'category' => [
                'label' => 'Category',
                'route' =>'zfcadmin/category',
                'pages' => [
                    'new-category' => [
                        'label' => 'Add a Category',
                        'route' => 'zfcadmin/category/new'
                    ],
                    'list-category' => [
                        'label' => 'Categories Manager',
                        'route' => 'zfcadmin/category'
                    ],
                ],
            ],
        ]
    ],
];