<?php

return [
    'log' => [
        'Log\App' => [
            'writers' => [
                [
                    'name'     => 'stream',
                    'priority' => 1000,
                    'options'  => [
                        'stream' => 'data/logs/app.log',
                    ],
                ],
            ],
        ],
    ],
];
