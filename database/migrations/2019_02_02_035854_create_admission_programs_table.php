<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->double('required_gpa', 8, 2)->nullable();
            $table->double('exam_marks', 8, 2)->nullable();
            $table->date('exam_date')->nullable();
            $table->time('exam_time')->nullable();
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
        Schema::dropIfExists('admission_programs');
    }
}
