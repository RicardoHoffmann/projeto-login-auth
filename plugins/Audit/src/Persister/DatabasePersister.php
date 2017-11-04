<?php
/**
 * Created by PhpStorm.
 * User: maicon
 * Date: 12/05/16
 * Time: 16:25
 */

namespace Audit\Persister;

use AuditStash\PersisterInterface;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;

class DatabasePersister implements PersisterInterface
{
    public function logEvents(array $auditLogs)
    {
        foreach ($auditLogs as $log) {
            $eventType = $log->getEventType();
            $data = [
                'timestamp' => $log->getTimestamp(),
                'transaction' => $log->getTransactionId(),
                'type' => $log->getEventType(),
                'primary_key' => $log->getId(),
                'source' => $log->getSourceName(),
                'parent_source' => $log->getParentSourceName(),
                'changed' => $eventType === 'delete' ? null : $log->getChanged(),
                'meta' => $log->getMetaInfo()
            ];

            TableRegistry::get('Audit.AuditLogs')->save(new Entity($data));
        }
    }
}