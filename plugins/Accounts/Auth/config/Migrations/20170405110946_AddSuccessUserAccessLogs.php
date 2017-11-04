<?php
use Migrations\AbstractMigration;

class AddSuccessUserAccessLogs extends AbstractMigration
{
    /**
     * Change Method.
     *
     */
    public function change()
    {
        $table = $this->table('user_access_logs');
        $table->addColumn('success', 'boolean', [
                'default' => 0
            ])
            ->update();
    }
}
