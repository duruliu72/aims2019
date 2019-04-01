<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
     protected $table="shifts";
     protected $fillable = ['name','startTime','endTime','status'];
}
