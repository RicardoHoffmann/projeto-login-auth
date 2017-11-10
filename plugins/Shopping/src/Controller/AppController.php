<?php

namespace Shopping\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function beforeFilter(Event $event)
    {
        $this->loadModel('Shopping.Carts');

        $this->set('count', $this->Carts->getCount());
    }
}
