<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BiderinfoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BiderinfoTable Test Case
 */
class BiderinfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BiderinfoTable
     */
    public $Biderinfo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Biderinfo',
        'app.Bidinfos',
        'app.Bidrequests',
        'app.Biditems',
        'app.Bidcontacts',
        'app.Bidratings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Biderinfo') ? [] : ['className' => BiderinfoTable::class];
        $this->Biderinfo = TableRegistry::getTableLocator()->get('Biderinfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Biderinfo);

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
