<?php
use Migrations\AbstractMigration;

class AddForeignKeySimpleRbacUsers extends AbstractMigration
{
    public function up()
    {
        $this->table('simple_rbac_users')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    public function down()
    {
        $this->table('simple_rbac_users')
            ->dropForeignKey('user_id');
    }
}
