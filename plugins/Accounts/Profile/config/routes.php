<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Accounts/Profile',
    ['path' => '/accounts/profile'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
