<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('discipline_name',255)->nullable();
            $table->boolean('discipline_type_id')->nullable();
            $table->boolean('is_used')->nullable();
            $table->string('discipline_short_name',80);
            $table->string('discipline_name_default',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplines');
    }
}
