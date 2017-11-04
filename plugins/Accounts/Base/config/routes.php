<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Accounts/Base',
    ['path' => '/accounts/base'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
