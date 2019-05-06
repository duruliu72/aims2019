<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppStartEndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_start_end', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionid')->length(11);
            $table->dateTime('app_startDate');
            $table->dateTime('app_endDate');
            $table->date('examStartDate')->nullable();
            $table->integer('exam_status')->length(5)->default(0);
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
        Schema::dropIfExists('app_start_end');
    }
}
