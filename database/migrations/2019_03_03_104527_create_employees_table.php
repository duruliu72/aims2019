<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employeeidno')->length(11)->unique();
            $table->integer('employeetypeid')->length(11);
            $table->integer('designationid')->length(11);
            $table->integer('departmentid')->length(11);
            $table->integer('employmentstatusid')->length(11);
            $table->integer('employeestatusid')->length(11);
            $table->date('joining_date');
            $table->date('retirement_date');
            $table->integer('employeeposition')->length(11);
            $table->string('first_name',150);
            $table->string('middle_name',150);
            $table->string('last_name',150);
            $table->string('father_name',150);
            $table->string('mother_name',150);
            $table->integer('genderid')->length(11);
            $table->string('mobileno',150)->nullable();
            $table->date('dob');
            $table->string('birthregno',150)->nullable();
            $table->integer('nationalityid')->length(11);
            $table->string('nationalidno',150);
            $table->integer('bloodgroupid')->length(11);
            $table->integer('marital_statusid')->length(11);
            $table->string('email',150)->nullable();
            $table->integer('present_addressid')->length(11);
            $table->string('picture',150)->nullable();
            $table->string('signature',150)->nullable();
            $table->integer('indexno')->length(11)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
