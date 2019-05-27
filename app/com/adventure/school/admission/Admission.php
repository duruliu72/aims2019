<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionApplicant;
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
        // dd($applicant);
        $aAdmissionApplicant=new AdmissionApplicant();
        $programofferid=$aAdmissionApplicant->getProgramOfferId($applicantid);
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
    // public function getApplicantAdmitCard($applicantid,$pin_code=""){
	// 	$applicant=$this->getApplicantinfo($applicantid,$pin_code);
	// 	$programofferinfo=$this->getApplicantPrograminfo($applicantid);
	// 	$subject=$this->getAdmissionSubject($applicantid,$pin_code);
	// 	$institute=Institute::getInstituteName();
	// 	$list=array(
	// 		'institute'=>$institute,
	// 		'applicant'=>$applicant,
	// 		'programofferinfo'=>$programofferinfo,
	// 		'subject'=>$subject
	// 	);
	// 	return $list;
	// }
}
