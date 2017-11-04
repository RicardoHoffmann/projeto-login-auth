<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'id' => '53616454-bdcb-47c8-9799-2eccc714c458',
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => '$2y$10$FMJEYfdCtko7w8juHYyo4.Jp8npaUQCvYL5XFbBJ57ECqjk4gViPe', /* superadmin */
                'first_name' => NULL,
                'last_name' => NULL,
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => NULL,
                'tos_date' => NULL,
                'active' => '1',
                'is_superuser' => '1',
                'role' => 'superuser',
                'created' => '2017-01-02 18:36:08',
                'modified' => '2017-01-02 18:36:08',
                'imported' => '0',
            ],
            [
                'id' => '0ea034d1-de07-4045-95e3-51fc1409a9a8',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => '$2y$10$X0uFSBuQIQBUx8IDHENKTecYiAZMrbkyHlC6z.dQ/PRaUctVyjQHm', /* user */
                'first_name' => NULL,
                'last_name' => NULL,
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => NULL,
                'tos_date' => NULL,
                'active' => '1',
                'is_superuser' => '0',
                'role' => 'user',
                'created' => '2017-01-02 18:37:35',
                'modified' => '2017-01-02 18:37:35',
                'imported' => '0',
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
