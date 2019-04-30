<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicantid')->length(11)->unique();
            $table->string('firstName',150);
            $table->string('middleName',150);
            $table->string('lastName',150);
            $table->string('phone',150)->nullable();
            $table->integer('localOrOutsider')->length(2)->nullable();
            $table->string('fatherName',150);
            $table->string('motherName',150);
            $table->string('f_occupation',150)->nullable();
            $table->string('m_occupation',150)->nullable();
            $table->string('father_nid',150)->nullable();
            $table->string('mother_nid',150)->nullable();
            $table->string('father_Phone',150)->nullable();
            $table->string('mother_Phone',150)->nullable();
            $table->date('dob');
            $table->string('age',50);
            $table->string('birthregno',150)->nullable();
            $table->string('birthpalace',150)->nullable();
            $table->integer('genderid')->length(11);
            $table->integer('bloodgroupid')->length(11);
            $table->string('marital_status',150)->nullable();
            $table->integer('religionid')->length(11);
            $table->integer('nationalityid')->length(11);
            $table->string('ethnicty',150)->nullable();
            $table->integer('quotaid')->length(11);
            $table->string('abled',150)->nullable();
            $table->string('email',150)->nullable();
            $table->double('parent_income',8,2)->nullable();
            $table->integer('present_addressid')->length(11);
            $table->integer('permanent_addressid')->length(11);
            $table->string('guardianName',150);
            $table->integer('g_religion')->length(11)->nullable();
            $table->string('g_contactno',150)->nullable();
            $table->string('g_occupation',150)->nullable();
            $table->double('g_income',8,2)->nullable();
            $table->integer('gurdian_addressid')->nullable();
            $table->string('prevschool',150)->nullable();
            $table->string('lastclass',150)->nullable();
            $table->double('result',8,2)->nullable();
            $table->string('passing_year',150)->nullable();
            $table->string('tcno',150)->nullable();
            $table->date('tcissueddate')->nullable();
            $table->string('picture',150)->nullable();
            $table->string('signature',150)->nullable();
            $table->string('father_picture',150)->nullable();
            $table->string('mother_picture',150)->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
