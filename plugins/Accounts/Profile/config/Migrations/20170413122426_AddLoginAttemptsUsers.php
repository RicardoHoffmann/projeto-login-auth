<?php

use Phinx\Migration\AbstractMigration;

class AddLoginAttemptsUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     */
    public function change()
    {
        $this->table('users')
            ->addColumn('login_attempts', 'integer', [
                'default' => 0
            ])
            ->update();
    }
}
