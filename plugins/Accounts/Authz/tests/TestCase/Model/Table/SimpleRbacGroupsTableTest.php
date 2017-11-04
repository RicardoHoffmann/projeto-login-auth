<?php
namespace Accounts\Authz\Test\TestCase\Model\Table;

use Accounts\Authz\Model\Table\SimpleRbacGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Accounts\Authz\Model\Table\SimpleRbacGroupsTable Test Case
 */
class SimpleRbacGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Accounts\Authz\Model\Table\SimpleRbacGroupsTable
     */
    public $SimpleRbacGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.accounts/authz.simple_rbac_groups',
        'plugin.accounts/authz.groups',
        'plugin.accounts/authz.user_groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SimpleRbacGroups') ? [] : ['className' => 'Accounts\Authz\Model\Table\SimpleRbacGroupsTable'];
        $this->SimpleRbacGroups = TableRegistry::get('SimpleRbacGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SimpleRbacGroups);

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
