<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\academic\StudentHouse;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\academic\Student;
class StudentRegistration extends Model
{
    // Through Admission
    public function getApplcantForRegistration($applicantid){
        $aStudentHouse=new StudentHouse();
		$admissionApplicant=$aStudentHouse->getAdmissionApplicant($applicantid);
		$aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($admissionApplicant->programofferid);
        $merit_list=$this->getApllicants($admissionApplicant->programofferid);
        // $aStudent=new Student();
        // $student=$aStudent->getStudent($applicantid);
        $result=array(
			'programofferinfo'=>$programofferinfo,
			'applicant'=>$merit_list[$applicantid],
            'admissionApplicant'=>$admissionApplicant,
            // 'student'=>$student
            
        );
		return $result;
    }
    public function getApplcantsForRegistration($programofferid){
        $aProgramOffer=new ProgramOffer();
		$programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $merit_list=$this->getApllicants($programofferid);
        asort($merit_list);
        $result=array(
			'programofferinfo'=>$programofferinfo,
			'applicant_list'=>$merit_list
		);
		return $result;
    }
    public function getApllicants($programofferid){
        $sql="SELECT table3.*,
        IFNULL(table4.applicantid,0) AS capplicantid,
        table4.classroll
        FROM(select table1.* ,
        table2.tot_marks
        FROM(SELECT * FROM `students_house`
        WHERE programofferid=? && admittedtypeid=2) table1
        INNER JOIN (SELECT 
        t1.programofferid,
        t1.applicantid,
        SUM(marks) AS tot_marks
        FROM `admissionresult` AS t1
        WHERE programofferid=? GROUP BY t1.programofferid,t1.applicantid) AS table2
        ON table1.programofferid=table2.programofferid && table1.applicantid=table2.applicantid)  AS table3
        LEFT JOIN (SELECT * FROM `students`
        WHERE programofferid=?) as table4
        on table3.programofferid=table4.programofferid && table3.applicantid=table4.applicantid
        ORDER BY table3.tot_marks DESC";
		$qresult=\DB::select($sql,[$programofferid,$programofferid,$programofferid]);
		$merit_list=collect($qresult);
		$applicant_list=array();
		$serial=1;
		foreach($merit_list as $item){
			$aApplicant=new Applicant();
			$applicant=$aApplicant->getApplicant($item->applicantid);
			$applicant_list[$item->applicantid]=[$applicant,$item,$serial];
			$serial++;
		}
		return $applicant_list;
    }
}
