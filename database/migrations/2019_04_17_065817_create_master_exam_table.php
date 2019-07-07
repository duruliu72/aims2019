<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_exam', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('examnameid')->length(11);
            $table->double('exhld_in_percentage',8,2);
            $table->double('mxm_in_percentage',8,2);
            $table->double('cxm_in_percentage',8,2);
            $table->integer('result_with_child')->length(11);
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
        Schema::dropIfExists('master_exam');
    }
}
