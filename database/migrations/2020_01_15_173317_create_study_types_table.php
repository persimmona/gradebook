<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_types', function (Blueprint $table) {
            $table->decimal('id', 2, 0)->nullable();
            $table->string('study_type_name',80)->nullable();
            $table->string('study_type_short_name',80)->nullable();
            $table->boolean('is_comulative_score')->nullable();
            $table->integer('study_type_max_score')->nullable();
            $table->integer('study_type_max_comulative_score')->nullable();
            $table->boolean('is_for_test')->nullable();
            $table->integer('edit_emp_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_types');
    }
}
