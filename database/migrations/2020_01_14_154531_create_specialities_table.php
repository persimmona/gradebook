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
            $table->string('id', 12)->unique();
            $table->string('speciality_code', 12)->nullable();
            $table->string('speciality_name', 255);
            $table->decimal('osvita_level_id',2,0);
           // $table->foreign('osvita_level_id')->references('id')->on ('osvita_levels');
            $table->boolean('is_used');
            $table->boolean('is_specialisation');
            $table->string('main_speciality_id', 12)->nullable();
            //$table->string('full_speciality_name', 268)->nullable();
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
