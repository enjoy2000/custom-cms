<?php
return [
    'bjyauthorize' => array(
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        'guards' => array(

            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'admin', 'roles' => array('moderator')),

                // user
                array('route' => 'zfcuser', 'roles' => array('guest')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/changepassword', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),

                // api
                array('route' => 'api/blog', 'roles' => array('guest')),
                array('route' => 'api/category', 'roles' => array('guest')),
                array('route' => 'api/locale', 'roles' => array('guest')),

                // admin
                array('route' => 'zfcadmin', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog/query', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog/new', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog/edit', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/blog/delete', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/category', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/category/new', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/category/edit', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/menu', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/menu/new', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/menu/edit', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/menu/delete', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/mission-blog', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-blog/new', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-blog/edit', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-category', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/mission-category/new', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/mission-category/edit', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/mission-category/static', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-category/static/edit', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-category/static/manage', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/mission-category/static/new', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/dashboard', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/default', 'roles' => array('moderator')),
                array('route' => 'zfcadmin/moderator', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/moderator/create', 'roles' => array('administrator')),
                array('route' => 'zfcadmin/moderator/edit', 'roles' => array('administrator')),

                /** For Landing Pages */
                array('route' => 'home', 'roles' => array('guest')),
                array('route' => 'the-ministry', 'roles' => array('guest')),
                array('route' => 'the-ministry/faq', 'roles' => array('guest')),
                array('route' => 'the-ministry/the-minister', 'roles' => array('guest')),
                array('route' => 'the-ministry/mofa-ministers', 'roles' => array('guest')),
                array('route' => 'the-ministry/announcements', 'roles' => array('guest')),
                array('route' => 'the-ministry/magazine', 'roles' => array('guest')),
                array('route' => 'about-iraq', 'roles' => array('guest')),
                array('route' => 'about-iraq/investment', 'roles' => array('guest')),
                array('route' => 'about-iraq/constitution', 'roles' => array('guest')),
                array('route' => 'about-iraq/encyclopedia', 'roles' => array('guest')),
                array('route' => 'about-iraq/announcements', 'roles' => array('guest')),
                array('route' => 'about-iraq/the-virtual-museum-of-iraq', 'roles' => array('guest')),
                array('route' => 'about-iraq/tourist-guide', 'roles' => array('guest')),
                array('route' => 'foreign-policy', 'roles' => array('guest')),
                array('route' => 'foreign-policy/the-new-iraq', 'roles' => array('guest')),
                array('route' => 'foreign-policy/arab-league', 'roles' => array('guest')),
                array('route' => 'foreign-policy/economic-rehabilitation', 'roles' => array('guest')),
                array('route' => 'foreign-policy/human-rights', 'roles' => array('guest')),
                array('route' => 'foreign-policy/iraq-and-the-united-nations', 'roles' => array('guest')),
                array('route' => 'foreign-policy/iraq-s-diplomatic-missions', 'roles' => array('guest')),
                array('route' => 'foreign-policy/iraq-s-security', 'roles' => array('guest')),
                array('route' => 'foreign-policy/iraqi-treaties', 'roles' => array('guest')),
                array('route' => 'foreign-policy/reforming-the-ministry', 'roles' => array('guest')),
                array('route' => 'foreign-policy/security-council-resolutions', 'roles' => array('guest')),
                array('route' => 'foreign-policy/international-organizations', 'roles' => array('guest')),
                array('route' => 'diplomatic-missions', 'roles' => array('guest')),
                array('route' => 'diplomatic-missions/iraqi-ambassadors', 'roles' => array('guest')),
                array('route' => 'consular-services', 'roles' => array('guest')),
                array('route' => 'consular-services/approving-corpse-entry-to-iraq', 'roles' => array('guest')),
                array('route' => 'consular-services/authorization', 'roles' => array('guest')),
                array('route' => 'consular-services/birth-certificate', 'roles' => array('guest')),
                array('route' => 'consular-services/certificate-of-origin', 'roles' => array('guest')),
                array('route' => 'consular-services/death-certificate', 'roles' => array('guest')),
                array('route' => 'consular-services/extension-of-passports', 'roles' => array('guest')),
                array('route' => 'consular-services/faq', 'roles' => array('guest')),
                array('route' => 'consular-services/fees', 'roles' => array('guest')),
                array('route' => 'consular-services/forms', 'roles' => array('guest')),
                array('route' => 'consular-services/general-affairs', 'roles' => array('guest')),
                array('route' => 'consular-services/indigent-deportation', 'roles' => array('guest')),
                array('route' => 'consular-services/lawsuits', 'roles' => array('guest')),
                array('route' => 'consular-services/life-certificate', 'roles' => array('guest')),
                array('route' => 'consular-services/loss-of-passports', 'roles' => array('guest')),
                array('route' => 'consular-services/marriage-divorces-registration', 'roles' => array('guest')),
                array('route' => 'consular-services/nationality-cert', 'roles' => array('guest')),
                array('route' => 'consular-services/non-conviction-certificate', 'roles' => array('guest')),
                array('route' => 'consular-services/palestinian-travel-documents', 'roles' => array('guest')),
                array('route' => 'consular-services/pass-doc', 'roles' => array('guest')),
                array('route' => 'consular-services/passport-system', 'roles' => array('guest')),
                array('route' => 'consular-services/passports-issuance', 'roles' => array('guest')),
                array('route' => 'consular-services/patrimonies', 'roles' => array('guest')),
                array('route' => 'consular-services/ratifications', 'roles' => array('guest')),
                array('route' => 'consular-services/the-civil-status-id', 'roles' => array('guest')),
                array('route' => 'consular-services/visa', 'roles' => array('guest')),
                array('route' => 'contact-us', 'roles' => array('guest')),

                /** For blog pages */
                array('route' => 'blog', 'roles' => array('guest')),
                array('route' => 'news-ticker', 'roles' => array('guest')),
                array('route' => 'latest-news', 'roles' => array('guest')),
                array('route' => 'blog/view', 'roles' => array('guest')),
                array('route' => 'mission', 'roles' => array('guest')),
                array('route' => 'mission-menu', 'roles' => array('guest')),
                array('route' => 'mission-header', 'roles' => array('guest')),
                array('route' => 'mission/view', 'roles' => array('guest')),
            ),
        ),
    ),
];
