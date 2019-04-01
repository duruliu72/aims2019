<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";
    protected $fillable = ['name','status'];
}
