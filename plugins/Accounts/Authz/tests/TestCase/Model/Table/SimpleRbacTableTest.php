<?php
namespace Accounts\Authz\Test\TestCase\Model\Table;

use Accounts\Authz\Model\Table\SimpleRbacTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Accounts\Authz\Model\Table\SimpleRbacTable Test Case
 */
class SimpleRbacTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Accounts\Authz\Model\Table\SimpleRbacTable
     */
    public $SimpleRbac;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.accounts/authz.simple_rbac',
        'plugin.accounts/authz.users',
        'plugin.accounts/authz.simple_rbac_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SimpleRbac') ? [] : ['className' => 'Accounts\Authz\Model\Table\SimpleRbacTable'];
        $this->SimpleRbac = TableRegistry::get('SimpleRbac', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SimpleRbac);

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
