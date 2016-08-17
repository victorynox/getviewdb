<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        // Map middleware -> factories here
        'factories' => [
            App\Action\HomeAction::class => App\Action\HomeFactory::class,
            zaboy\rest\Pipe\RestPipe::class => App\DataStore\Pipes\Factory\RestPipeFactory::class,
            'update'=> App\Action\Update\UpdateFactory::class,
        ],
    ],
    'routes' => [

        [
            'name' => 'apt.update',
            'path' => '/api/update/{ResourceName}',
            'middleware' => 'update',
            'allowed_methods' => ['GET'],
        ],

        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomeAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.rest',
            'path' => '/api/rest[/{resourceName}[/{id}]]',
            'middleware' => zaboy\rest\Pipe\RestPipe::class,

        ],
    ],
];
