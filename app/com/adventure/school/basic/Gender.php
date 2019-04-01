<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table='genders';
   	protected $fillable = ['name','status'];
}
