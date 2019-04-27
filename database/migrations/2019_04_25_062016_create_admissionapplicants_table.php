<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionapplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissionapplicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programofferid')->length(11);
            $table->integer('applicantid')->length(11);
            $table->integer('admssion_roll')->length(11)->nullable()->unique();
            $table->integer('fromclass')->length(11);
            $table->integer('fromsection')->length(11);
            $table->integer('admissionDate')->length(11);
            $table->integer('studenttype')->length(11);
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
        Schema::dropIfExists('admissionapplicants');
    }
}
