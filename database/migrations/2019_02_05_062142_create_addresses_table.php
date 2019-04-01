<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('divisionid')->length(11);
            $table->integer('districtid')->length(11);
            $table->integer('thanaid')->length(11);
            $table->integer('postofficeid')->length(11);
            $table->string('postcode',150);
            $table->integer('localgovid')->length(11);
            $table->string('address',100);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
