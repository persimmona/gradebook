<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudySubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_subtypes', function (Blueprint $table) {
           $table->integer('id');
           $table->decimal('study_type_id', 2, 0);
           $table->string('study_subtype_name',100);
           $table->string('study_subtype_short_name',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_subtypes');
    }
}
