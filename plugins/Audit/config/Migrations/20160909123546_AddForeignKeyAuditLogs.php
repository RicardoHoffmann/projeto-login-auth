<?php
use Migrations\AbstractMigration;

class AddForeignKeyAuditLogs extends AbstractMigration
{
    public function up()
    {
        $this->table('audit_logs')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('audit_logs')
            ->dropForeignKey('user_id');
    }
}
