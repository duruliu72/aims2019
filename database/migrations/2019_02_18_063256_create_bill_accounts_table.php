<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('sender_receiver')->length(11);
            $table->double('amount',8,2)->nullable();
            $table->integer('transactionid')->length(11)->nullable()->unique();
            $table->integer('payment_type')->length(11)->nullable();
            $table->integer('methodid')->length(11)->nullable();
            $table->string('from_account',100)->nullable();
            $table->string('to_account',100)->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->string('short_desc',200)->nullable();
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
        Schema::dropIfExists('bill_accounts');
    }
}
