<?php
namespace SignUp\Employee\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PersonsFixture
 *
 */
class PersonsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'cpf' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_persons_1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_persons_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 'acb9d483-5297-4be4-b735-e9f8a8d35de8',
            'user_id' => '030aba53-d30f-4644-ab82-c3c3c36b2046',
            'cpf' => 'Lorem ipsum dolor sit amet'
        ],
        [
            'id' => 'acb9d483-5297-4be4-b735-e9f8a8d35ddd',
            'user_id' => '130aba53-d30f-4644-ab82-c3c3c36b2046',
            'cpf' => 'Lorem ipsum dolor sit amet'
        ],
        [
            'id' => 'acb9d483-5297-4be4-b735-e9f8a8d35fff',
            'user_id' => '030aas53-d30f-4644-ab82-c3c3c36b2046',
            'cpf' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
