<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class MasterExam extends Model
{
    protected $table="master_exam";
    protected $fillable = ['name','status'];
}
