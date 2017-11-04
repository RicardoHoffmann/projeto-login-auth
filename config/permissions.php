<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\ORM\TableRegistry;
use Cake\Network\Request;
use Cake\Utility\Hash;
use Cake\Auth;

/*
 * This is a quick roles-permissions implementation
 * Rules are evaluated top-down, first matching rule will apply
 * Each line define
 *      [
         *          'role' => 'admin',
         *          'plugin', (optional, default = null)
         *          'prefix', (optional, default = null)
         *          'extension', (optional, default = null)
         *          'controller',
         *          'action',
         *          'allowed' (optional, default = true)
 *      ]
 * You could use '*' to match anything
 * 'allowed' will be considered true if not defined. It allows a callable to manage complex
 * permissions, like this
 * 'allowed' => function (array $user, $role, Request $request) {}
 *
 * Example, using allowed callable to define permissions only for the owner of the Posts to edit/delete
 *
 * (remember to add the 'uses' at the top of the permissions.php file for Hash, TableRegistry and Request
   [
        'role' => ['user'],
        'controller' => ['Posts'],
        'action' => ['edit', 'delete'],
        'allowed' => function(array $user, $role, Request $request) {
            $postId = Hash::get($request->params, 'pass.0');
            $post = TableRegistry::get('Posts')->get($postId);
            $userId = Hash::get($user, 'id');
            if (!empty($post->user_id) && !empty($userId)) {
                return $post->user_id === $userId;
            }
            return false;
        }
    ],
 */

/**
 * AUTH_USER_OR_GROUP (ou separado)
 * AUTH_EVERYONE
 **/

//debug(Request::session()->read('Auth.User'));

$user_id = $_SESSION['Auth']['User']['id'];

$authByUser = function (array $user, $role, Request $request) {
    $userId = Hash::get($user, 'id');
    return true;
};

$rules = [
    'Users.SimpleRbac.permissions' => [
        //admin role allowed to use CakeDC\Users plugin actions
        [
            'role' => 'admin',
            'plugin' => '*',
            'controller' => '*',
            'action' => '*',
        ],
        //specific actions allowed for the user role in Users plugin
        [
            'role' => 'user',
            'plugin' => 'Accounts/Auth',
            'controller' => 'Users',
            'action' => ['logout'],
        ],
        [
            'role' => 'user',
            'plugin' => 'Accounts/Profile',
            'controller' => 'Users',
            'action' => '*'
        ],
        //all roles allowed to Pages/display
        [
            'role' => '*',
            'plugin' => null,
            'controller' => ['Pages'],
            'action' => ['display'],
        ],
        [
            'role' => '*',
            'plugin' => 'Accounts/Authz',
            'controller' => 'Prefixes',
            'action' => 'start',
            'allowed' => $authByUser
        ],
    ]
];

$db_rules_everyone = TableRegistry::get('SimpleRbac')
    ->find('all')
    ->select([
        'role',
        'prefix',
        'plugin',
        'controller',
        'action',
        'extension',
        'allowed',
    ])
    ->hydrate(false)
    ->toArray();

foreach ($db_rules_everyone as $db_rule_everyone) {
        array_push($rules['Users.SimpleRbac.permissions'], $db_rule_everyone);
}

$db_rules_user = TableRegistry::get('Accounts/Authz.SimpleRbacUsers')
    ->find('all')
    ->where(['user_id' => $user_id])
    ->contain(['Users'])
    ->select([
        'Users.role',
        'SimpleRbacUsers.prefix',
        'SimpleRbacUsers.plugin',
        'SimpleRbacUsers.controller',
        'SimpleRbacUsers.action',
        'SimpleRbacUsers.extension',
        'SimpleRbacUsers.allowed',
    ])
    ->hydrate(false)
    ->toArray();

foreach ($db_rules_user as $db_rule_user) {
    $db_rule_user['role'] = $db_rule_user['user']['role'];
    unset($db_rule_user['user']);
    if (sizeof(explode(',', $db_rule_user['action'])) > 1) {
        $db_rule_user['action'] = explode(',', $db_rule_user['action']);
    } else {
        $db_rule_user['action'] = $db_rule_user['action'];
    }
    array_push($rules['Users.SimpleRbac.permissions'], $db_rule_user);
}

// regras por grupo
$db_rules_group = TableRegistry::get('Accounts/Authz.SimpleRbacGroups')
    ->find('all')
    ->contain('Groups.UserGroups.Users')
    ->matching('Groups.UserGroups.Users', function ($q) use ($user_id) {
        return $q->where(['Users.id' => $user_id]);
    })
    ->select([
        'Users.role',
        'SimpleRbacGroups.prefix',
        'SimpleRbacGroups.plugin',
        'SimpleRbacGroups.controller',
        'SimpleRbacGroups.action',
        'SimpleRbacGroups.extension',
        'SimpleRbacGroups.allowed',
    ])
    ->hydrate(false)
    ->toArray();

foreach ($db_rules_group as $db_rule_group) {
    $db_rule_group['role'] = '*';
    array_push($rules['Users.SimpleRbac.permissions'], $db_rule_group);
}

return $rules;