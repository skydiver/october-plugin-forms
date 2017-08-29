<?php

    namespace Martin\Forms\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;
    use Martin\Forms\Models\Record;

    class AddUnreadField extends Migration {

        public function up() {

            // CREATE FIELD
            Schema::table('martin_forms_records', function ($table) {
                $table->boolean('unread')->default(1)->after('ip');
            });
            
            // UPDATE EXISTING RECORDS TO READED
            Record::where('unread', 1)->update(['unread' => 0]);

        }

        public function down() {
            if(Schema::hasColumn('martin_forms_records', 'unread')) {
                Schema::table('martin_forms_records', function ($table) {
                    $table->dropColumn('unread');
                });
            }
        }

    }

?>
