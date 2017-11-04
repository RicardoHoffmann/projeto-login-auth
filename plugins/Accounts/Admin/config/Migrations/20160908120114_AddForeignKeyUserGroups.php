<?php
use Migrations\AbstractMigration;

class AddForeignKeyUserGroups extends AbstractMigration
{
    public function up()
    {
        $this->table('user_groups')
            ->addForeignKey('group_id', 'groups', 'id')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    public function down()
    {
        $this->table('user_groups')
            ->dropForeignKey('group_id')
            ->dropForeignKey('user_id');
    }
}
