<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsvitaLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osvita_levels', function (Blueprint $table) {
        $table->decimal('id', 2,0)->unique();
        $table->string('osvita_level_name', 80);
        $table->boolean('is_used');
        $table->string('osvita_level_short_name', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osvita_levels');
    }
}
