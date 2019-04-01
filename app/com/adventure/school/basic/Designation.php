<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table='designations';
   	protected $fillable = ['name','status'];
}
