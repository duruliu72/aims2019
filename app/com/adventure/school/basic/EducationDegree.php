<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EducationDegree extends Model
{
    protected $table='education_degree';
	protected $fillable = ['name','status'];
}
