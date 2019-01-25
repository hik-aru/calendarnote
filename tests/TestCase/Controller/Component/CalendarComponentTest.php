<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CalendarComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CalendarComponent Test Case
 */
class CalendarComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CalendarComponent
     */
    public $Calendar;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Calendar = new CalendarComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Calendar);

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
