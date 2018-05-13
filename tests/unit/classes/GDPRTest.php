<?php

namespace Martin\Forms\Tests\Classes;

use PluginTestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use System\Classes\PluginManager;
use Martin\Forms\Classes\GDPR;
use Martin\Forms\Models\Record;
use Martin\Forms\Models\Settings;

class GDPRTest extends PluginTestCase {

    use RefreshDatabase;

    private $_record;

    public function setUp() {
        parent::setUp();
        PluginManager::instance()->bootAll(true);
        Record::unguard();
        $this->_record = Record::create([
            'group' => 'test group',
            'created_at' => Carbon::now()->subDays(20),
            'updated_at' => Carbon::now()->subDays(20),
        ]);
    }

    /**
     * @testdox GDPR cleanup disabled
     */
    public function testCleanRecordsDisabled() {
        Settings::set([
            'gdpr_enable' => false,
            'gdpr_days'   => 10
        ]);
        $gdpr = new GDPR();
        $gdpr->cleanRecords();
        $totalRecords = Record::all()->count();
        $this->assertEquals(1, $totalRecords);
    }

    /**
     * @testdox GDPR cleanup with older records
     */
    public function testCleanRecordsWithOlder() {
        Settings::set([
            'gdpr_enable' => true,
            'gdpr_days'   => 10
        ]);
        $gdpr = new GDPR();
        $gdpr->cleanRecords();
        $totalRecords = Record::all()->count();
        $this->assertEquals(0, $totalRecords);
    }

    /**
     * @testdox GDPR cleanup without older records
     */
    public function testCleanRecordsWithoutOlder() {
        Settings::set([
            'gdpr_enable' => true,
            'gdpr_days'   => 30
        ]);
        $gdpr = new GDPR();
        $gdpr->cleanRecords();
        $totalRecords = Record::all()->count();
        $this->assertEquals(1, $totalRecords);
    }

    /**
     * @testdox GDPR cleanup with invalid days parameter
     * @expectedException October\Rain\Database\ModelException
     */
    public function testCleanRecordsInvalidDays() {
        Settings::set([
            'gdpr_enable' => true,
            'gdpr_days'   => 'INVALID'
        ]);
    }

}