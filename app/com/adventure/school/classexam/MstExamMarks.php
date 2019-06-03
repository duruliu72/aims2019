<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class MstExamMarks extends Model
{
    protected $table='mst_exam_marks';
    protected $fillable = ['programofferid','sectionid','teacherid','studentid','examnameid','examtypeid','coursecodeid','markcategoryid','marks','status'];
}
