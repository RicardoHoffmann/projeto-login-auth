<?php
namespace SignUp\User\Controller;

use Cake\Mailer\Email;
use Cake\Network\Exception\SocketException;
use SignUp\User\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Core\Configure;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \SignUp\Employee\Model\Table\UsersTable $Users
 */
class RequestAccountController extends AppController
{
    use CustomUsersTableTrait;
    use RegisterTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('SignUp/User.Users');

        if ($this->Auth->user() && $this->request->url) {
            $this->Flash->error(__d('SignUp/user', 'Logoff before continue'));
            $this->redirect('/');
        }
        $this->Auth->allow(['register']);
    }

    public function register()
    {
        if (!Configure::read('Users.Registration.active')) {
            throw new NotFoundException();
        }

        $usersTable = $this->getUsersTable();
        $user = $usersTable->newEntity();
        $validateEmail = (bool)Configure::read('Users.Email.validate');
        $useTos = (bool)Configure::read('Users.Tos.required');
        $tokenExpiration = Configure::read('Users.Token.expiration');
        $options = [
            'token_expiration' => $tokenExpiration,
            'validate_email' => $validateEmail,
            'use_tos' => $useTos
        ];

        $requestData = $this->request->getData();
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_REGISTER, [
            'usersTable' => $usersTable,
            'options' => $options,
            'userEntity' => $user,
        ]);

        if ($event->result instanceof EntityInterface) {
            if ($userSaved = $usersTable->register($user, $event->result->toArray(), $options)) {
                return $this->_afterRegister($userSaved);
            }
        }
        if ($event->isStopped()) {
            return $this->redirect($event->result);
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);

        if (!$this->request->is('post')) {
            return;
        }

        $validPost = $this->_validateRegisterPost();
        if (!$validPost) {
            $this->Flash->error(__d('SignUp/user', 'The reCaptcha could not be validated'));
            return;
        }

        $userSaved = $usersTable->register($user, $requestData, $options);
        if (!$userSaved) {
            $this->Flash->error(__d('SignUp/user', 'The user could not be saved'));
            return;
        }

        $this->sendMailAdmin();

        return $this->_afterRegister($userSaved);
    }

    private function sendMailAdmin()
    {
        $admin_emails = TableRegistry::get('users');
        $admin_emails = $admin_emails->find('list', [
                                        'keyField' => 'id',
                                        'valueField' => 'email'
                                        ])
            ->where(['is_superuser' => true]);

        $email = new Email();
        $email->setProfile(['transport' => 'default'])
            ->setTemplate('SignUp/User.new_user')
            ->setEmailFormat('html')
            ->setTo($admin_emails->toArray())
            ->setSubject('Novo Usuário');

        try {
            $email->send();
        }
        catch(SocketException $e) {
            $this->Flash->error(__d('SignUp/user', 'Failed to send email to the Admin(s): '. $e));
        }
    }
}
