<?php

namespace Accounts\Auth\Controller;

use Accounts\Auth\Controller\AppController;
use Accounts\Base\Model\Table\UsersTable;
use Accounts\Base\Hasher\WeakPasswordWithoutSaltHasher;
use Accounts\Base\Controller\Traits\PasswordManagementTrait;
use Cake\Chronos\Date;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\ServerRequest;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Network\Response;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\CustomUsersTableTrait;
use Cake\Core\Configure;
use DateTime;
use DateTimeZone;
use Maknz\Slack\Client as SlackClient;


class UsersController extends AppController
{
    use LoginTrait;
    use PasswordManagementTrait;

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['renderCaptcha']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    /**
     * Login user
     *
     * @return mixed
     */

    public function login()
    {
        $secretKey = Configure::read('Accounts.auth.login.secretKey');
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_LOGIN);
        if (is_array($event->result)) {

            return $this->_afterIdentifyUser($event->result);
        }
        if ($event->isStopped()) {
            return $this->redirect($event->result);
        }

        $socialLogin = $this->_isSocialLogin();

        if ($this->request->is('post')) {
            if ($this->needVeriryCaptcha($this->request->data('username'))) {
                $recaptcha = new \ReCaptcha\ReCaptcha( $secretKey );
                $response = $recaptcha->verify( $this->request->data['g-recaptcha-response'], $this->request->clientIp() );

                if (!$this->userBlocked($this->request->data('username'))) {
                    if (!$response->isSuccess()) {
                        $this->Flash->error(__d('Accounts/auth', 'Invalid ReCaptcha'));
                        $this->controlLoginAttempts($this->request->data('username'));
                        return;
                    }
                }
            }

            $user = $this->Auth->identify();

            if ($user) {
                if ($this->userBlocked($this->request->data('username'))) {
                    $this->Flash->error(__d('Accounts/auth', 'Sorry, your account has been temporarily blocked.'));
                    return;
                } else {
                    $userTable = TableRegistry::get('Users');
                    $query = $userTable->query();
                    $query->update()
                        ->set([
                            'last_attempt = ' => null,
                            'blocked_time = ' => null,
                            'login_attempts = ' => 0
                        ])
                        ->where(['username' => $this->request->data('username')])
                        ->execute();

                    $this->Auth->setUser($user);
                    if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                        $user = $this->Users->get($this->Auth->user('id'));
                        $user->password = (new DefaultPasswordHasher)->hash($this->request->data('password'));
                        $this->Users->save($user);
                        $user = $this->Auth->identify();
                    }
                    return $this->_afterIdentifyUser($user, $socialLogin);
                }

                //return $this->redirect($this->Auth->redirectUrl());
            } else {
                $idUser = $this->getIdUser($this->request->data('username'));
                $username = $this->request->data('username');
                if ($idUser->count() != 0) {
                    if ($this->userBlocked($username)) {
                        $this->Flash->error(__d('Accounts/auth', 'Sorry, your account has been temporarily blocked.'));
                        return;
                    }
                    $this->controlLoginAttempts($this->request->data('username'));
                    $eventFail = new Event('Users.Component.UsersAuth.failedLogin', [
                        'username' => $username,
                        'id' => $idUser
                    ]);
                    $this->eventManager()->dispatch($eventFail);

                    return $this->_afterIdentifyUser($event->result);
                } else {
                    return $this->_afterIdentifyUser($event->result);
                }
            }
        }
        if (!$this->request->is('post') && !$socialLogin) {
            if ($this->Auth->user()) {
//                $msg = __d('Accounts/auth', 'You are already logged in');
//                $this->Flash->error($msg);
                $url = $this->Auth->redirectUrl();
                return $this->redirect($url);
            }
        }
    }

    private function userBlocked($username)
    {
        $timeBlockedWait = Configure::read('Accounts.auth.login.timeblocked');
        $users = $this->Users
            ->find()
            ->where(['username' => $username])
            ->first();

        if ($users->blocked_time == null) {
            return false;
        } else {
            $blockedTime = $users->blocked_time->format('Y-m-d H:i:s');
            $blockedDateTime = new DateTime($blockedTime);
            $currentDateTime = new DateTime($this->getCurrDateTime());

            $interval = $currentDateTime->diff($blockedDateTime);
            $interval = $interval->format('%H:%I:%S');

            if ($interval <= $timeBlockedWait) {
                $timeWait = strtotime($timeBlockedWait) - strtotime($interval);
                $timeWait = date('i:s',mktime(0,0,$timeWait));
                return true;
            } else {
                $userTable = TableRegistry::get('Users');
                $query = $userTable->query();
                $query->update()
                    ->set(['blocked_time =' => null])
                    ->where(['username' => $username])
                    ->execute();
                return false;
            }
        }
    }

    private function getIdUser($username)
    {
        $userTable = TableRegistry::get('Users');
        $query = $userTable->find('all', [
                'conditions' => ['username = '=> $username]
        ]);
        return $query->select('id');
    }

    private function getCurrDateTime()
    {
        $newTZ = new DateTimeZone('America/Sao_paulo');
        $date = new DateTime();
        $date->setTimezone( $newTZ );
        return $date->format('Y-m-d H:i:s');
    }

    private function controlLoginAttempts($username)
    {
        $userTable = TableRegistry::get('Users');
        $users = $this->Users
            ->find()
            ->where(['username' => $username])
            ->first();

        if ($users) {
            $query = $userTable->query();

            if ($users->last_attempt == null) {
                $query->update()
                    ->set([
                        'last_attempt = ' => $this->getCurrDateTime(),
                        'login_attempts' => 1
                    ])
                    ->where(['username' => $username])
                    ->execute();
            } else {
                $timeBlockedWait = Configure::read('Accounts.auth.login.timeblocked');
                $timeInterval = Configure::read('Accounts.auth.login.timeInterval');
                $lastAttempt = $users->last_attempt->format('Y-m-d H:i:s');
                $lastAttemptTime = new DateTime($lastAttempt);
                $now = new DateTime($this->getCurrDateTime());

                $interval = $now->diff($lastAttemptTime);
                $interval = $interval->format('%H:%I:%S');


                if ($interval <= $timeInterval) {
                    $query->update()
                        ->set([
                            'last_attempt = ' => $this->getCurrDateTime(),
                            'login_attempts = login_attempts + 1'
                        ])
                        ->where(['username' => $username])
                        ->execute();
                } else {
                    $query->update()
                        ->set([
                            'last_attempt = ' => $this->getCurrDateTime(),
                            'login_attempts = ' => 1
                        ])
                        ->where(['username' => $username])
                        ->execute();
                }
            }
            $users = $this->Users
                ->find()
                ->where(['username' => $username])
                ->first();

            $attemptsBeforeLocking = Configure::read('Accounts.auth.login.loginAttempts');
            if ($users->login_attempts == $attemptsBeforeLocking) {
                $query->update()
                    ->set([
                        'blocked_time = ' => $this->getCurrDateTime()
                    ])
                    ->where(['username' => $username])
                    ->execute();
                $this->sendMailUserBlocked($users);
                $this->sendSlackUserBlocked($username);
            }
        }
    }

    public function renderCaptcha($username)
    {
        $siteKey = Configure::read('Accounts.auth.login.siteKey');
        $lang = Configure::read('Accounts.auth.login.lang');;

        $showCaptcha = false;
        $this->set([
            'siteKey' => $siteKey,
            'lang' => $lang
        ]);
        $users = $this->Users
            ->find()
            ->where(['username' => $username])
            ->first();

        if ($users) {
            $attempts_before_captcha = Configure::read('Accounts.auth.login.attemptsBeforeCaptcha');
            if ($users->login_attempts >= $attempts_before_captcha) {
                $showCaptcha = true;
            }
        }

        $this->set(compact('showCaptcha'));
    }

    public function needVeriryCaptcha($username = null)
    {
        $users = $this->Users
            ->find()
            ->where(['username' => $username])
            ->first();
        if ($users) {
            $attempts_before_captcha = Configure::read('Accounts.auth.login.attemptsBeforeCaptcha');
            if ($users->login_attempts >= $attempts_before_captcha) {
                return true;
            }
        }
        return false;
    }

    public function sendMailUserBlocked($user)
    {
        $login_attempts = Configure::read('Accounts.auth.login.loginAttempts');
        $time_wait = Configure::read('Accounts.auth.login.timeblocked');
        $email = new Email();
        $email->profile(['transport' => 'default'])
            ->template('Accounts/Auth.blocked_account')
            ->emailFormat('html')
            ->viewVars([
                'first_name' => $user->first_name,
                'login_attempts' => $login_attempts,
                'time_wait' => $time_wait
            ])
            ->to($user->email)
            ->subject('Conta Bloqueada');

        try
        {
            $email->send();
        }
        catch(SocketException $e)
        {
            $this->Flash->error(__d('Accounts/auth', 'Failed to send email to the user: '. $e));
        }
    }

    private function sendSlackUserBlocked($username)
    {
        $settings = [
            'channel' => '#security',
            'link_names' => true,
        ];
        $client = new SlackClient('https://hooks.slack.com/services/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', $settings);

        $messageSend = "[ACCOUNT-LOCKOUT] Usuário '".$username."' foi bloqueado temporariamente.";
        try{
            $client->send($messageSend);
        }
        catch(SocketException $e) {
            $this->Flash->error(__d('Accounts/auth', 'Failed to send Slack message: ' . $e));
        }
    }
}