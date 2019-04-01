<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->integer('institutetypeid')->length(11)->nullable();
            $table->integer('categoryid')->length(11)->nullable();
            $table->integer('subcategoryid')->length(11)->nullable();
            $table->integer('addressid')->length(11)->nullable();
            $table->string('wordno',100)->length(20)->nullable($value = true);
            $table->string('cluster',100)->length(20)->nullable($value = true);
            $table->bigInteger('ein')->length(20)->nullable($value = true);
            $table->string('institutelogo',150);
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
        Schema::dropIfExists('institutes');
    }
}
