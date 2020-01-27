<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->string('id',12);
            $table->integer('position_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->char('sex', 1);
            $table->string('fio', 302)->nullable();
            $table->string('fio_short', 303)->nullable();
            $table->string('division_id', 12);
            $table->string('login', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('registry_code', 50)->nullable();
            $table->boolean('is_registered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
