<?php

namespace App\com\adventure\school\admission;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionProgramSubject;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionApplicant;
use Illuminate\Database\Eloquent\Model;

class AdmissionMarkEntry extends Model
{
    public function getAllForMarkEntry($programofferid){
        $aProgramOffer=new ProgramOffer();
        $programinfo=$aProgramOffer->getProgramOffer($programofferid);
        $aAdmissionProgram=new AdmissionProgram();
        $admissionprogram=$aAdmissionProgram->getAdmissionProgramOnPO($programofferid);
        $admissionApplicants=$this->getApplicantsForMarkAdd($programofferid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($programofferid);
        $result=array(
            'applicants'=>$admissionApplicants,
            'programoffer'=>$programinfo,
            'admissionprogram'=>$admissionprogram,
            'subjectinfo'=>$subjectinfo
        );
        return $result;
    }
    public function getAllForMarkEdit($programofferid){
        $aProgramOffer=new ProgramOffer();
        $programinfo=$aProgramOffer->getProgramOffer($programofferid);
        $aAdmissionProgram=new AdmissionProgram();
        $admissionprogram=$aAdmissionProgram->getAdmissionProgramOnPO($programofferid);
        $admissionApplicants=$this->getApplicantsForMarkEdit($programofferid);
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $subjectinfo=$aAdmissionProgramSubject->getAdmissionSubject($programofferid);
        $markLst=array();
        foreach($admissionApplicants as $applicant){
            $item=array();
            $subjects=$this->getSubjectMark($applicant->applicantid);
            foreach($subjects as $subject){
                $item[$subject->subjectid]=$subject->marks;
            }
            $markLst[$applicant->applicantid]=$item;
        }
        $tot_marksList=array();
        foreach($admissionApplicants as $applicant){
            $tot_marksList[$applicant->applicantid]=$this->getTotalMark($applicant->applicantid);
        }
        $result=array(
            'applicants'=>$admissionApplicants,
            'programoffer'=>$programinfo,
            'admissionprogram'=>$admissionprogram,
            'subjectinfo'=>$subjectinfo,
            'tot_marksList'=>$tot_marksList,
            'markLst'=>$markLst
        );
        return $result;
    }
    private function getApplicantsForMarkAdd($programofferid){
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
        WHERE t2.programofferid=? && t1.applicantid NOT IN(SELECT applicantid FROM `admissionresult`
        WHERE programofferid=? GROUP BY applicantid)";
        $qresult=\DB::select($sql,[$programofferid,$programofferid]);
        $result=collect($qresult);
        return $result;
    }
    public function getApplicantsForMarkEdit($programofferid){
        $sql="SELECT 
        maintabe.* 
        FROM(SELECT t1.* ,
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
        INNER JOIN admissionapplicants AS t2 ON t1.applicantid=t2.applicantid
        WHERE t2.programofferid=?) AS maintabe
        INNER JOIN(SELECT applicantid FROM `admissionresult`
        WHERE programofferid=? GROUP BY applicantid) AS childtable ON maintabe.applicantid=childtable.applicantid";
        $qresult=\DB::select($sql,[$programofferid,$programofferid]);
        $result=collect($qresult);
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
