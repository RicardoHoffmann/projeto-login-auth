<?php
namespace Accounts\Admin\Test\TestCase\Model\Table;

use Accounts\Admin\Model\Table\RadcheckTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Accounts\Admin\Model\Table\RadcheckTable Test Case
 */
class RadcheckTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Accounts\Admin\Model\Table\RadcheckTable
     */
    public $Radcheck;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.accounts/admin.radcheck'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Radcheck') ? [] : ['className' => 'Accounts\Admin\Model\Table\RadcheckTable'];
        $this->Radcheck = TableRegistry::get('Radcheck', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Radcheck);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
