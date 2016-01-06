<?php

return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'username',
                    'password' => 'password',
                    'dbname'   => 'database',
                    'charset'  => 'utf8',
                ],
                'doctrine_type_mappings' => [
                    'enum' => 'string',
                ],
            ],
        ],
    ],
    'db' => [
        'driver'   => 'PDO',
        'database' => 'custom_cms',
        'username' => 'developer',
        'password' => 'developer-password',
    ],
];
