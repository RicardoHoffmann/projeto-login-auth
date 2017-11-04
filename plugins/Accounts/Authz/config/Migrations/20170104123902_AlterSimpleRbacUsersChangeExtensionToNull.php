<?php
use Migrations\AbstractMigration;

class AlterSimpleRbacUsersChangeExtensionToNull extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('simple_rbac_users');
        $table->changeColumn('extension', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }
}
