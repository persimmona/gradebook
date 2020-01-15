<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWnpDisciplineSemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wnp_discipline_sems', function (Blueprint $table) {
            $table->string('id',12);
            $table->integer('discipline_id');
            $table->string('wnp_semester_id',12);
            $table->string('division_id',12);
            $table->decimal('hour_total',6,2);
            $table->decimal('finished_study_type_id',2,0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wnp_discipline_sems');
    }
}
