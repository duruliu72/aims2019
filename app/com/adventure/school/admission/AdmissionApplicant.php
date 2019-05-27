<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplicant extends Model
{
    protected $table="admissionapplicants";
    protected $fillable = ['programofferid','applicantid','admssion_roll','status'];
    public function getProgramOfferId($applicantid){
        $sql="SELECT * FROM `admissionapplicants` WHERE applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
        $result=collect($qresult)->first();
        $programofferid=$result->programofferid;
        return $programofferid;
    }
}
