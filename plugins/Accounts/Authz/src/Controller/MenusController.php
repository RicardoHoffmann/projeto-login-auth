<?php
namespace Accounts\Authz\Controller;

use Accounts\Authz\Controller\AppController;
use Cake\Utility\Text;
use Cake\Routing\Router;

class MenusController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Actions');
        $this->loadComponent('Accounts/Authz.Menu');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $menus = $this->Menu->getAdminMenu('treeList');

        $this->set(compact('menus'));
        $this->set('_serialize', ['menus']);
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus', 'Actions', 'ChildMenus']
        ]);

        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__d('Accounts/authz','The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('Accounts/authz','The menu could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->find('treeList', [
            'keyPath' => 'id',
            'valuePath' => 'name',
            'spacer' => '--',
            'limit' => 200
        ])
            ->where(['OR' => [['plugin' => ''], ['plugin IS' => null]]])
            ->where(['OR' => [['controller' => ''], ['controller IS' => null]]])
            ->where(['OR' => [['action' => ''], ['action IS' => null]]]);
        
        $plugins = $this->listPlgs();
        $this->set(compact('menu', 'parentMenus', 'plugins'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__d('Accounts/authz','The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('Accounts/authz','The menu could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->find('treeList', [
            'keyPath' => 'id',
            'valuePath' => 'name',
            'spacer' => '--',
            'limit' => 200
        ])
        ->where(['OR' => [['plugin' => ''], ['plugin IS' => null]]])
        ->where(['OR' => [['controller' => ''], ['controller IS' => null]]])
        ->where(['OR' => [['action' => ''], ['action IS' => null]]]);

        $plugins = $this->listPlgs();
        $this->set(compact('menu', 'parentMenus', 'actions', 'plugins'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__d('Accounts/authz','The menu has been deleted.'));
        } else {
            $this->Flash->error(__d('Accounts/authz','The menu could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
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

    public function listActs($plugin_controller=null)
    {
        if (!$plugin_controller) {
            return;
        }

        $plugin_controller_array = explode('--', $plugin_controller);
        if (count($plugin_controller_array) < 2) {
            return;
        }

        $plugin = Text::slug($plugin_controller_array[0], '/');
        $controller = Text::slug($plugin_controller_array[1], '/');
        $raw_actions = $this->Actions->listControllerActions($plugin, $controller);

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
}
