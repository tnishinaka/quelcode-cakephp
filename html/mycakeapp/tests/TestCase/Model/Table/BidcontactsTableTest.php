<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidcontactsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidcontactsTable Test Case
 */
class BidcontactsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BidcontactsTable
     */
    public $Bidcontacts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bidcontacts',
        'app.Biderinfos',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bidcontacts') ? [] : ['className' => BidcontactsTable::class];
        $this->Bidcontacts = TableRegistry::getTableLocator()->get('Bidcontacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bidcontacts);

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
