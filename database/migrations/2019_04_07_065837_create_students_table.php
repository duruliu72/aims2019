<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentid')->length(11);
            $table->integer('programofferid')->length(11);
            $table->integer('sectionid')->length(11);
            $table->integer('applicantid')->length(11)->unique();
            $table->integer('classroll')->length(11);
            $table->integer('fromclass')->length(11);
            $table->integer('fromsection')->length(11);
            $table->integer('studenttype')->length(11);
            $table->integer('currentclass')->length(3);
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
        Schema::dropIfExists('students');
    }
}
