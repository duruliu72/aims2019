<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplicant extends Model
{
    protected $table="admissionapplicants";
    protected $fillable = ['programofferid','applicantid','admssion_roll','status'];
    public function getAdmissionApplicant($applicantid){
        $sql="SELECT * FROM `admissionapplicants` WHERE applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
        $admissionApplicant=collect($qresult)->first();
        return $admissionApplicant;
    }
}
