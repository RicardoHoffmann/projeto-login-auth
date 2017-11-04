<?php

namespace Accounts\Admin\Controller;

use Accounts\Admin\Controller\AppController;
use Accounts\Base\Model\Table\UsersTable;
use Cake\Database\Query;
use Cake\Event\Event;
use Accounts\Base\Controller\Component\UsersAuthComponent;
use Accounts\Base\Controller\Traits\SimpleCrudTrait;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\PasswordManagementTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class UsersController extends AppController
{
    use CustomUsersTableTrait;
    use SimpleCrudTrait;
    use PasswordManagementTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    public function view($id = null)
    {
        $table = $this->loadModel(Configure::read('Users.table'));
        $tableAlias = $table->alias();
        $entity = $table->get($id, [
            'contain' => []
        ]);
        $this->participatingGroups($id);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }
    /**
     * Mostra os grupos que o usuario participa
     */
    public function participatingGroups($id = null)
    {
        $userGroupsTable = TableRegistry::get('user_groups');
        $groupsTable = TableRegistry::get('Groups');

        $groups = $groupsTable->find('all')
                                ->where(['Groups.id IN' =>
                                        $userGroupsTable->find('all')
                                            ->select('group_id')
                                            ->where(['user_groups.user_id' => $id])
                                ])
                                ->orderAsc('Groups.name');
        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $table = $this->loadModel(Configure::read('Users.table'));

        $query = $table->find('all')
            ->find('search', $table->filterParams($this->request->query))
            ->order(['Users.first_name' => 'ASC', 'Users.last_name' => 'ASC', 'Users.username' => 'ASC']);;

        $tableAlias = $table->alias();
        $this->set($tableAlias, $this->paginate($query));
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
    }

    /**
     * Change password
     *
     * @return void|\Cake\Network\Response
     */
    public function changePassword($user_id=null)
    {
        $id = null;

        if ($user_id) {
            $query = $this->getUsersTable()->findById($user_id);
            if ($query->count()) {
                $id = $user_id;
            }
            $user = $this->getUsersTable()->newEntity();
        }
        if (!empty($id)) {
            $user->id = $id;
            $user->name = $query->first()->first_name . ' ' . $query->first()->last_name;
            $user->username = $query->first()->username;
            $validatePassword = false;
            //@todo add to the documentation: list of routes used
            $redirect = ['plugin' => 'Accounts/Admin', 'controller' => 'Users', 'action' => 'index'];
        } else {
            return $this->redirect(['plugin' => 'Accounts', 'controller' => 'Users', 'action' => 'index']);
        }
        $this->set('validatePassword', $validatePassword);
        if ($this->request->is('post')) {
            try {
                $user = $this->getUsersTable()->patchEntity($user, $this->request->data(), ['validate' => 'passwordConfirm']);
                if ($user->errors()) {
                    $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
                } else {
                    $user = $this->getUsersTable()->changePassword($user);
                    if ($user) {
                        $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_CHANGE_PASSWORD, [
                            'plain_text_password' => $this->request->data(),
                            'userEntity' => $user,
                        ]);                        
                        $this->Flash->success(__d('Accounts/admin', 'Password has been changed successfully'));
                        return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('Accounts/admin', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error(__d('Accounts/admin', 'The current password does not match'));
            } catch (Exception $exception) {
                $this->Flash->error(__d('Accounts/admin', 'Password could not be changed'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table = $this->loadModel(Configure::read('Users.table'));
        $tableAlias = $table->alias();
        $entity = $table->get($id, [
            'contain' => []
        ]);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
        if (!$this->request->is(['patch', 'post', 'put'])) {
            return;
        }

        $entity = $table->patchEntity($entity, $this->request->getData());
        $singular = Inflector::singularize(Inflector::humanize($tableAlias));
        if ($table->save($entity)) {
            $this->fireEventEnabledAccount($entity);
            $this->Flash->success(__d('Accounts/admin', 'The {0} has been saved', $singular));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('Accounts/admin', 'The {0} could not be saved', $singular));
    }

    private function fireEventEnabledAccount($user=null)
    {
        if ($this->request->getData('active') == true) {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_ENABLE_ACCOUNT, [
                'user' => $user,
            ]);
        } else {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_DISABLE_ACCOUNT, [
                'user' => $user,
            ]);
        }
    }

    public function delete()
    {
        $this->Flash->error(__d('Users', 'Forbidden'));
        return $this->redirect(['action' => 'index']);
    }
}