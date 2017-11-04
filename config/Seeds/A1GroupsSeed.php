<?php
use Migrations\AbstractSeed;

/**
 * TidigitalGroups seed.
 */
class A1GroupsSeed extends AbstractSeed
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
                'id' => '1',
                'name' => 'Administrators',
            ],
            [
                'id' => '2',
                'name' => 'Registered users',
            ]
        ];

        $table = $this->table('groups');
        $table->insert($data)->save();
    }
}
