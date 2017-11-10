<?php
namespace Shopping\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Shopping\Model\Table\ProductsTable;

/**
 * Shopping\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Shopping\Model\Table\ProductsTable
     */
    public $Products;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.shopping.products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = TableRegistry::get('Products', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Products);

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
