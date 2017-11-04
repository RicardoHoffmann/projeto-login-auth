<?php

namespace Accounts\Profile\Controller;

use Accounts\Profile\Controller\AppController;
use App\Model\Table\MyUsersTable;
use Cake\Event\Event;
use Accounts\Base\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use CakeDC\Users\Controller\Traits\PasswordManagementTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Cake\Core\Configure;

class UsersController extends AppController
{
    use CustomUsersTableTrait;
    use ProfileTrait;
    use PasswordManagementTrait;

    public function index()
    {
        $this->loadModel('UserAccessLogs');

        $accessLogs = $this->UserAccessLogs->find('all')
            ->where(['user_id' => $this->Auth->user('id')])
            ->order(['created' => 'desc'])
            ->limit(10);

        $this->set(compact('accessLogs'));

        $this->profile();
    }

    /**
     * Change password
     *
     * @return void|\Cake\Network\Response
     */
    public function changePassword()
    {
        $user = $this->getUsersTable()->newEntity();
        $id = $this->Auth->user('id');
        if (!empty($id)) {
            $user->id = $this->Auth->user('id');
            $validatePassword = true;
            //@todo add to the documentation: list of routes used
            $redirect = ['plugin' => 'Accounts/Profile', 'controller' => 'Users', 'action' => 'index'];
        } else {
            $user->id = $this->request->session()->read(Configure::read('Users.Key.Session.resetPasswordUserId'));
            $validatePassword = false;
            //@todo add to the documentation: list of routes used
            $redirect = $this->Auth->config('loginAction');
        }
        $this->set('validatePassword', $validatePassword);
        if ($this->request->is('post')) {
            try {
                $user = $this->getUsersTable()->patchEntity($user, $this->request->data(), ['validate' => 'passwordConfirm']);

                $currentUser = $this->Users->get($user->id, [
                    'contain' => []
                ]);

                if (!$user->checkPassword($user->current_password, $currentUser->password)) {
                    $this->Flash->error(__d('Users', 'The old password does not match'));
                    $this->set(compact('user'));
                    $this->set('_serialize', ['user']);
                    return;
                }

                if ($user->errors()) {
                    $this->Flash->error(__d('Users', 'Password could not be changed'));
                } else {
                     $user = $this->getUsersTable()->changePassword($user);
                    if ($user) {
                        $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_CHANGE_PASSWORD, [
                            'plain_text_password' => $this->request->data(),
                            'username' => $this->Auth->user('username'),
                        ]);
                        $this->Flash->success(__d('Users', 'Password has been changed successfully'));
                        return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('Users', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('Users', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error(__d('Users', 'The current password does not match'));
            } catch (Exception $exception) {
                $this->Flash->error(__d('Users', 'Password could not be changed'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function changeEmail()
    {
        $userTable = $this->getUsersTable();
        $user = $userTable->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $userTable->patchEntity($user, $this->request->data);
            if ($userTable->save($user)) {
                $this->Flash->success(__d('Accounts/profile', 'E-mail has been saved'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('Accounts/profile', 'E-mail could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('user'));
    }
}