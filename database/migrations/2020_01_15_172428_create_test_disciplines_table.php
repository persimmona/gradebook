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
            $table->string('wnp_discipline_sem_id',12)->nullable();
            $table->decimal('study_type_id', 2, 0)->nullable();
            $table->integer('study_sub_type_id');
            $table->string('study_type_description',10);
            $table->integer('attestation_id');
            $table->boolean('is_custom')->nullable();
            $table->decimal('max_score', 4, 2)->nullable();
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
