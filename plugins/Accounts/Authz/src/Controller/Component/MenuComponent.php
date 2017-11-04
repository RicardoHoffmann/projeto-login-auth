<?php

namespace Accounts\Authz\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;

class MenuComponent extends Component
{
    public function get($format='threaded')
    {
        $auth = $this->_registry->getController()->loadComponent('Auth');
        if ($auth->user('role') == 'superuser') {
            return $this->getAdminMenu();
        }

        return $this->getUserMenu($auth->user('id'), $format);
    }

    public function getAdminMenu($format='threaded')
    {
        $userMenu = array();
        $auth = $this->_registry->getController()->loadComponent('Auth');
        if ($auth->user('role') != 'superuser') {
            return false;
        }

        $menusTable = TableRegistry::get('Accounts/Authz.Menus');
        $mainMenu = $menusTable->find('all')
            ->where([['plugin <>' => ''], ['plugin IS NOT' => null]])
            ->where([['controller <>' => ''], ['controller IS NOT' => null]])
            ->where([['action <>' => ''], ['action IS NOT' => null]]);

        foreach ($mainMenu as $menu) {
            $menu_with_path = $this->applyPathToAdminMenu($menu);

            foreach ($menu_with_path as $menu_item) {
                if (!in_array($menu_item, $userMenu)) {
                    array_push($userMenu, $menu_item);
                }
            }
        }

        $collection = (new Collection($userMenu))->sortBy('name', SORT_ASC, SORT_NATURAL);
        $nested = $collection->nest('id', 'parent_id');

        if ($format == 'treeList') {
            return $nested->listNested()->printer('name', 'id', '--')->toArray();
        }

        return ($nested->toArray());
    }

    public function getUserMenu($user_id=null, $format='threaded')
    {
        // user permissions
        $userMenu = array();
        $rbac = TableRegistry::get('Accounts/Authz.SimpleRbacUsers');
        $userPermissions = $rbac->find('all')
            ->where([
                'user_id' => $user_id,
                'allowed' => true]
            );

        // all users permission
        $rbacAllUsers = TableRegistry::get('Accounts/Authz.SimpleRbac');
        $allUserPermissions = $rbacAllUsers->find('all')
            ->where([
                'allowed' => true,
                'role' => 'user'
            ]);

        $unionUserAllUserPermissions = $userPermissions->unionAll($allUserPermissions);

        // group permissions
        $rbacGroupUsers = TableRegistry::get('Accounts/Authz.SimpleRbacGroups')
            ->find('all')
            ->matching('Groups.UserGroups.Users', function ($q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            })
            ->where([
                'allowed' => true
            ])
            ->select([
                'SimpleRbacGroups.id',
                'Users.role',
                'SimpleRbacGroups.prefix',
                'SimpleRbacGroups.plugin',
                'SimpleRbacGroups.controller',
                'SimpleRbacGroups.action',
                'SimpleRbacGroups.allowed',
                'SimpleRbacGroups.extension'
            ]);

        $unionUserAllUserGroupPermissions = $unionUserAllUserPermissions->unionAll($rbacGroupUsers);

        foreach ($unionUserAllUserGroupPermissions as $permission) {
            $menu = $this->getMenu(
                $permission->plugin,
                $permission->controller,
                $permission->action
            );

            $menu_with_path = $this->applyPathToMenu($menu);
            foreach ($menu_with_path as $menu_item) {
                if (!in_array($menu_item, $userMenu)) {
                    array_push($userMenu, $menu_item);
                }
            }
        }

        $collection = (new Collection($userMenu))->sortBy('name', SORT_ASC, SORT_NATURAL);
        $nested = $collection->nest('id', 'parent_id');

        if ($format == 'treeList') {
            return $nested->listNested()->printer('name', 'id', '--')->toArray();
        }

        return ($nested->toArray());
   }

    public function getGroupMenu($group_id=null, $format='threaded')
    {
        $groupMenu = array();
        $rbac = TableRegistry::get('Accounts/Authz.SimpleRbacGroups');
        $permissions = $rbac->find('all')
            ->where([
                    'group_id' => $group_id,
                    'allowed' => true]
            );

        $rbacAllGroups = TableRegistry::get('Accounts/Authz.SimpleRbac');
        $permissionsAllGroups = $rbacAllGroups->find('all')
            ->where(['allowed' => true]);

        $unionPermissions = $permissions->unionAll($permissionsAllGroups);
        foreach ($unionPermissions as $permission) {
            $menu = $this->getMenu(
                $permission->plugin,
                $permission->controller,
                $permission->action
            );

            $menu_with_path = $this->applyPathToMenu($menu);
            foreach ($menu_with_path as $menu_item) {
                if (!in_array($menu_item, $groupMenu)) {
                    array_push($groupMenu, $menu_item);
                }
            }
        }

        $collection = (new Collection($groupMenu))->sortBy('name', SORT_ASC, SORT_NATURAL);
        $nested = $collection->nest('id', 'parent_id');

        if ($format == 'treeList') {
            return $nested->listNested()->printer('name', 'id', '--')->toArray();
        }

        return ($nested->toArray());
    }

    public function getAllUsersMenu($format='threaded')
    {
        $userMenu = array();
        $rbac = TableRegistry::get('Accounts/Authz.SimpleRbac');
        $permissions = $rbac->find('all')
            ->where([
                'allowed' => true,
                'role' => 'user'
            ]);

        foreach ($permissions as $permission) {
            $menu = $this->getMenu(
                $permission->plugin,
                $permission->controller,
                $permission->action
            );
            $menu_with_path = $this->applyPathToMenu($menu);
            foreach ($menu_with_path as $menu_item) {
                array_push($userMenu, $menu_item);
            }
        }

        $collection = (new Collection($userMenu))->sortBy('name', SORT_ASC, SORT_NATURAL);
        $nested = $collection->nest('id', 'parent_id');

        if ($format == 'treeList') {
            return $nested->listNested()->printer('name', 'id', '--')->toArray();
        }

        return ($nested->toArray());
    }

    public function getAllGroupsMenu($format='threaded')
    {
        $groupMenu = array();
        $rbac = TableRegistry::get('Accounts/Authz.SimpleRbac');
        $permissions = $rbac->find('all')
            ->where([
                'allowed' => true,
                'role' => 'group'
            ]);

        foreach ($permissions as $permission) {
            $menu = $this->getMenu(
                $permission->plugin,
                $permission->controller,
                $permission->action
            );
            $menu_with_path = $this->applyPathToMenu($menu);
            foreach ($menu_with_path as $menu_item) {
                array_push($groupMenu, $menu_item);
            }
        }

        $collection = (new Collection($groupMenu))->sortBy('name', SORT_ASC, SORT_NATURAL);
        $nested = $collection->nest('id', 'parent_id');

        if ($format == 'treeList') {
            return $nested->listNested()->printer('name', 'id', '--')->toArray();
        }

        return ($nested->toArray());
    }

    /**
     * @param $plugin
     * @param $controller
     * @param $action
     * @return array
     */
    private function getMenu($plugin, $controller, $action)
    {
        $where['plugin'] = $plugin;

        if ($controller != '*') {
            $where['controller'] = $controller;
        }

        if ($controller != '*') {
            $where['action'] = $action;
        }
        $menusTable = TableRegistry::get('Accounts/Authz.Menus');
        $menu = $menusTable->find('all')
            ->where($where);
        return $menu;
    }

    /**
     * @param $menusTable
     * @param $nodeId
     */
    private function applyPathToMenu($menu)
    {
        $menusTable = TableRegistry::get('Accounts/Authz.Menus');
        $pathMenu = array();
        foreach ($menu as $item) {
            $paths = $menusTable->find('path', ['for' => $item->id])
                ->hydrate(false)
                ->toArray();
            foreach ($paths as $path) {
                array_push($pathMenu, $path);
            }
        }
        return $pathMenu;
    }

    /**
     * @param $menusTable
     * @param $nodeId
     */
    private function applyPathToAdminMenu($menu)
    {
        $menusTable = TableRegistry::get('Accounts/Authz.Menus');
        $pathMenu = array();

        $paths = $menusTable->find('path', ['for' => $menu->id])
            ->hydrate(false)
            ->toArray();

        foreach ($paths as $path) {
            array_push($pathMenu, $path);
        }

        return $pathMenu;
    }
}