<?php
return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'username',
                    'password' => 'password',
                    'dbname'   => 'database',
                    'charset'  => 'utf8'
                )
            )
        )
    ),
    'db' => [
        'driver' => 'PDO',
        'database' => 'custom_cms',
        'username' => 'developer',
        'password' => 'developer-password'
    ]
);