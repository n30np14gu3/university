<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('specialty_name', 30);
            $table->string('discipline_name', 30)->unique()->index('discipline_name_index');
            $table->smallInteger('semester')->unsigned();
            $table->integer('hours')->unsigned();
            $table->smallInteger('form');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_plan');
    }
}
