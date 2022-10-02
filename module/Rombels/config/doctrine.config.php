<?php
return [
    'doctrine' => [
        'driver' => [
            'rombels_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/orm']
            ],
            'orm_default' => [
                'drivers' => [
                    'Rombels\Entity' => 'rombels_entity',
                ]
            ]
        ],
    ],
];
