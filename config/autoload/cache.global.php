<?php

return [
    'caches' => [
        'Cache\Transient' => [
            'adapter' => [
                'name'    => 'redis',
                'options' =>  [
                    'server' => [
                        'host' => '127.0.0.1',
                        'port' => 6379,
                    ],
                ],
            ],
            'ttl'     => 60 * 60, // 1 h
            'plugins' => [
                'exception_handler' => [
                    'throw_exceptions' => false,
                ],
                // We store database rows on filesystem so we need to serialize them
                'Serializer',
            ],
        ],
        'Cache\Persistence' => [
            'adapter'   => 'filesystem',
            'ttl'       => 60 * 60, // 1 h,
            'cache_dir' => __DIR__.'/../../data/cache/',
            'plugins'   => [
                'exception_handler' => [
                    'throw_exceptions' => false,
                ],
                // We store database rows on filesystem so we need to serialize them
                'Serializer',
            ],
        ],
    ],
];
