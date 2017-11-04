<?php
namespace SignUp\Employee\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'username' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'token_expires' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'api_token' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'activation_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'tos_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'is_superuser' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'role' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => 'user', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'id' => '030aba53-d30f-4644-ab82-c3c3c36b2046',
            'username' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'Jhon Doe',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet',
            'token_expires' => '2016-04-18 12:54:05',
            'api_token' => 'Lorem ipsum dolor sit amet',
            'activation_date' => '2016-04-18 12:54:05',
            'tos_date' => '2016-04-18 12:54:05',
            'active' => 0,
            'is_superuser' => 1,
            'role' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-04-18 12:54:05',
            'modified' => '2016-04-18 12:54:05'
        ],
        [
            'id' => '130aba53-d30f-4644-ab82-c3c3c36b2046',
            'username' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'Jane Doe',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet',
            'token_expires' => '2016-04-18 12:54:05',
            'api_token' => 'Lorem ipsum dolor sit amet',
            'activation_date' => '2016-04-18 12:54:05',
            'tos_date' => '2016-04-18 12:54:05',
            'active' => 1,
            'is_superuser' => 1,
            'role' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-04-18 12:54:05',
            'modified' => '2016-04-18 12:54:05'
        ],
        [
            'id' => '030aas53-d30f-4644-ab82-c3c3c36b2046',
            'username' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'Silver Doe',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet',
            'token_expires' => '2016-04-18 12:54:05',
            'api_token' => 'Lorem ipsum dolor sit amet',
            'activation_date' => '2016-04-18 12:54:05',
            'tos_date' => '2016-04-18 12:54:05',
            'active' => 0,
            'is_superuser' => 1,
            'role' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-04-18 12:54:05',
            'modified' => '2016-04-18 12:54:05'
        ],
    ];
}
