<?php
return [
    'service_manager' => [
        'factories' => [
            \Rombels\V1\Rest\Siswa\SiswaResource::class => \Rombels\V1\Rest\Siswa\SiswaResourceFactory::class,
            \Rombels\V1\Rest\Kelas\KelasResource::class => \Rombels\V1\Rest\Kelas\KelasResourceFactory::class,
            \Rombels\V1\Service\Kelas::class => \Rombels\V1\Service\KelasFactory::class,
            \Rombels\V1\Service\Listener\KelasEventListener::class => \Rombels\V1\Service\Listener\KelasEventListenerFactory::class,
            \Rombels\V1\Service\Siswa::class => \Rombels\V1\Service\SiswaFactory::class,
            \Rombels\V1\Service\Listener\SiswaEventListener::class => \Rombels\V1\Service\Listener\SiswaEventListenerFactory::class,
        ],
        'abstract_factories' => [
            0 => \Rombels\Mapper\AbstractMapperFactory::class,
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Rombels\\Hydrator\\Siswa' => \Rombels\V1\Hydrator\SiswaHydratorFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'rombels.rest.siswa' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/siswa[/:uuid]',
                    'defaults' => [
                        'controller' => 'Rombels\\V1\\Rest\\Siswa\\Controller',
                    ],
                ],
            ],
            'rombels.rest.kelas' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/kelas[/:uuid]',
                    'defaults' => [
                        'controller' => 'Rombels\\V1\\Rest\\Kelas\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'rombels.rest.siswa',
            1 => 'rombels.rest.kelas',
        ],
    ],
    'zf-rest' => [
        'Rombels\\V1\\Rest\\Siswa\\Controller' => [
            'listener' => \Rombels\V1\Rest\Siswa\SiswaResource::class,
            'route_name' => 'rombels.rest.siswa',
            'route_identifier_name' => 'uuid',
            'collection_name' => 'siswa',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Rombels\Entity\Siswa::class,
            'collection_class' => \Rombels\V1\Rest\Siswa\SiswaCollection::class,
            'service_name' => 'Siswa',
        ],
        'Rombels\\V1\\Rest\\Kelas\\Controller' => [
            'listener' => \Rombels\V1\Rest\Kelas\KelasResource::class,
            'route_name' => 'rombels.rest.kelas',
            'route_identifier_name' => 'uuid',
            'collection_name' => 'kelas',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Rombels\Entity\Kelas::class,
            'collection_class' => \Rombels\V1\Rest\Kelas\KelasCollection::class,
            'service_name' => 'Kelas',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Rombels\\V1\\Rest\\Siswa\\Controller' => 'HalJson',
            'Rombels\\V1\\Rest\\Kelas\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Rombels\\V1\\Rest\\Siswa\\Controller' => [
                0 => 'application/hal+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
            ],
            'Rombels\\V1\\Rest\\Kelas\\Controller' => [
                0 => 'application/vnd.rombels.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Rombels\\V1\\Rest\\Siswa\\Controller' => [
                0 => 'application/json',
                1 => 'multipart/form-data',
            ],
            'Rombels\\V1\\Rest\\Kelas\\Controller' => [
                0 => 'application/vnd.rombels.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Rombels\V1\Rest\Siswa\SiswaEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'rombels.rest.siswa',
                'route_identifier_name' => 'siswa_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Rombels\V1\Rest\Siswa\SiswaCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'rombels.rest.siswa',
                'route_identifier_name' => 'siswa_id',
                'is_collection' => true,
            ],
            \Rombels\Entity\Siswa::class => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'rombels.rest.siswa',
                'route_identifier_name' => 'uuid',
                'hydrator' => 'Rombels\\Hydrator\\Siswa',
            ],
            \Rombels\V1\Rest\Kelas\KelasEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'rombels.rest.kelas',
                'route_identifier_name' => 'kelas_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Rombels\V1\Rest\Kelas\KelasCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'rombels.rest.kelas',
                'route_identifier_name' => 'kelas_id',
                'is_collection' => true,
            ],
            \Rombels\Entity\Kelas::class => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'rombels.rest.kelas',
                'route_identifier_name' => 'uuid',
                'hydrator' => 'Rombels\\Hydrator\\Siswa',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Rombels\\V1\\Rest\\Siswa\\Controller' => [
            'input_filter' => 'Rombels\\V1\\Rest\\Siswa\\Validator',
        ],
        'Rombels\\V1\\Rest\\Kelas\\Controller' => [
            'input_filter' => 'Rombels\\V1\\Rest\\Kelas\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Rombels\\V1\\Rest\\Siswa\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nama',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'nim',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\File\Extension::class,
                        'options' => [
                            'extension' => 'png, jpg, jpeg',
                            'message' => 'Extension File Not Allowed',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\File\RenameUpload::class,
                        'options' => [
                            'randomize' => true,
                            'use_upload_extension' => true,
                            'target' => 'data/photo/profile',
                        ],
                    ],
                ],
                'name' => 'photo',
            ],
        ],
        'Rombels\\V1\\Rest\\Kelas\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'kelas',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Rombels\\V1\\Rest\\Kelas\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'Rombels\\V1\\Rest\\Siswa\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
