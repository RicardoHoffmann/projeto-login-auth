<?php
namespace Audit\Test\TestCase\Model\Table;

use Audit\Model\Table\UserAccessLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Audit\Model\Table\UserAccessLogsTable Test Case
 */
class UserAccessLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Audit\Model\Table\UserAccessLogsTable
     */
    public $UserAccessLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.audit.user_access_logs',
        'plugin.audit.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserAccessLogs') ? [] : ['className' => 'Audit\Model\Table\UserAccessLogsTable'];
        $this->UserAccessLogs = TableRegistry::get('UserAccessLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserAccessLogs);

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
}
