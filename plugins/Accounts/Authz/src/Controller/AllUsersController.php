<?php

namespace Accounts\Authz\Controller;

use Accounts\Authz\Controller\AppController;
use Accounts\Base\Model\Table\UsersTable;
use Cake\Event\Event;
use Accounts\Base\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
use CakeDC\Users\Controller\Traits\PasswordManagementTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\Routing\Router;

class AllUsersController extends AppController
{
    use CustomUsersTableTrait;
    use SimpleCrudTrait;
    use PasswordManagementTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Actions');
        $this->loadComponent('Accounts/Authz.Menu');
        $this->loadModel('Accounts/Authz.SimpleRbac');
    }

    public function authorization($user_id=null)
    {
        $this->set('plugins', $this->listPlgs());
        $this->set('prefix', ['*' => '*', 'admin' => 'admin', 'api' => 'api']);
        $this->set('extension', ['*' => '*', 'json' => 'json', 'xml' => 'xml']);
    }

    public function addAuthorization()
    {
        $params = $this->request->query;

        $plugin = ($params['plugin'] == 'null' || $params['plugin'] == '' || $params['plugin'] == '*' ? '*' : Text::slug($params['plugin'], '/'));
        $controller = ($params['controller']  == 'null' || $params['controller'] == '' || $params['controller'] == '*' ? '*' : Text::slug($params['controller'], '/'));
        $action = ($params['action']  == 'null' || $params['action'] == '' || $params['action'] == '*' ? '*' : $params['action']);
        $prefix = ($params['prefix'] == '' ? '*' : $params['prefix']);
        $extension = ($params['extension'] == '' ? '*' : $params['extension']);
        $access_type = ($params['access_type'] == 'Denied' ? '0' : '1');
        $actions_splited = explode(',', $action);

        foreach ($actions_splited as $action_splited) {
            $alreadIsAuthorized = $this->SimpleRbac->find('all')
                ->where([
                    'role' => 'user',
                    'plugin' => $plugin,
                    'controller' => $controller,
                    'action' => $action_splited,
                    'prefix' => $prefix,
                    'extension' => $extension,
                    'allowed' => $access_type
                ])
                ->count();

            if ($alreadIsAuthorized) {
                return;
            }

            $simpleRbacEntity = $this->SimpleRbac->newEntity();
            $simpleRbacEntity->role = 'user';
            $simpleRbacEntity->plugin = $plugin;
            $simpleRbacEntity->controller = $controller;
            $simpleRbacEntity->action = $action_splited;
            $simpleRbacEntity->prefix = $prefix;
            $simpleRbacEntity->extension = $extension;
            $simpleRbacEntity->allowed = $access_type;
            $this->SimpleRbac->save($simpleRbacEntity);
        }
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
        $authorization = $this->SimpleRbac->get($id);
        $user_id = $authorization->user_id;
        if ($this->SimpleRbac->delete($authorization)) {
            $this->Flash->success( __d('Accounts/authz','The authorization has been deleted.'));
        } else {
            $this->Flash->error(__d('Accounts/authz','The authorization could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'authorization', $user_id]);
    }

    public function menu()
    {
        $allUsersMenu = $this->Menu->getAllUsersMenu('treeList');
        $this->set('all_users_menu', $allUsersMenu);
    }

    private function listPlgs()
    {
        $plugins = $this->Actions->listPlugins();
        return $this->arraySlug($plugins);
    }

    public function listAuthorizations()
    {
        $authorizations = $this->SimpleRbac->find('all')
            ->where(['role'=>'user'])
            ->order(['plugin', 'controller', 'action']);
        $this->set(compact('authorizations'));
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
}