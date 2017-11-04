<?php
namespace Accounts\Authz\Test\TestCase\Model\Table;

use Accounts\Authz\Model\Table\SimpleRbacUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Accounts\Authz\Model\Table\SimpleRbacUsersTable Test Case
 */
class SimpleRbacUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Accounts\Authz\Model\Table\SimpleRbacUsersTable
     */
    public $SimpleRbacUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.accounts/authz.simple_rbac_users',
        'plugin.accounts/authz.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SimpleRbacUsers') ? [] : ['className' => 'Accounts\Authz\Model\Table\SimpleRbacUsersTable'];
        $this->SimpleRbacUsers = TableRegistry::get('SimpleRbacUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SimpleRbacUsers);

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
