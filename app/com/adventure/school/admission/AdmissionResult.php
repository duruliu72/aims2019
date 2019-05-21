<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionApplicant;
use App\com\adventure\school\admission\Applicant;
class AdmissionResult extends Model
{
    protected $table="admissionresult";
	protected $fillable = ['applicantid','subjectid','marks'];
	// applicantid wise Result 
	public function getAdmissionResult($applicantid,$pin_code){
		$aApplicant=new Applicant();
		$applicant_id=$aApplicant->getApplicantid($applicantid,$pin_code);
		$aAdmissionApplicant=new AdmissionApplicant();
		$admission_programid=$aAdmissionApplicant->getAdmissionProgramId($applicant_id);
		$aAdmissionProgram=new AdmissionProgram();
		$programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
		$aApplicant=new Applicant();
		$applicant_list=$this->getSerial($admission_programid);
		$applicant=$this->searchApplicant($applicant_list,$applicant_id);
		$result=array(
			'admissionprogram'=>$programinfo,
			'applicants'=>$applicant
		);
		return $result;
	}
	private function searchApplicant($applicant_list,$applicant_id){
		foreach($applicant_list as $x){
			if($x[0]->applicantid==$applicant_id){
				return $x;
			}
		}
		return null;
	}
	// Program offer wise
	public function getAdmissionResults($sessionid,$programid,$groupid,$mediumid,$shiftid){
		$aAdmissionProgram=new AdmissionProgram();
		$admission_programid=$aAdmissionProgram->getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid);
		$programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
		$applicant_list=$this->getSerial($admission_programid);
		$result=array(
			'admissionprogram'=>$programinfo,
			'applicants'=>$applicant_list
		);
		return $result;
	}
	public function getAdmissionApplicants($programofferid){
		$aAdmissionProgram=new AdmissionProgram();
		$admission_programid=$aAdmissionProgram->getAdmissionProgram_id($programofferid);
		$programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
		$applicant_list=$this->getSerial($admission_programid);
		// dd($programofferid,$admission_programid);
		$result=array(
			'admissionprogram'=>$programinfo,
			'applicants'=>$applicant_list
		);
		return $result;
	}
	private function getSerial($admission_programid){
		$aApplicant=new Applicant();
		$applicants=$aApplicant->allApplicantForResult($admission_programid);
		$applicant_list=array();
		$serialno=1;
		foreach($applicants as $applicant){
			$applicant_list[$applicant->applicantid]=[$applicant,$serialno];
			$serialno++;
		}
		asort($applicant_list);
		return $applicant_list;
	}
}
