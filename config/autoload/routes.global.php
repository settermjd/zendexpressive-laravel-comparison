<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            App\Action\ViewUrlsPageAction::class => App\Action\ViewUrlsPageFactory::class,
            App\Action\AddUrlPageAction::class => App\Action\AddUrlPageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'url.add',
            'path' => '/add-url',
            'middleware' => App\Action\AddUrlPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\ViewUrlsPageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
