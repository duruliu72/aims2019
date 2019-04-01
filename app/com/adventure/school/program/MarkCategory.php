<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class MarkCategory extends Model
{
    protected $table="mark_categories";
    protected $fillable = ['name','status'];
}
