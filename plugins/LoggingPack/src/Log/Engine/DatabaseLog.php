<?php

namespace LoggingPack\Log\Engine;
use Cake\Log\Engine\BaseLog;
use Cake\Mailer\Email;
use Cake\Network\Exception\SocketException;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Maknz\Slack\Client as SlackClient;
use Cake\Core\Configure;

class DatabaseLog extends BaseLog
{
    public function __construct($options = [])
    {
        parent::__construct($options);
        // ...
    }

    public function log($level, $message, array $context = [])
    {
        date_default_timezone_set('America/Sao_Paulo');
        $logsTable = TableRegistry::get('Logs');
        $log = $logsTable->newEntity();
        $log->level = $level;
        $log->message = $message;
        $log->created = date('Y-m-d H:i:s');
        if($logsTable->save($log)){
            if(!Configure::read('debug')) {
                if (($log->level == 'emergency') ||
                    ($log->level == 'alert') ||
                    ($log->level == 'critical')) {
                    $this->sendLogs($level, $message, $log->created);
                }
                else if ($log->level == 'error') {
                    if($this->searchError404($log->id)){
                        $this->sendLogsError404($level, $message, $log->created);
                    }else{
                        $this->sendLogs($level, $message, $log->created);
                    }
                }
            }
        }
    }

    private function sendLogs($level, $message, $created)
    {
        $settings = [
            'channel' => '#tidigital-errors',
            'link_names' => true,
        ];
        $client = new SlackClient('https://hooks.slack.com/services/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', $settings);

        $messageSend = "Informamos que houve um novo Log de Erro no Sistema TIDigital.\n\nNivel:\n ".$level. "\n\nMensagem:\n". $message . " \n\nOcorrido em: ".$created;
        try{
            $client->send($messageSend);
        }
        catch(SocketException $e) {
            $this->Flash->error('Failed to send error log: ' . $e);
        }
    }

    private function sendLogsError404($level, $message, $created)
    {
        $settings = [
            'channel' => '#tidigital-404',
            'link_names' => true,
        ];
        $client = new SlackClient('https://hooks.slack.com/services/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', $settings);

        $messageSend = "Informamos que houve um novo Log Error 404 no Sistema TIDigital.\n\nNivel:\n ".$level. "\n\nMensagem:\n". $message . " \n\nOcorrido em: ".$created;
        try{
            $client->send($messageSend);
        }
        catch(SocketException $e){
            $this->Flash->error('Failed to send error log: '. $e);
        }
    }

    private function searchError404($id){
        $logsTable = TableRegistry::get('Logs');
        $query = $logsTable->find('all')
            ->where(['id' => $id])
            ->andWhere(['Logs.message LIKE' => "%NotFoundException%"])
            ->orWhere(['Logs.message LIKE' => "%MissingActionException%"])
            ->orWhere(['Logs.message LIKE' => "%MissingControllerException%"])
            ->andWhere(['id' => $id]);

        if($query->count() != 0){
            return true;
        }else{
            return false;
        }
    }
}

?>