<?php
namespace SignUp\Employee\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 *
 */
class EmployeesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'person_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'person_id' => ['type' => 'index', 'columns' => ['person_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'employees_ibfk_1' => ['type' => 'foreign', 'columns' => ['person_id'], 'references' => ['persons', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'id' => '46d02b22-b135-466a-841f-b441df7b442a',
            'person_id' => 'acb9d483-5297-4be4-b735-e9f8a8d35de8'
        ],
        [
            'id' => '46d02b22-b135-466a-841f-b441df7b4421',
            'person_id' => 'acb9d483-5297-4be4-b735-e9f8a8d35ddd'
        ],
        [
            'id' => '46d02b22-b135-466a-841f-b441df7b4422',
            'person_id' => 'acb9d483-5297-4be4-b735-e9f8a8d35fff'
        ],
    ];
}
