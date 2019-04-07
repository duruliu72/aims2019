<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected  $table='students';
    protected $fillable = ['programofferid','sectionid','studentregid','classroll','studenttype','status'];
}