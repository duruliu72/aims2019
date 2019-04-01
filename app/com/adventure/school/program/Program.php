<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
     protected  $table='programs';
     protected $fillable = ['name','status'];
}
