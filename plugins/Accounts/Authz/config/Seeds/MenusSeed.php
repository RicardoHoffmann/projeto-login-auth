<?php
use Migrations\AbstractSeed;

/**
 * Menus seed.
 */
class MenusSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '570df7c8-164e-4900-9222-ef1bece4f98d',
                'parent_id' => null,
                'lft' => 1,
                'rght' => 32,
                'name' => 'Administração',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => '189e7b2c-1b98-4671-a036-8fcb6ce840a7',
                'parent_id' => '570df7c8-164e-4900-9222-ef1bece4f98d',
                'lft' => 4,
                'rght' => 9,
                'name' => 'Auditoria',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => '318d6a49-9a50-4df3-8906-579a02f6de4c',
                'parent_id' => '570df7c8-164e-4900-9222-ef1bece4f98d',
                'lft' => 14,
                'rght' => 23,
                'name' => 'Contas',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => '77a98fc1-8529-4361-a934-5a971a8649a7',
                'parent_id' => '570df7c8-164e-4900-9222-ef1bece4f98d',
                'lft' => 10,
                'rght' => 13,
                'name' => 'Configuração',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => 'fef6c105-4593-40fc-a909-216033364223',
                'parent_id' => '570df7c8-164e-4900-9222-ef1bece4f98d',
                'lft' => 24,
                'rght' => 31,
                'name' => 'Permissões',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => '907c6f72-a3e7-444f-8976-f3fb4fcf1181',
                'parent_id' => '77a98fc1-8529-4361-a934-5a971a8649a7',
                'lft' => 11,
                'rght' => 12,
                'name' => 'Gerenciar menus',
                'plugin' => 'Accounts/Authz',
                'controller' => 'Menus',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => '669ab3eb-53ed-46d0-b47d-5a903e9a33ee',
                'parent_id' => 'fef6c105-4593-40fc-a909-216033364223',
                'lft' => 29,
                'rght' => 30,
                'name' => 'Todos Usuários',
                'plugin' => 'Accounts/Authz',
                'controller' => 'AllUsers',
                'action' => 'authorization',
                'external_url' => ''
            ],
            [
                'id' => '7ad20325-72bc-4ec2-b16c-43dcdb2bb0c5',
                'parent_id' => 'fef6c105-4593-40fc-a909-216033364223',
                'lft' => 25,
                'rght' => 26,
                'name' => 'Por Grupo',
                'plugin' => 'Accounts/Authz',
                'controller' => 'Groups',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => 'a6be71fb-7e79-4ed5-8dc1-b848e774b74f',
                'parent_id' => 'fef6c105-4593-40fc-a909-216033364223',
                'lft' => 27,
                'rght' => 28,
                'name' => 'Por Usuário',
                'plugin' => 'Accounts/Authz',
                'controller' => 'Users',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => '9b77dabb-cfaf-42e8-aaf4-4ad766a5e80a',
                'parent_id' => '189e7b2c-1b98-4671-a036-8fcb6ce840a7',
                'lft' => 7,
                'rght' => 8,
                'name' => 'Logs de alteração',
                'plugin' => 'Audit',
                'controller' => 'AuditLogs',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => 'd59e1583-fd32-474e-aa79-1c4deac78c9b',
                'parent_id' => '189e7b2c-1b98-4671-a036-8fcb6ce840a7',
                'lft' => 5,
                'rght' => 6,
                'name' => 'Logs de acesso',
                'plugin' => 'Audit',
                'controller' => 'UserAccessLogs',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => '3c2ecad8-d3b2-4d3c-a10c-1a7fa4b96215',
                'parent_id' => '318d6a49-9a50-4df3-8906-579a02f6de4c',
                'lft' => 17,
                'rght' => 20,
                'name' => 'Autorizar',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => '70c61943-9a44-4d55-9f57-4ba99b7b74d7',
                'parent_id' => '318d6a49-9a50-4df3-8906-579a02f6de4c',
                'lft' => 15,
                'rght' => 16,
                'name' => 'Grupos',
                'plugin' => 'Accounts/Admin',
                'controller' => 'Groups',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => 'b06806f9-0b97-41d2-993d-c8cad886198c',
                'parent_id' => '318d6a49-9a50-4df3-8906-579a02f6de4c',
                'lft' => 21,
                'rght' => 22,
                'name' => 'Usuários',
                'plugin' => 'Accounts/Admin',
                'controller' => 'Users',
                'action' => 'index',
                'external_url' => ''
            ],
            [
                'id' => 'a31d6681-cc0b-412d-b7d8-ac84ccf53c5a',
                'parent_id' => '3c2ecad8-d3b2-4d3c-a10c-1a7fa4b96215',
                'lft' => 18,
                'rght' => 19,
                'name' => 'Usuários',
                'plugin' => 'SignUp/User',
                'controller' => 'VerifyAccount',
                'action' => 'index',
                'external_url' => ''
            ],
        ];

        $table = $this->table('menus');
        $table->insert($data)->save();
    }
}
