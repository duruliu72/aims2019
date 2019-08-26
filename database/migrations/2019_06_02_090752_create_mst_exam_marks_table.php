<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('sectionid')->length(11);
            $table->integer('studentid')->length(11);
            $table->integer('coursecodeid')->length(11);
            $table->integer('examnameid')->length(11);
            $table->integer('examtypeid')->length(11)->nullable();
            $table->integer('markcategoryid')->length(11)->nullable();
            $table->double('marks', 8, 2);
            $table->integer('status')->length(5)->default(0);
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
        Schema::dropIfExists('mst_exam_marks');
    }
}
