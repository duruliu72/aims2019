<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarkDistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_distribution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('courseid')->length(11);
            $table->integer('markcategoryid')->length(11);
            $table->double('mark_in_percentage',8,2)->nullable();
            $table->integer('cat_hld_mark')->length(4);
            $table->integer('percentage_mark')->length(4);
            $table->integer('mark_group_id')->length(4);
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
        Schema::dropIfExists('mark_distribution');
    }
}
