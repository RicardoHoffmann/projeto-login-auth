<?php
namespace Accounts\Authz\Controller;


use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
use CakeDC\Users\Controller\Traits\PasswordManagementTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
/**
 * Groups Controller
 *
 * @property \Accounts\Authz\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{
    use CustomUsersTableTrait;
    use SimpleCrudTrait;
    use PasswordManagementTrait;

    public $paginate = [
        'order' => [
            'Groups.name' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
        $this->loadComponent('Actions');
        $this->loadComponent('Accounts/Authz.Menu');
        $this->loadModel('Accounts/Authz.SimpleRbacGroups');
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
            ->find('search', $table->filterParams($this->request->query))
            ->order(['Groups.name' => 'ASC']);;

        $tableAlias = $table->alias();
        $this->set($tableAlias, $this->paginate($query));
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }

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

    public function authorization($group_id = null)
    {
        $table = $this->loadModel(Configure::read('Groups.table'));
        $group = $table->findById($group_id)
            ->first();

        $this->set('name', $group->name);
        $this->set('plugins', $this->listPlgs());
        $this->set('group_id', $group_id);
    }

    public function addAuthorization()
    {
        $params = $this->request->query;

        if (!$params['group_id']) {
            return;
        }

        $group_id = $params['group_id'];
        $plugin = ($params['plugin'] == 'null' || $params['plugin'] == '' ? '*' : Text::slug($params['plugin'], '/'));
        $controller = ($params['controller']  == 'null' || $params['controller'] == '' ? '*' : Text::slug($params['controller'], '/'));
        $action = ($params['action']  == 'null' || $params['action'] == '' ? '*' : $params['action']);
        $access_type = ($params['access_type'] == 'Denied' ? '0' : '1');

        $actions_splited = explode(',', $action);

        foreach ($actions_splited as $action_splited) {
            $alreadIsAuthorized = $this->SimpleRbacGroups->find('all')
                ->where([
                    'group_id' => $group_id,
                    'plugin' => $plugin,
                    'controller' => $controller,
                    'action' => $action_splited,
                    'allowed' => $access_type
                ])
                ->count();

            if ($alreadIsAuthorized) {
                return;
            }

            $simpleRbacGroupsEntity = $this->SimpleRbacGroups->newEntity();
            $simpleRbacGroupsEntity->group_id = $group_id;
            $simpleRbacGroupsEntity->plugin = $plugin;
            $simpleRbacGroupsEntity->controller = $controller;
            $simpleRbacGroupsEntity->action = $action_splited;
            $simpleRbacGroupsEntity->allowed = $access_type;
            $this->SimpleRbacGroups->save($simpleRbacGroupsEntity);
        }
    }

    public function listGroupAuthorizations($group_id=null)
    {
        $authorizations = $this->SimpleRbacGroups->findByGroupId($group_id)
            ->order(['plugin', 'controller', 'action']);
        $this->set(compact('authorizations'));
    }

    private function listPlgs()
    {
        $plugins = $this->Actions->listPlugins();
        return $this->arraySlug($plugins);
    }

    public function listCtls($plugin=null)
    {
        if (!$plugin) {
            return;
        }

        $parsed_plugin = Text::slug($plugin, '/');
        $controllers = $this->Actions->listSlugedControllers($parsed_plugin);

        $this->set(compact('controllers'));
        $this->set('_serialize', ['controllers']);
    }

    public function listActs($plugin=null, $controller=null)
    {
        if (!$plugin || !$plugin) {
            return;
        }

        $plugin_sluged = Text::slug($plugin, '/');
        $controller_sluged = Text::slug($controller, '/');
        $raw_actions = $this->Actions->listControllerActions($plugin_sluged, $controller_sluged);

        foreach ($raw_actions as $key => $value) {
            $actions[$value] = $value;
        }

        $this->set(compact('actions'));
        $this->set('_serialize', ['actions']);
    }

    private function arraySlug($array=null)
    {
        if (!$array) {
            return false;
        }

        $parsed_array = [];
        foreach ($array as $key => $value) {
            $parsed_array[Text::slug($value, '-')] = $value;
        }

        return $parsed_array;
    }

    public function groupMenu($group_id=null)
    {
        $groupMenu = $this->Menu->getGroupMenu($group_id, 'treeList');
        $this->set('group_id', $group_id);
        $this->set('group_menu', $groupMenu);
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $authorization = $this->SimpleRbacGroups->get($id);
        $group_id = $authorization->group_id;
        if ($this->SimpleRbacGroups->delete($authorization)) {
            $this->Flash->success(__d('Accounts/authz','The authorization has been deleted.'));
        } else {
            $this->Flash->error(__d('Accounts/authz','The authorization could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'authorization', $group_id]);
    }
}
