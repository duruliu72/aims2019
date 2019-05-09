<?php

namespace App\com\adventure\school\admission;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionProgramSubject;
use App\com\adventure\school\admission\Applicant;
use Illuminate\Database\Eloquent\Model;

class AdmissionMarkEntry extends Model
{
    public function getResultForMarkEntry($sessionid,$programid,$groupid,$mediumid,$shiftid){
        $aAdmissionProgram=new AdmissionProgram();
        $admission_programid=$aAdmissionProgram->getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // $programofferid=$aAdmissionProgram->getProgramofferid($admission_programid);
        $programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($admission_programid);
        $aApplicant=new Applicant();
        $applicants=$aApplicant->getAllApplicantForMarkAdd($admission_programid);
        $result=array(
           'admissionprogram'=>$programinfo,
           'subjectinfo'=>$subjectinfo,
           'applicants'=>$applicants
        );
        return $result;
    }
    public function getResult($admission_programid){
        $aAdmissionProgram=new AdmissionProgram();
        $programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($admission_programid);
        $aApplicant=new Applicant();
        $applicants=$aApplicant->getAllApplicantForMarkAdd($admission_programid);
        $result=array(
           'admissionprogram'=>$programinfo,
           'subjectinfo'=>$subjectinfo,
           'applicants'=>$applicants
        );
        return $result;
    }
    public function checkAplicant($applicantid){
		$sql="SELECT * FROM `admissionresult` WHERE applicantid=? GROUP BY applicantid";
		$qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult);
		if($result->count()>0){
			return true;
		}
		return false;
	}
    
}
