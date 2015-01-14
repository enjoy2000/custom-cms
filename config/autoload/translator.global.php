<?php
return [
    'translator' => array(
        'cache' => array(
            'adapter' => array(
                'name' => 'Filesystem',
                'options' => array(
                    'cache_dir' => __DIR__ . '/../../data/cache',
                    'ttl' => '3600'
                )
            ),
            'plugins' => array(
                array(
                    'name' => 'serializer',
                    'options' => array()
                ),
                'exception_handler' => array(
                    'throw_exceptions' => true
                )
            ),
        )
    )
];