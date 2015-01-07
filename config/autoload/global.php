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
                array('route' => 'news-ticker', 'roles' => array('guest')),
                array('route' => 'blog/view', 'roles' => array('guest')),

                /** For htimg images caching pages */
                array('route' => 'htimg', 'roles' => array('guest')),
                array('route' => 'htimg/display', 'roles' => array('guest')),
            ),
        ),
    ),
];
