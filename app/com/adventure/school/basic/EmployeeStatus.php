<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
     protected $table='employeestatus';
	protected $fillable = ['name','status'];
}
