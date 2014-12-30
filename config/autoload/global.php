<?php
return ['bjyauthorize' => array(
    'guards' => array(

        'BjyAuthorize\Guard\Route' => array(
            array('route' => 'admin', 'roles' => array('moderator')),
            array('route' => 'home', 'roles' => array('guest')),
            array('route' => 'zfcuser', 'roles' => array('guest')),
            array('route' => 'zfcuser/logout', 'roles' => array('user')),
            array('route' => 'zfcuser/login', 'roles' => array('guest')),
            array('route' => 'zfcuser/register', 'roles' => array('guest')),
            array('route' => 'api/blog', 'roles' => array('guest')),
            array('route' => 'api/category', 'roles' => array('guest')),
            array('route' => 'api/locale', 'roles' => array('guest')),
            array('route' => 'zfcadmin', 'roles' => array('administrator')),
            array('route' => 'zfcadmin/default', 'roles' => array('administrator')),
            array('route' => 'zfcadmin/dashboard', 'roles' => array('moderator')),
            array('route' => 'zfcadmin/category', 'roles' => array('administrator')),
            array('route' => 'zfcadmin/blog', 'roles' => array('moderator')),
        ),
    ),
)];