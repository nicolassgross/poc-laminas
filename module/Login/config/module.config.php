<?php

declare(strict_types=1);

namespace Login;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Login\Controller\IndexController;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'login',
                    ],
                ],
            ],

            'auth' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/auth',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'auth',
                    ],
                ],
            ],

            'logout' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_map' => [
            'login/index'           => __DIR__ . '/../view/login/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . 'driver' => [
                'class' => XmlDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/doctrine'
                ],
            ],

            'orm_default' => [
                'drivers' => [
                    'Login\Entidade' => __NAMESPACE__ . 'driver'
                ],
            ],
        ],
    ],
];

