<?php

namespace App\com\adventure\school\admission;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionProgramSubject;
use App\com\adventure\school\admission\Applicant;
use Illuminate\Database\Eloquent\Model;

class AdmissionMarkEntry extends Model
{
    public function getAllForMarkEntry($sessionid,$programid,$groupid,$mediumid,$shiftid){
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
    public function getAllForMarkEdit($sessionid,$programid,$groupid,$mediumid,$shiftid){
        $aAdmissionProgram=new AdmissionProgram();
        $admission_programid=$aAdmissionProgram->getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // $programofferid=$aAdmissionProgram->getProgramofferid($admission_programid);
        $programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($admission_programid);
        $aApplicant=new Applicant();
        $applicants=$aApplicant->getAllApplicantForMarkEdit($admission_programid);
        $tot_marksList=array();
        foreach($applicants as $applicant){
            $tot_marksList[$applicant->applicantid]=$this->getTotalMark($applicant->applicantid);
        }
        $markLst=array();
        foreach($applicants as $applicant){
            $item=array();
            $subjects=$this->getSubjectMark($applicant->applicantid);
            foreach($subjects as $subject){
                $item[$subject->subjectid]=$subject->marks;
            }
            $markLst[$applicant->applicantid]=$item;
        }
        $result=array(
           'admissionprogram'=>$programinfo,
           'subjectinfo'=>$subjectinfo,
           'applicants'=>$applicants,
           'tot_marksList'=>$tot_marksList,
           'markLst'=>$markLst
        );
        return $result;
    }
    public function getAllForMarkEditOnId($admission_programid){
        $aAdmissionProgram=new AdmissionProgram();
        $programinfo=$aAdmissionProgram->getAdmissionPrograminfo($admission_programid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($admission_programid);
        $aApplicant=new Applicant();
        $applicants=$aApplicant->getAllApplicantForMarkEdit($admission_programid);
        $tot_marksList=array();
        foreach($applicants as $applicant){
            $tot_marksList[$applicant->applicantid]=$this->getTotalMark($applicant->applicantid);
        }
        $markLst=array();
        foreach($applicants as $applicant){
            $item=array();
            $subjects=$this->getSubjectMark($applicant->applicantid);
            foreach($subjects as $subject){
                $item[$subject->subjectid]=$subject->marks;
            }
            $markLst[$applicant->applicantid]=$item;
        }
        $result=array(
           'admissionprogram'=>$programinfo,
           'subjectinfo'=>$subjectinfo,
           'applicants'=>$applicants,
           'tot_marksList'=>$tot_marksList,
           'markLst'=>$markLst
        );
        return $result;
    }
    public function getTotalMark($applicantid){
        $sql="SELECT
        SUM(marks) AS total_marks
        FROM `admissionresult` WHERE applicantid=?";
        $qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult)->first();
		return $result;
    }
    public function getSubjectMark($applicantid){
        $sql="SELECT * FROM `admissionresult`
        WHERE applicantid=?";
        $qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult);
		return $result;
    }
    public function getResultOnID($admission_programid){
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
    public function editMark(){

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
