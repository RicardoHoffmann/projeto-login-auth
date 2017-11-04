<?php
use Cake\Routing\Router;

Router::plugin(
    'SignUp/User',
    ['path' => '/sign-up/user'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
