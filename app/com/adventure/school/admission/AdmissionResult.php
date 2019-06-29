<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\academic\StudentHouse;
use App\com\adventure\school\admission\Applicant;
class AdmissionResult extends Model
{
    protected $table="admissionresult";
	protected $fillable = ['programofferid','applicantid','subjectid','marks'];
	public function getAdmissionResult($applicantid){
		$aStudentHouse=new StudentHouse();
		$admissionApplicant=$aStudentHouse->getAdmissionApplicant($applicantid);
		$aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($admissionApplicant->programofferid);
		$applicant_list=$this->getApplicantOnMerits($admissionApplicant->programofferid);
		$result=array(
			'programofferinfo'=>$programofferinfo,
			'applicant'=>$applicant_list[$applicantid],
			'admissionApplicant'=>$admissionApplicant
		);
		return $result;
	}
	public function getAdmissionResults($programofferid){
		$aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
		$applicant_list=$this->getApplicantOnMerits($programofferid);
		asort($applicant_list);
		$result=array(
			'programofferinfo'=>$programofferinfo,
			'applicant_list'=>$applicant_list
		);
		return $result;
	}
	public function getApplicantOnMerits($programofferid){
		$sql="select table1.* ,
		table2.tot_marks
		FROM(SELECT * FROM `students_house`
		WHERE programofferid=?) table1
		LEFT JOIN (SELECT 
		t1.programofferid,
		t1.applicantid,
		SUM(marks) AS tot_marks
		FROM `admissionresult` AS t1
		WHERE programofferid=? GROUP BY t1.programofferid,t1.applicantid) AS table2
		ON table1.programofferid=table2.programofferid && table1.applicantid=table2.applicantid 
		ORDER BY table2.tot_marks DESC";
		$qresult=\DB::select($sql,[$programofferid,$programofferid]);
		$merit_list=collect($qresult);
		$applicant_list=array();
		$serial=1;
		foreach($merit_list as $item){
			$aApplicant=new Applicant();
			$applicant=$aApplicant->getApplicant($item->applicantid);
			$applicant_list[$item->applicantid]=[$applicant,$item,$serial];
			$serial++;
		}
		// dd($applicant_list);
		return $applicant_list;
	}
}
