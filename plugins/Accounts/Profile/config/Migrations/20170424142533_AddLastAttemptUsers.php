<?php

use Phinx\Migration\AbstractMigration;

class AddLastAttemptUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     */
    public function change()
    {
        $this->table('users')
            ->addColumn('last_attempt', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->update();
    }
}
