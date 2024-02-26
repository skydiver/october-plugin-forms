<?php

namespace BlakeJones\MagicForms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateRecordsTable extends Migration {

    public function up() {
        Schema::create('blakejones_magicforms_records', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('form_data')->nullable();
            $table->string('ip')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('blakejones_magicforms_records');
    }

}

?>