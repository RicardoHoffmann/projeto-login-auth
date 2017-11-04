<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HorariosRegularesFixture
 *
 */
class HorariosRegularesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'monday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tuesday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'wednesday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'thursday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'friday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'saturday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sunday' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'fixed' => null],
        'begin_time' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'end_time' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
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
            'id' => 'fbc3d174-5295-49bf-abf5-4c64f669e444',
            'monday' => 'Lorem ipsum dolor sit amet',
            'tuesday' => 'Lorem ipsum dolor sit amet',
            'wednesday' => 'Lorem ipsum dolor sit amet',
            'thursday' => 'Lorem ipsum dolor sit amet',
            'friday' => 'Lorem ipsum dolor sit amet',
            'saturday' => 'Lorem ipsum dolor sit amet',
            'sunday' => 'Lorem ipsum dolor sit amet',
            'begin_time' => '19:44:15',
            'end_time' => '19:44:15'
        ],
    ];
}
