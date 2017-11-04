<?php
namespace SignUp\User\Controller;

use Cake\Network\Exception\SocketException;
use SignUp\User\Controller\AppController;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Accounts\Base\Controller\Component\UsersAuthComponent;
use Cake\Mailer\Email;


/**
 * Users Controller
 *
 * @property \SignUp\Employee\Model\Table\UsersTable $Users
 */
class VerifyAccountController extends AppController
{
    use CustomUsersTableTrait;
    use RegisterTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('SignUp/Employee.Users');
    }

    public function index()
    {
        $query = $this->Users
            ->find('all')
            ->where(['Users.active' => false])
            ->orderDesc('created');

        $users = $this->paginate($query);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function reject($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_REJECT_ACCOUNT, [
                'user' => $user,
            ]);
            $this->sendMailUserReject($user);
            $this->Flash->success(__d('SignUp/user', 'Rejected successfully.'));
        } else {
            $this->Flash->error(__d('SignUp/user', 'An error occurred while rejecting user. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function accept($id = null, $category_id)
    {
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->get($id);
        $user->active = 1;
        if($usersTable->save($user)) {
            $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_ACCEPT_ACCOUNT, [
                'user' => $user,
            ]);
            $this->sendMailUserAccept($user);
            $this->Flash->success(__d('SignUp/user', 'Accepted successfully.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('SignUp/user', 'An error occurred while accepting user. Please, try again.'));
    }

    private function sendMailUserAccept ($user)
    {
        $email = new Email();
        $email->setProfile(['transport' => 'default'])
            ->setTemplate('SignUp/User.user_accepted')
            ->setEmailFormat('html')
            ->setViewVars(['first_name' => $user['first_name']])
            ->setTo($user['email'])
            ->setSubject('Cadastro de Usuário');
        try
        {
            $email->send();
        }
        catch(SocketException $e)
        {
            $this->Flash->error(__d('SignUp/user', 'Failed to send email to the user: '. $e));
        }
    }

    private function sendMailUserReject($user)
    {
        $email = new Email();
        $email->setProfile(['transport' => 'default'])
            ->setTemplate('SignUp/User.user_rejected')
            ->setEmailFormat('html')
            ->setViewVars(['first_name' => $user['first_name']])
            ->setTo($user['email'])
            ->setSubject('Cadastro de Usuário');
        try
        {
            $email->send();
        }
        catch(SocketException $e)
        {
            $this->Flash->error(__d('SignUp/user', 'Failed to send email to the user: '. $e));
        }
    }
}
