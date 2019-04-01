<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table='divisions';
   	protected $fillable = ['name','status'];
}
