<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
	   protected $table='employeetypes';
	   protected $fillable = ['name','status'];
}
