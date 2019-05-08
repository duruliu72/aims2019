<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplicant extends Model
{
    protected $table="admissionapplicants";
    protected $fillable = ['admission_programid','applicantid','admssion_roll','status'];
}
