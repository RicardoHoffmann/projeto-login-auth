<?php
namespace Accounts\Admin\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RadcheckFixture
 *
 */
class RadcheckFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'radcheck';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'username' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'attribute' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'op' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '==', 'comment' => '', 'precision' => null],
        'value' => ['type' => 'string', 'length' => 253, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'enable' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'Y', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'username' => ['type' => 'index', 'columns' => ['username'], 'length' => ['username' => '32']],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
            'id' => 1,
            'username' => 'Lorem ipsum dolor sit amet',
            'attribute' => 'Lorem ipsum dolor sit amet',
            'op' => '',
            'value' => 'Lorem ipsum dolor sit amet',
            'enable' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ],
    ];
}
