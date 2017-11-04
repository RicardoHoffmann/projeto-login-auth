<?php
/**
 * Created by PhpStorm.
 * User: maicon
 * Date: 10/05/16
 * Time: 09:29
 */

namespace Audit\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\EventManager;
use AuditStash\Meta\RequestMetadata;

class AuditComponent extends Component
{
    /**
     * callbacks to lorenzo/audit-stash events
     *
     */
    public function auditStashCallback()
    {
        $controller = $this->_registry->getController();
        EventManager::instance()->on(new RequestMetadata($this->request, $controller->Auth->user('id')));

        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $event) {
                $event->setMetaInfo($event->getMetaInfo() + ['browser' => $_SERVER['HTTP_USER_AGENT']]);
            }
        });
    }
    
}