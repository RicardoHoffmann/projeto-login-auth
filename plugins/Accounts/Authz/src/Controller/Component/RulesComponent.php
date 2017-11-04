<?php

namespace Accounts\Authz\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class RulesComponent extends Component
{
    public function getAllUserRules()
    {
        $allUserRules = TableRegistry::get('SimpleRbac')
            ->find('all')
            ->select([
                'role',
                'prefix',
                'plugin',
                'controller',
                'action',
                'allowed',
            ])
            ->hydrate(false)
            ->toArray();

        return $allUserRules;
    }

    public function getUserRules()
    {
        $auth = $this->_registry->getController()->loadComponent('Auth');
        $userDbRules = TableRegistry::get('Accounts/Authz.SimpleRbacUsers')
            ->find('all')
            ->where(['user_id' => $auth->user('id')])
            ->contain(['Users'])
            ->select([
                'Users.role',
                'SimpleRbacUsers.prefix',
                'SimpleRbacUsers.plugin',
                'SimpleRbacUsers.controller',
                'SimpleRbacUsers.action',
                'SimpleRbacUsers.allowed',
            ])
            ->hydrate(false)
            ->toArray();

        $userRules = array();
        foreach ($userDbRules as $userDbRule) {
            $userDbRule['role'] = $userDbRule['user']['role'];
            unset($userDbRule['user']);
            $userDbRule['action'] = explode(',', $userDbRule['action']);
            array_push($userRules, $userDbRule);
        }

        return $userRules;
    }

    public function isAuthorized($plugin=null, $controller=null, $action=null, $user_id=null)
    {
        if (!$plugin || !$controller || !$action) {
            return false;
        }

        $auth = $this->_registry->getController()->loadComponent('Auth');

        if (!$user_id) {
            $user_id = $auth->user('id');
        }

        return TableRegistry::get('Accounts/Authz.SimpleRbacUsers')
            ->find('all')
            ->where([
                'user_id' => $user_id,
                'allowed' => true,
                'plugin' => $plugin
            ])
            ->where([
                'OR' => [['controller' => $controller], ['controller' => '*']]
            ])
            ->where([
                'OR' => [['action' => $action], ['action' => '*']]
            ])
            ->count() > 0;
    }
}