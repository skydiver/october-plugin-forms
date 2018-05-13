<?php

namespace Martin\Forms\Tests\Classes;

use PluginTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use System\Classes\PluginManager;
use Martin\Forms\Classes\UnreadRecords;
use Martin\Forms\Models\Record;

class UnreadRecordsTest extends PluginTestCase {

    use RefreshDatabase;

    private $_record;

    public function setUp() {
        parent::setUp();
        PluginManager::instance()->bootAll(true);
        Record::unguard();
    }

    /**
     * @testdox Get total unread records with unread records
     */
    public function testGetTotal() {
        $record = Record::create([
            'group' => 'test group',
        ]);
        $unread = new UnreadRecords();
        $this->assertEquals(1, $record->id);
        $this->assertEquals('test group', $record->group);
        $this->assertEquals(1, $unread->getTotal());
    }

    /**
     * @testdox Get total unread records without unread records
     */
    public function testGetTotalNoUnread() {
        $record = Record::create([
            'group'  => 'test group',
            'unread' => 0
        ]);
        $unread = new UnreadRecords();
        $this->assertEquals(1, $record->id);
        $this->assertEquals('test group', $record->group);
        $this->assertEquals(0, $unread->getTotal());
        $this->assertNull($unread->getTotal());
    }

}