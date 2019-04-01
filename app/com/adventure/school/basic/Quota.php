<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    protected $table='quotas';
   	protected $fillable = ['name','status'];
   	
}
