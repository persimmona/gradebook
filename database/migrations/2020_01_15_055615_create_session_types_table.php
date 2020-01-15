<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_types', function (Blueprint $table) {
            $table->integer('id');
            $table->string('session_type_name',80);
            $table->boolean('is_used');
            $table->boolean('seasone_num');
            $table->string('semester_type_name',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_types');
    }
}
