<?php
namespace Audit\Controller;

use Audit\Controller\AppController;

/**
 * UserAccessLogs Controller
 *
 * @property \Audit\Model\Table\UserAccessLogsTable $UserAccessLogs
 */
class UserAccessLogsController extends AppController
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
        $query = $this->UserAccessLogs
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', $this->UserAccessLogs->filterParams($this->request->query))
            // You can add extra things to the query if you need to
            ->contain(['Users'])
            ->order(['UserAccessLogs.created' => 'DESC']);

        $this->set('userAccessLogs', $this->paginate($query));

//        $this->paginate = [
//            'contain' => ['Users'],
//            'order' => ['UserAccessLogs.created' => 'DESC']
//        ];
//        $userAccessLogs = $this->paginate($this->UserAccessLogs);
//
//        $this->set(compact('userAccessLogs'));
//        $this->set('_serialize', ['userAccessLogs']);
    }

    /**
     * View method
     *
     * @param string|null $id User Access Log id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userAccessLog = $this->UserAccessLogs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userAccessLog', $userAccessLog);
        $this->set('_serialize', ['userAccessLog']);
    }
}
