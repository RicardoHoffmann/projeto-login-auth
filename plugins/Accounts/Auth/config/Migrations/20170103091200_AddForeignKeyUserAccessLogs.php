<?php
use Migrations\AbstractMigration;

class AddForeignKeyUserAccessLogs extends AbstractMigration
{
    public function up()
    {
        $this->table('user_access_logs')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('user_access_logs')
            ->dropForeignKey('user_id');
    }
}
