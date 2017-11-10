<?php
use Migrations\AbstractSeed;

/**
 * AddMenuShopping seed.
 */
class AddMenuShoppingSeed extends AbstractSeed
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
                'id' => '5c65ac20-bde8-4e9f-be10-8e96e8225a45',
                'parent_id' => null,
                'lft' => 33,
                'rght' => 38,
                'name' => 'Sistemas',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
            [
                'id' => 'ac318d34-ca8b-4a4c-b70e-8c529af618ad',
                'parent_id' => '5c65ac20-bde8-4e9f-be10-8e96e8225a45',
                'lft' => 36,
                'rght' => 37,
                'name' => 'Shopping',
                'plugin' => '',
                'controller' => '',
                'action' => '',
                'external_url' => ''
            ],
        ];

        $table = $this->table('menus');

        $table->insert($data)->save();
    }
}
