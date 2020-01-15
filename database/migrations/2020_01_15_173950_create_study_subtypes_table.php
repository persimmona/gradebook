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
           $table->integer('id')->nullable();
           $table->decimal('study_type_id', 2, 0)->nullable();
           $table->string('study_subtype_name',100)->nullable();
           $table->string('study_subtype_short_name',10)->nullable();
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
