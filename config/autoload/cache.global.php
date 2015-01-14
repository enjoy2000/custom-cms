<?php
return [
    'service_manager' => array(
        'factories' => array(
            'cache' => function () {
                return Zend\Cache\StorageFactory::factory(array(
                    'storage' => array(
                        'adapter' => 'Filesystem',
                        'options' => array(
                            'cache_dir' => __DIR__ . '/../../../data/cache',
                            'ttl' => 3600
                        ),
                    ),
                    'plugins' => array(
                        'IgnoreUserAbort' => array(
                            'exitOnAbort' => true
                        ),
                    ),
                ));
            },
        ),
    )
];