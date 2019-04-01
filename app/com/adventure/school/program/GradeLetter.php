<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class GradeLetter extends Model
{
    protected $table="grade_letter";
    protected $fillable = ['name','status'];
}
