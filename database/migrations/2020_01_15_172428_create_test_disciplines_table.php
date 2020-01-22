<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_disciplines', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('wnp_discipline_sem_id',12);
            $table->decimal('study_type_id', 2, 0);
            $table->integer('study_sub_type_id')->nullable();
            $table->string('study_type_description',10)->nullable();
            $table->integer('attestation_id')->nullable();
            $table->boolean('is_custom');
            $table->decimal('max_score', 4, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_disciplines');
    }
}
