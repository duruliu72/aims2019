<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class PLevel extends Model
{
    protected  $table='programlevels';
    protected $fillable = ['name','status'];
}
