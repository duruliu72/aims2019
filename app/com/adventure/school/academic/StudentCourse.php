<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected  $table='student_courses';
    protected $fillable = ['studentid','coursecodeid','coursetypeid','status'];
}
