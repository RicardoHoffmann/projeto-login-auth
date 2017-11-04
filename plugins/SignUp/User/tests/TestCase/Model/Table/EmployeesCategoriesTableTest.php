<?php
namespace SignUp\Employee\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SignUp\Employee\Model\Table\EmployeesCategoriesTable;

/**
 * SignUp\Employee\Model\Table\EmployeesCategoriesTable Test Case
 */
class EmployeesCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SignUp\Employee\Model\Table\EmployeesCategoriesTable
     */
    public $EmployeesCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.sign_up/employee.employees_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmployeesCategories') ? [] : ['className' => EmployeesCategoriesTable::class];
        $this->EmployeesCategories = TableRegistry::get('EmployeesCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeesCategories);

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
