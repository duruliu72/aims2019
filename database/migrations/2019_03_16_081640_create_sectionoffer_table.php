<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionofferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectionoffer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('sectionid')->length(11);
            $table->integer('section_std_num')->length(6);
            $table->integer('section_teacher')->length(6)->nullable();
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
        Schema::dropIfExists('sectionoffer');
    }
}
