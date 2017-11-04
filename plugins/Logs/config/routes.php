<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Logs',
    ['path' => '/logs'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
