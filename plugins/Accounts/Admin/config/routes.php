<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Accounts/Admin',
    ['path' => '/accounts/admin'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
