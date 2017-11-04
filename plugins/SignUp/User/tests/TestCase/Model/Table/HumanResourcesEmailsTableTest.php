<?php
namespace SignUp\Employee\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SignUp\Employee\Model\Table\HumanResourcesEmailsTable;

/**
 * SignUp\Employee\Model\Table\HumanResourcesEmailsTable Test Case
 */
class HumanResourcesEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SignUp\Employee\Model\Table\HumanResourcesEmailsTable
     */
    public $HumanResourcesEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.sign_up/employee.human_resources_emails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HumanResourcesEmails') ? [] : ['className' => 'SignUp\Employee\Model\Table\HumanResourcesEmailsTable'];
        $this->HumanResourcesEmails = TableRegistry::get('HumanResourcesEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HumanResourcesEmails);

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
