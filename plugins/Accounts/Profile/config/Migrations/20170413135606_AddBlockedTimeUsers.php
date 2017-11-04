<?php

use Phinx\Migration\AbstractMigration;

class AddBlockedTimeUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     */
    public function change()
    {
        $this->table('users')
        ->addColumn('blocked_time', 'datetime', [
            'default' => null,
            'null' => true
        ])
        ->update();
    }
}
