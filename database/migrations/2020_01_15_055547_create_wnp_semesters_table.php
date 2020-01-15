<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWnpSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wnp_semesters', function (Blueprint $table) {
            $table->string('id',12);
            $table->string('wnp_title_id',12);
            $table->decimal('semester_id',2,0);
            $table->integer('session_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wnp_semesters');
    }
}
