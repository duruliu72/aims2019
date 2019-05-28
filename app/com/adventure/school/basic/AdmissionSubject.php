<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class AdmissionSubject extends Model
{
    protected $table='admission_subjects';
    protected $fillable = ['name','status']; 
}
