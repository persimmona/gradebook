<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialities', function (Blueprint $table) {
            $table->string('id', 12);
            $table->string('speciality_code', 12);
            $table->string('speciality_name', 255);
            $table->boolean('osvita_level_id');
            $table->boolean('is_used');
            $table->boolean('is_specialisation');
            $table->string('main_speciality_id', 12);
            $table->string('full_speciality_name', 268);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialities');
    }
}
