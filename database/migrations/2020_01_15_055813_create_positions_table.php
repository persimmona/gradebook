<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->integer('id');
            $table->string('position_type_id',12);
            $table->string('position_name',255);
            $table->string('position_short_name',20)->nullable();
            $table->boolean('is_used');
            $table->boolean('is_decanat');
            $table->boolean('is_zavkaf');
            $table->boolean('is_teacher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
