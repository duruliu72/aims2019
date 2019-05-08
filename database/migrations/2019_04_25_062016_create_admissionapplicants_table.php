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
            $table->integer('admission_programid')->length(11);
            $table->integer('applicantid')->length(11);
            $table->integer('admssion_roll')->length(11)->nullable()->unique();
            $table->integer('status')->length(5)->default(0);
            $table->timestamps();
            $table->index(['admission_programid', 'admssion_roll']);
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
