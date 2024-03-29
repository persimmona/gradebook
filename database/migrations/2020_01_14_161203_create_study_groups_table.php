<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_groups', function (Blueprint $table) {
            $table->string('id', 12)->unique();
            $table->string('study_group_name', 50);
            $table->decimal('study_group_state_id',9, 0);
           // $table->foreign('study_group_state_id')->references('id')->on('study_group_states');
            $table->integer('education_form_id');
         //   $table->foreign('education_form_id')->references('id')->on('education_forms');
            $table->string('study_program_id', 12);
           // $table->foreign('study_program_id')->references('id')->on('study_programs');
            $table->string('division_id', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_groups');
    }
}
