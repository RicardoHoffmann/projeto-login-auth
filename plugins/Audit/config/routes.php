<?php
use Cake\Routing\Router;

Router::plugin(
    'Audit',
    ['path' => '/audit'],
    function ($routes) {
        $routes->extensions(['json']);
        $routes->resources('Api');
        $routes->fallbacks('DashedRoute');
        $routes->connect('/:controller');
    }
);