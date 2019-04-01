<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table="sections";
    protected $fillable = ['name','status'];
}
