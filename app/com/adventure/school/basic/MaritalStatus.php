<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $table='maritalstatus';
   	protected $fillable = ['name','status'];
}
