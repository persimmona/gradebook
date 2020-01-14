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
            $table->string('id', 12);
            $table->string('study_group_name', 50);
            $table->boolean('study_group_state_id');
            $table->integer('education_form_id');
            $table->string('study_program_id', 12);
            $table->string('division_id', 12);
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
