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
            $table->string('id', 12)->unique();
            $table->string('student_id', 12);
           // $table->foreign('student_id')->references('id')->on('students');
            $table->string('study_program_id', 12);
           // $table->foreign('study_program_id')->references('id')->on('study_programs');
            $table->string('study_group_id', 12);
           // $table->foreign('study_group_id')->references('id')->on('study_groups');
            $table->integer('study_state_id');
          //  $table->foreign('study_state_id')->references('id')->on('study_states');
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
