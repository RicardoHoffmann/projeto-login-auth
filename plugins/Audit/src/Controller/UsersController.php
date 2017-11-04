<?php
namespace Audit\Controller;

use Audit\Controller\AppController;

/**
 * Users Controller
 *
 * @property \Audit\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [
                'AuditLogs', 'Persons', 'SocialAccounts', 'UserAccessLogs',
                'Persons.Employees', 'Persons.Outsourceds', 'Persons.Students'
            ]
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function find()
    {
        if ($this->request->is('ajax')) {
            $term = $this->request->query('term');

            $users = $this->Users->find('all')
                ->select(['choice' => 'Users.username', 'label' => 'CONCAT(Users.first_name, \' \', Users.last_name)'])
                ->limit(10)
                ->where(['Users.username LIKE' => "%$term%"])
                ->hydrate(false)
                ->toArray();

            $this->set($users);
        }
    }
}
