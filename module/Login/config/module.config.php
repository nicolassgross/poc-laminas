<?php

declare(strict_types=1);

namespace Login;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Login\Controller\LoginController;
use Login\Service\AuthService;
use Login\Service\Factory\AuthServiceFactory;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'auth' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/auth',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action'     => 'auth',
                    ],
                ],
            ],

            'welcome' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/welcome',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action'     => 'welcome',
                    ],
                ],
            ],

            'logout' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            LoginController::class => InvokableFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            AuthService::class => AuthServiceFactory::class
        ],
    ],

    'view_manager' => [
        'template_map' => [
            //module/controller/action
            'login/login/index'           => __DIR__ . '/../view/login/login/index.phtml',
            'login/login/welcome'           => __DIR__ . '/../view/login/login/welcome.phtml',
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

