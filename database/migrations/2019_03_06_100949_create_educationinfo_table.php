<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educationinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employeeid')->length(11);
            $table->integer('educationdegreeid')->length(11);
            $table->string('discipline',100);
            $table->double('grade',8,2)->nullable();
            $table->string('passingyear',100);
            $table->string('board',200);
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
        Schema::dropIfExists('educationinfo');
    }
}
