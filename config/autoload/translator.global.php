<?php

return [
    'translator' => [
        'cache' => [
            'adapter' => [
                'name'    => 'Filesystem',
                'options' => [
                    'cache_dir' => __DIR__.'/../../data/cache',
                    'ttl'       => '3600',
                ],
            ],
            'plugins' => [
                [
                    'name'    => 'serializer',
                    'options' => [],
                ],
                'exception_handler' => [
                    'throw_exceptions' => true,
                ],
            ],
        ],
    ],
];
