<?php
use Migrations\AbstractMigration;

class CreateSimpleRbac extends AbstractMigration
{
    public function up()
    {
        $this->table('simple_rbac', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('prefix', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('plugin', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('controller', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('action', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('allowed', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('simple_rbac');
    }
}
