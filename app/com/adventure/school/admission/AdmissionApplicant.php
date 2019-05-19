<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplicant extends Model
{
    protected $table="admissionapplicants";
    protected $fillable = ['admission_programid','applicantid','admssion_roll','status'];
    public function getAdmissionProgramId($applicantid){
        $sql="SELECT * FROM `admissionapplicants` WHERE applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
        $result=collect($qresult)->first();
        $admission_programid=$result->admission_programid;
        return $admission_programid;
    }
}
