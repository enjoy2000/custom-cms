<?php
return [
    'caches' => array(
        'Cache\Transient' => array(
            'adapter' => [
                'name' => 'redis',
                'options' => array (
                    'server' => [
                        'host' => '127.0.0.1',
                        'port' => 6379,
                    ]
                )
            ],
            'ttl'     => 60 * 60, // 1 h
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false,
                ),
                // We store database rows on filesystem so we need to serialize them
                'Serializer'
            ),
        ),
        'Cache\Persistence' => array(
            'adapter' => 'filesystem',
            'ttl'     => 60 * 60, // 1 h,
            'cache_dir' => __DIR__ . '/../../data/cache/',
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false,
                ),
                // We store database rows on filesystem so we need to serialize them
                'Serializer'
            ),
        ),
    ),
];