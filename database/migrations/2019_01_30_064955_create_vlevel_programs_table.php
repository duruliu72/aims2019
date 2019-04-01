<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVlevelProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vlevel_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programlevelid')->length(11);
            $table->integer('programid')->length(11);
            $table->integer('status')->length(5)->default(0);
            $table->timestamps();
            $table->unique('programid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vlevel_programs');
    }
}
