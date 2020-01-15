<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWnpTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wnp_titles', function (Blueprint $table) {
            $table->string('id', 12);
            $table->string('wnp_title_name', 120);
            $table->string('division_id', 12);
            $table->string('study_year_id', 9);
            $table->string('study_group_id', 12);
            $table->decimal('course_id', 2,0);
            $table->integer('credit_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wnp_titles');
    }
}
