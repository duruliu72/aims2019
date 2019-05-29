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
    public function getAdmissionApplicants($programofferid){
        $sql="SELECT t1.* ,
        genders.name AS genderName,
        blood_groups.name AS bloodgroupName,
        religions.name AS religionName,
        nationalities.name AS nationalityName,
        quotas.name AS quotaName,
        t2.programofferid,
        t2.admssion_roll
        FROM applicants AS t1
        LEFT JOIN genders ON t1.genderid=genders.id
        LEFT JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
        LEFT JOIN religions ON t1.religionid=religions.id
        LEFT JOIN nationalities ON t1.`nationalityid`=nationalities.id
        LEFT JOIN quotas ON t1.`quotaid`=quotas.id
        INNER JOIN 
        admissionapplicants AS t2 ON t1.applicantid=t2.applicantid
        WHERE t2.programofferid=?";
        $qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
    }
}
