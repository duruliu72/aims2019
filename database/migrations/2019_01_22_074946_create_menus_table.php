<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id')->length(10);
            $table->string('name',50);
            $table->string('url',50)->nullable();
            $table->integer('parentid')->length(10);
            $table->integer('menuorder')->length(10)->default(0);
            $table->integer('status')->length(5)->default(0);
            $table->timestamps();
            $table->unique('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
