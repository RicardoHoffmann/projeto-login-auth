<?php
use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
{

    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('products');
        $table->addColumn('id', 'uuid', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('name', 'string', [
            'default' => null,
            'length' => 255,
            'null' => false
        ]);

        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('image', 'string', [
            'default' => null,
            'length' => 255,
            'null' => false
        ]);

        $table->addColumn('created', 'timestamp', [
            'default' => null,
            'null' => false
        ]);

        $table->addPrimaryKey('id');

        $table->create();
    }
}
