<?php
namespace Accounts\Admin\Controller;

use Accounts\Admin\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Search\Manager;

/**
 * Groups Controller
 *
 * @property \Accounts\Admin\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{
    public $paginate = [
        'order' => [
            'Groups.name' => 'asc'
        ]
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index', 'viewAddUsers']
        ]);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $table = $this->loadModel(Configure::read('Groups.table'));
        $query = $table->find('all')
            ->find('search', $table->filterParams($this->request->query));

        $this->set('groups', $this->paginate($query));
    }

    public function viewAddUsers($id = null)
    {
        $this->listUsers($id);
        $this->userListGroup($id);

        $session = $this->request->session();
        $session->write('Accounts/Admin.Groups.id', $id);
    }

    /**
     * Lista todos os usuario do BD
     */
    public function listUsers($id = null)
    {
        $userGroupsTable = TableRegistry::get('user_groups');
        $table = $this->loadModel(Configure::read('Users.table'));
        $query = $table->find('all')
                            ->find('search', $table->filterParams($this->request->query))
                            ->where(['Users.active != ' => 0])
                            ->andWhere(['Users.id NOT IN' => $userGroupsTable->find('all')
                                                                ->select('user_id')
                                                                ->where(['user_groups.group_id' => $id])])
                    ->order(['Users.first_name' => 'ASC', 'Users.last_name' => 'ASC', 'Users.username' => 'ASC']);
        $this->paginate = [
            'maxLimit' => 10
        ];
        $tableAlias = $table->alias();
        $this->set($tableAlias, $this->paginate($query));
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }

    /**
     * Lista todos os usuario ja pertencentes ao grupo
     */
    public function userListGroup ($id = null)
    {
        $usersTable = TableRegistry::get('Users');
        $userGroupsTable = TableRegistry::get('user_groups');
        $query = $usersTable->find('all')
                    ->where(['Users.id IN' =>
                        $userGroupsTable->find('all')
                                ->select('user_id')
                                ->where(['group_id IN' =>
                                    $this->Groups->find('all')
                                            ->select('id')
                                            ->where(['Groups.id' => $id])
                                ])
                    ])
                    ->orderAsc('Users.username');
        $this->set('usersGroup', $query);
        $this->set('_serialize', ['usersGroup']);
    }

    public function includeUser($id = null)
    {
        $session = $this->request->session();
        $group_id = $session->read('Accounts/Admin.Groups.id');
        $userGroupsTable = TableRegistry::get('user_groups');
        $userGroups = $userGroupsTable->newEntity();
        $userGroups = $userGroupsTable->patchEntity($userGroups, $this->request->data);
        $userGroups->group_id = $group_id;
        $userGroups->user_id = $id;

        if ($userGroupsTable->save($userGroups)) {
            $this->Flash->success(__d('Accounts/admin', 'User Include.'));
            return $this->redirect(['action' => 'view_add_users', $group_id]);
        } else {
            $this->Flash->error(__d('Accounts/admin', 'User not include. Please, try again.'));
            return $this->redirect(['action' => 'view_add_users', $group_id]);
        }
    }

    /**
     * Remove um usuario do grupo
     */
    public function removeUser($id = null)
    {
        $session = $this->request->session();
        $group_id = $session->read('Accounts/Admin.Groups.id');
        $userGroupsTable = TableRegistry::get('user_groups');
        $query = $userGroupsTable->find('list')
            ->where(['user_groups.user_id' => $id])
            ->andWhere(['user_groups.group_id' => $group_id]);

        $entity = $userGroupsTable->get($query->toArray());
        if ($userGroupsTable->delete($entity)) {
            $this->Flash->success(__d('Accounts/admin', 'User removed.'));
            return $this->redirect(['action' => 'view_add_users', $group_id]);
        } else {
            $this->Flash->error(__d('Accounts/admin', 'User not removed. Please, try again.'));
            return $this->redirect(['action' => 'view_add_users', $group_id]);
        }
    }

    /*
     * View method
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id);
        $this->participatingUsers($id);
        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    public function participatingUsers($id = null)
    {
        $userGroupsTable = TableRegistry::get('user_groups');
        $usersTable = TableRegistry::get('Users');

        $users = $usersTable->find('all')
            ->where(['Users.id IN' =>
                $userGroupsTable->find('all')
                    ->select('user_id')
                    ->where(['user_groups.group_id' => $id])
            ])
            ->orderAsc('Users.first_name');
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /*
     * Add method
     */
    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__d('Accounts/admin', 'The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('Accounts/admin', 'The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /*
     * Edit method
     */
    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__d('Accounts/admin', 'The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('Accounts/admin', 'The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }
}
