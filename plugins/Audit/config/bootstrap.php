<?php

use Cake\Event\EventManager;
use Audit\Event\UserListener;

$aCallback = new UserListener();
$callback = [$aCallback, 'updateAuthLog'];


EventManager::instance()->on(
    'Users.Component.UsersAuth.afterLogin',
    $callback
);

EventManager::instance()->on(
    'Users.Component.UsersAuth.failedLogin',
    $callback
);