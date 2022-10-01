<?php

    namespace BlakeJones\MagicForms\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;
    use BlakeJones\MagicForms\Models\Record;

    class AddUnreadField extends Migration {

        public function up() {

            // CREATE FIELD
            Schema::table('blakejones_magicforms_records', function ($table) {
                $table->boolean('unread')->default(1)->after('ip');
            });
            
            // UPDATE EXISTING RECORDS TO READED
            Record::where('unread', 1)->update(['unread' => 0]);

        }

        public function down() {
            if(Schema::hasColumn('blakejones_magicforms_records', 'unread')) {
                Schema::table('blakejones_magicforms_records', function ($table) {
                    $table->dropColumn('unread');
                });
            }
        }

    }

?>
