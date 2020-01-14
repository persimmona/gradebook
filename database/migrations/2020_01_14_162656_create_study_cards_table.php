<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_cards', function (Blueprint $table) {
            $table->string('id', 12); 
            $table->string('student_id', 12); 
            $table->string('study_program_id', 12);
            $table->string('study_group_id', 12);
            $table->integer('study_state_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_cards');
    }
}
