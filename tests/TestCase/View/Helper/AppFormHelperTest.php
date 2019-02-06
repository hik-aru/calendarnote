<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\AppFormHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\AppFormHelper Test Case
 */
class AppFormHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\AppFormHelper
     */
    public $AppForm;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->AppForm = new AppFormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppForm);

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
