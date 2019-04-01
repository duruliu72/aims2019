<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table="groups";
    protected $fillable = ['name','status'];
}
