<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected  $table='course_type';
    protected $fillable = ['name','status'];
}
