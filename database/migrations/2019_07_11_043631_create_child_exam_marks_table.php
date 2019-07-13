<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('sectionid')->length(11);
            $table->integer('mst_examnameid')->length(11);
            $table->integer('child_examnameid')->length(11);
            $table->integer('studentid')->length(11);
            $table->integer('coursecodeid')->length(11);
            $table->double('obt_marks',8,2);
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
        Schema::dropIfExists('child_exam_marks');
    }
}
