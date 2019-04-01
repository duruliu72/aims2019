<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table='nationalities';
   	protected $fillable = ['name','status'];
}
