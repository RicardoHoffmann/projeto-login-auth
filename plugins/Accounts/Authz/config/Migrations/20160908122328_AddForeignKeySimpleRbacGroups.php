<?php
use Migrations\AbstractMigration;

class AddForeignKeySimpleRbacGroups extends AbstractMigration
{
    public function up()
    {
        $this->table('simple_rbac_groups')
            ->addForeignKey('group_id', 'groups', 'id')
            ->save();
    }

    public function down()
    {
        $this->table('simple_rbac_groups')
            ->dropForeignKey('group_id');
    }
}
