<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWnpDiscSemEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wnp_disc_sem_employers', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('wnp_discipline_sem_id',12);
            $table->string('employer_id',12);
            $table->integer('emp_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wnp_disc_sem_employers');
    }
}
