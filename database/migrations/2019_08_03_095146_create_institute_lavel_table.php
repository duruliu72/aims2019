<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituteLavelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_lavel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instituteid')->length(4);
            $table->integer('programlevelid')->length(4);
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
        Schema::dropIfExists('institute_lavel');
    }
}
