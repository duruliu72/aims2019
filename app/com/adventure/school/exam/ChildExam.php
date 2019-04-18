<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class ChildExam extends Model
{
    protected $table="child_exam";
    protected $fillable = ['name','status'];
}
