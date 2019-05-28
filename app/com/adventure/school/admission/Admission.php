<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionApplicant;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionProgramSubject;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\basic\Address;
class Admission extends Model
{
	public function getApplicantCopy($applicantid,$pin_code=""){
        $applicant=new Applicant();
        $applicant=$applicant->getApplicant($applicantid,$pin_code);
        $present_addressid=0;
        if($applicant!=null){
            $present_addressid=$applicant->present_addressid;
        }
        $aAdmissionApplicant=new AdmissionApplicant();
        $admissionApplicant=$aAdmissionApplicant->getAdmissionApplicant($applicantid);
		$programofferid=$admissionApplicant->programofferid;
        $aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
		$aAddress=new Address();
		$presentAddress=$aAddress->getAddressById($present_addressid);
		$institute=Institute::getInstituteName();
		$list=array(
			'institute'=>$institute,
			'applicant'=>$applicant,
			'programofferinfo'=>$programofferinfo,
			'presentAddress'=>$presentAddress
		);
		return $list;
    }
    public function getApplicantAdmitCard($applicantid,$pin_code=""){
		$applicant=new Applicant();
		$applicant=$applicant->getApplicant($applicantid,$pin_code);
		$aAdmissionApplicant=new AdmissionApplicant();
		$admissionApplicant=$aAdmissionApplicant->getAdmissionApplicant($applicantid);
		$programofferid=$admissionApplicant->programofferid;
		$aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
		$aAdmissionProgram=new AdmissionProgram();
		$admissionProgram=$aAdmissionProgram->getAdmissionProgramOnPO($programofferid);
		$aAdmissionProgramSubject=new AdmissionProgramSubject();
		$subject=$aAdmissionProgramSubject->getAdmissionProgramSubjects($programofferid);
		$institute=Institute::getInstituteName();
		$list=array(
			'institute'=>$institute,
			'applicant'=>$applicant,
			'admissionApplicant'=>$admissionApplicant,
			'programofferinfo'=>$programofferinfo,
			'admissionProgram'=>$admissionProgram,
			'subject'=>$subject
		);
		return $list;
	}
}
