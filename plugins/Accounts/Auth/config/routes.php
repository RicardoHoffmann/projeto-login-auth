<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Accounts/Auth',
    ['path' => '/accounts/auth'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);

Router::connect('/login', ['plugin' => null, 'plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'login']);
Router::connect('/logout', ['plugin' => null, 'plugin' => 'Accounts/Auth', 'controller' => 'Users', 'action' => 'logout']);