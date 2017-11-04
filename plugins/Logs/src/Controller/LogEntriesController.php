<?php
namespace Logs\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Database\Schema\Table;
use Cake\ORM\TableRegistry;
use Search\Manager;


class LogEntriesController extends AppController
{

    public $paginate = [
        'limit' => 10,
        'order' => [
            'Logs.created' => 'desc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    public function index()
    {
        $table = $this->loadModel('Logs.Logs');
        $query = $table->find('all')
            ->find('search', $table->filterParams($this->request->query));

        $this->set('logs', $this->paginate($query));
    }

    public function view($id = null)
    {
        $logsTable = TableRegistry::get('Logs');
        $log = $logsTable->get($id, [
            'contain' => []
        ]);

        $this->set('log', $log);
        $this->set('_serialize', ['log']);
    }
}
