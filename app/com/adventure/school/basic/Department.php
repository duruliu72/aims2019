<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   	protected $table='departments';
   	protected $fillable = ['name','status'];
}
