<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table='religions';
   	protected $fillable = ['name','status'];
}
