<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HorariosRegularesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HorariosRegularesTable Test Case
 */
class HorariosRegularesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HorariosRegularesTable
     */
    public $HorariosRegulares;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.horarios_regulares',
        'app.permissions',
        'app.permissions_horarios_regulares'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HorariosRegulares') ? [] : ['className' => 'App\Model\Table\HorariosRegularesTable'];
        $this->HorariosRegulares = TableRegistry::get('HorariosRegulares', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HorariosRegulares);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
