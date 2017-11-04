<?php
namespace SignUp\Employee\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use SignUp\Employee\Controller\UsersController;
use Cake\ORM\TableRegistry;

/**
 * SignUp\Employee\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.sign_up/employee.users',
        'plugin.sign_up/employee.persons',
        'plugin.sign_up/employee.employees'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testValidateInactive()
    {
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superadmin',
                    'is_superuser' => 1
                    // other keys.
                ]
            ]
        ]);

        $this->get('/sign-up/employee/users/validate');
        $this->assertResponseContains('Jhon Doe');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testValidateActive()
    {
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superadmin',
                    'is_superuser' => 1
                    // other keys.
                ]
            ]
        ]);

        $this->get('/sign-up/employee/users/validate');
        $this->assertResponseNotContains('Jane Doe');
    }
    public function testValidateAccept()
    {
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superadmin',
                    'is_superuser' => 1
                    // other keys.
                ]
            ]
        ]);

        $this->get('/sign-up/employee/users/accept/030aba53-d30f-4644-ab82-c3c3c36b2046');

        $UsersTable = TableRegistry::get('Users');

        $query = $UsersTable->find()
            ->select('first_name')
            ->where(['active' => true])
            ->where(['first_name' => 'Jhon Doe'])
            ->hydrate(false)
            ->toArray();

        $expected = [
            ['first_name' => 'Jhon Doe']
        ];

        $this->assertEquals($expected, $query);
    }

    public function testValidateReject()
    {
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superadmin',
                    'is_superuser' => 1
                    // other keys.
                ]
            ]
        ]);


        $this->delete('/sign-up/employee/users/reject/030aas53-d30f-4644-ab82-c3c3c36b2046');

        $UsersTable = TableRegistry::get('Users');

        $query = $UsersTable->find()
            ->where(['first_name' => 'Silver Doe']);


        $this->assertEquals(0, $query->count());

    }
}