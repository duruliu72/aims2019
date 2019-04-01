<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
   protected $table='employmentstatus';
   protected $fillable = ['name','status'];
}
