<?php

namespace Audit\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    use \Crud\Controller\ControllerTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'index' => [
                    'className' => '\AuditStash\Action\ElasticLogsIndexAction',
                    'relatedModels' => false
                ],
                'view' => ['className' => '\AuditStash\Action\ElasticLogsViewAction']
            ],
        ]);
    }

}