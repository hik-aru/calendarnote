<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AppSecurityComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AppSecurityComponent Test Case
 */
class AppSecurityComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AppSecurityComponent
     */
    public $AppSecurity;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AppSecurity = new AppSecurityComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppSecurity);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
