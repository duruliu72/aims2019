<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $table="mediums";
    protected $fillable = ['name','status'];
}
