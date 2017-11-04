<?php
namespace Audit\Controller;

use Audit\Controller\AppController;

/**
 * AuditLogs Controller
 *
 * @property \Audit\Model\Table\AuditLogsTable $AuditLogs
 */
class AuditLogsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->AuditLogs
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', $this->AuditLogs->filterParams($this->request->query))
            // You can add extra things to the query if you need to
            ->contain(['Users'])
            ->order(['AuditLogs.timestamp' => 'DESC']);

        $this->set('auditLogs', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Audit Log id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $auditLog = $this->AuditLogs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('auditLog', $auditLog);
        $this->set('_serialize', ['auditLog']);
    }
}
