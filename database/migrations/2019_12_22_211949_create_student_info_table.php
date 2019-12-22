<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->string('discipline', 30);
            $table->integer('year');
            $table->smallInteger('semester')->unsigned();
            $table->smallInteger('mark')->unsigned();
            $table->timestamps();
        });

        Schema::table('student_info', function (Blueprint $table){
           $table->foreign('student_id')->references('id')->on('students');
           $table->foreign('discipline')->references('discipline_name')->on('study_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_info');
    }
}
