<?php

namespace Audit\Event;

use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Event\EventListenerInterface;
use DateTime;
use DateTimeZone;
use Cake\ORM\TableRegistry;

class UserListener implements EventListenerInterface {

    public function implementedEvents() {
        return array(
            'Users.Component.UsersAuth.afterLogin' => 'updateAuthLog',
        );
    }

    public function updateAuthLog($event)
    {
        $ualogsTable = TableRegistry::get('UserAccessLogs');
        $log = $ualogsTable->newEntity();

        if ($event->data != null) {
            $log->user_id = $event->data['user']['id'];
            $log->user_name = $event->data['user']['username'];
           $log->success = true;
        } else {
            $log->user_id = $event->subject['id'];
            $log->user_name = $event->subject['username'];
            $log->success = false;
        }
        $log->ipv4_address = $this->getClientIp();
        $log->browser = $_SERVER['HTTP_USER_AGENT'];
        $log->created = $this->getCurrDateTime();
        $ualogsTable->save($log);
    }

    private function getClientIp()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private function getCurrDateTime()
    {
        $newTZ = new DateTimeZone('America/Sao_paulo');
        $date = new DateTime();
        $date->setTimezone( $newTZ );
        return $date->format('Y-m-d H:i:s');
    }

}