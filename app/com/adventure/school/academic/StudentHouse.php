<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class StudentHouse extends Model
{
    protected  $table='students_house';
    protected $fillable = ['programofferid','applicantid','admittedtypeid','status'];
}
