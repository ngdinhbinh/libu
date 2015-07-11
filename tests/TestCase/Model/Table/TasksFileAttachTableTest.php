<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TasksFileAttachTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TasksFileAttachTable Test Case
 */
class TasksFileAttachTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tasks_file_attach',
        'app.tasks',
        'app.projects',
        'app.users',
        'app.comments',
        'app.tasks_user',
        'app.social_profiles',
        'app.social_networks',
        'app.attachments',
        'app.objects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TasksFileAttach') ? [] : ['className' => 'App\Model\Table\TasksFileAttachTable'];
        $this->TasksFileAttach = TableRegistry::get('TasksFileAttach', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TasksFileAttach);

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
