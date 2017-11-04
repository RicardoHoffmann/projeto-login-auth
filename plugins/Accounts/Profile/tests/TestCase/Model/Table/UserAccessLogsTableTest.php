<?php
namespace Accounts\Profile\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MyAccount\Model\Table\UserAccessLogsTable;

/**
 * MyAccount\Model\Table\UserAccessLogsTable Test Case
 */
class UserAccessLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MyAccount\Model\Table\UserAccessLogsTable
     */
    public $UserAccessLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.my_account.user_access_logs',
        'plugin.my_account.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserAccessLogs') ? [] : ['className' => 'MyAccount\Model\Table\UserAccessLogsTable'];
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
