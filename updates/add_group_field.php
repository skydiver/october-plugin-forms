<?php

    namespace BlakeJones\MagicForms\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;

    class AddGroupField extends Migration {

        public function up() {
            Schema::table('blakejones_magicforms_records', function ($table) {
                $table->string('group')->default('(Empty)')->after('id');
            });

        }

        public function down() {
            if(Schema::hasColumn('blakejones_magicforms_records', 'group')) {
                Schema::table('blakejones_magicforms_records', function ($table) {
                    $table->dropColumn('group');
                });
            }
        }

    }

?>