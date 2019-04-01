<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradePointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_point', function (Blueprint $table) {
            $table->increments('id');
            $table->string('programofferid',100);
            $table->string('gradeletterid',100);
            $table->double('from_mark',8,2);
            $table->double('to_mark',8,2);
            $table->double('gradepoint',8,2);
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
        Schema::dropIfExists('grade_point');
    }
}
