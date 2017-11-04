<?php
namespace Audit\Test\TestCase\Model\Table;

use Audit\Model\Table\AuditLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Audit\Model\Table\AuditLogsTable Test Case
 */
class AuditLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Audit\Model\Table\AuditLogsTable
     */
    public $AuditLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.audit.audit_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AuditLogs') ? [] : ['className' => 'Audit\Model\Table\AuditLogsTable'];
        $this->AuditLogs = TableRegistry::get('AuditLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AuditLogs);

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
