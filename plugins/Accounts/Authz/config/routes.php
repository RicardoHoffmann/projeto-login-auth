<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Accounts/Authz',
    ['path' => '/accounts/authz'],
    function (RouteBuilder $routes) {
        $routes->extensions(['json']);
        $routes->fallbacks('DashedRoute');
    }
);