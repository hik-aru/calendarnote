<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ScheduleTableHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ScheduleTableHelper Test Case
 */
class ScheduleTableHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ScheduleTableHelper
     */
    public $ScheduleTable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ScheduleTable = new ScheduleTableHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScheduleTable);

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
