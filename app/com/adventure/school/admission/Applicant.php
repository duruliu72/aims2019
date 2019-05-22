<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\basic\Address;
use App\com\adventure\school\basic\Institute;
class Applicant extends Model
{
    protected $table="applicants";
	protected $fillable = [
		'applicantid','firstName','middleName','lastName',
		'phone',
		'localOrOutsider',
		'fatherName','motherName','f_occupation','m_occupation','father_nid',
		'mother_nid','father_Phone','mother_Phone',
		'dob','age','birthregno',
		'birthpalace','genderid','bloodgroupid',
		'marital_status','religionid','nationalityid','ethnicty',
		'quotaid','abled','email','parent_income',
		'present_addressid','permanent_addressid','guardianName',
		'g_religion','g_contactno','g_occupation','g_income','gurdian_addressid',
		'prevschool','lastclass','result','passingyear','tcno',
		'tcissueddate','picture',
		'signature','father_picture','mother_picture'];
	public function getApplicantid($applicantid,$pin_code){
		$sql="SELECT * FROM `applicants` WHERE applicantid=? && pin_code=?";
		$qresult=\DB::select($sql,[$applicantid,$pin_code]);
		$result=collect($qresult);
		$applicant=$result->first();
		$applicantid=$applicant->applicantid;
		return $applicantid;
	}
	public function getApplicant($applicantid,$pin_code=""){
		$applicant=$this->getApplicantinfo($applicantid,$pin_code);
		$programofferinfo=$this->getApplicantPrograminfo($applicantid);
		$aAddress=new Address();
		$presentAddress=$aAddress->getAddressById($applicant->present_addressid);
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
		$applicant=$this->getApplicantinfo($applicantid,$pin_code);
		$programofferinfo=$this->getApplicantPrograminfo($applicantid);
		$subject=$this->getAdmissionSubject($applicantid,$pin_code);
		$institute=Institute::getInstituteName();
		$list=array(
			'institute'=>$institute,
			'applicant'=>$applicant,
			'programofferinfo'=>$programofferinfo,
			'subject'=>$subject
		);
		return $list;
	}
	public function getApplicantResult($applicantid,$pin_code=""){
		// $sql="";
		// $qresult=\DB::select($sql,[$admission_programid]);
		// $result=collect($qresult);
		return 90;
		return $result;
	}
	public function getApplicantinfo($applicantid,$pin_code){
		$sql="SELECT t1.* ,
		genders.name AS genderName,
		blood_groups.name AS bloodgroupName,
		religions.name AS religionName,
		nationalities.name AS nationalityName,
		quotas.name AS quotaName                              
		FROM applicants AS t1
		LEFT JOIN genders ON t1.genderid=genders.id
		LEFT JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
		LEFT JOIN religions ON t1.religionid=religions.id
		LEFT JOIN nationalities ON t1.`nationalityid`=nationalities.id
		LEFT JOIN quotas ON t1.`quotaid`=quotas.id
		WHERE t1.applicantid=?";
		$data=array();
		array_push($data,$applicantid);
		if($pin_code!==""){
			$sql.=" && pin_code=?";
			array_push($data,$pin_code);
		}
		$qresult=\DB::select($sql,$data);
		$result=collect($qresult)->first();
		return $result;
	}
	public function getApplicantPrograminfo($applicantid){
		$sql="SELECT 
		admissionapplicants.applicantid,
		admissionapplicants.admssion_roll,
		admission_programs.exam_marks,
		admission_programs.exam_date,
		admission_programs.exam_time,
		programoffers.*,
		sessions.name AS sessionName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM `admissionapplicants`
		INNER JOIN admission_programs ON admissionapplicants.admission_programid=admission_programs.id
		INNER JOIN programoffers ON admission_programs.programofferid=programoffers.id
		INNER JOIN sessions ON programoffers.sessionid=sessions.id
		INNER JOIN programs ON programoffers.programid=programs.id
		INNER JOIN groups ON programoffers.groupid=groups.id
		INNER JOIN mediums ON programoffers.mediumid=mediums.id
		INNER JOIN shifts ON programoffers.shiftid=shifts.id
		WHERE admissionapplicants.applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult)->first();
		return $result;
	}
	public function getAdmissionSubject($applicantid,$pin_code){
		$sql="select admission_program_subjects.*,
		admission_subjects.name AS admissionSubject
		FROM (SELECT admission_programs.id FROM `applicants`
		INNER JOIN admissionapplicants ON applicants.applicantid=admissionapplicants.applicantid
		INNER JOIN admission_programs ON admissionapplicants.admission_programid=admission_programs.id
		WHERE applicants.applicantid=? && applicants.pin_code=?) AS table1
		INNER JOIN admission_program_subjects ON table1.id=admission_program_subjects.admission_programid
		INNER JOIN admission_subjects ON admission_program_subjects.subjectid=admission_subjects.id";
		$qresult=\DB::select($sql,[$applicantid,$pin_code]);
		$result=collect($qresult);
		return $result;
	}
	public function makeAppicantid($admission_programid){
		$aAdmissionProgram=new AdmissionProgram();
		$programofferid=$aAdmissionProgram->getProgramofferid($admission_programid);
		$sql="SELECT 
		concat(substr(sessions.name,3),programs.programsign,'0000') AS startpoint
		FROM `programoffers`
		INNER JOIN sessions ON programoffers.sessionid=sessions.id
		 INNER JOIN programs ON programoffers.programid=programs.id
		WHERE programoffers.id=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		$startpoint=$result->first()->startpoint++;
		$substr=substr($startpoint, 0,4);
		$sql="SELECT * FROM `applicants` WHERE applicants.applicantid LIKE concat($substr,'%%%%') ORDER BY id DESC";
		$qresult=\DB::select($sql);
		$result=collect($qresult);
		if($result->count()>0){
			$id=$result->first()->applicantid;
		 	$id++;
			return $id;
		}
		return ++$startpoint;
	}
	public function getAllApplicantForMarkAdd($admission_programid){
		$sql="select table1.* FROM(SELECT 
		admissionapplicants.id AS admission_applicantid,
admissionapplicants.admission_programid,
admissionapplicants.admssion_roll,
applicants.*
FROM `admissionapplicants`
INNER JOIN applicants ON admissionapplicants.applicantid=applicants.applicantid
WHERE admissionapplicants.admission_programid=?) AS table1
WHERE table1.admission_applicantid NOT IN (SELECT admissionresult.admission_applicantid FROM `admissionresult` GROUP BY admissionresult.admission_applicantid)";
		$qresult=\DB::select($sql,[$admission_programid]);
		$result=collect($qresult);
		return $result;
	}

	// For Admission Result Program offer wise
	public function allApplicantForResult($admission_programid){
		$sql="select 
		t1.*,
		t2.tot_marks
		from (SELECT
		applicants.*,
        admissionapplicants.id AS admission_applicantid,
        religions.name AS religionName,
		admssion_roll
		FROM `admissionapplicants`
		INNER JOIN applicants ON admissionapplicants.applicantid=applicants.applicantid
        INNER JOIN religions ON applicants.religionid=religions.id
		WHERE admission_programid=?) AS t1
		INNER JOIN
		(SELECT 
				admissionresult.admission_applicantid,
				SUM(admissionresult.marks) AS tot_marks
				FROM `admissionresult`
				GROUP BY admission_applicantid) AS t2 ON t1.admission_applicantid=t2.admission_applicantid ORDER BY t2.tot_marks DESC";
		$qresult=\DB::select($sql,[$admission_programid]);
		$result=collect($qresult);
		return $result;
	}
	public function getAllApplicantForMarkEdit($admission_programid){
		$sql="SELECT t1.* FROM (
			SELECT 
    admissionapplicants.id AS admission_applicantid,
					admissionapplicants.admission_programid,
					admissionapplicants.admssion_roll,
					applicants.*
					FROM `admissionapplicants`
					INNER JOIN applicants ON admissionapplicants.applicantid=applicants.applicantid
					WHERE admissionapplicants.admission_programid=?
			) AS t1
			INNER JOIN (SELECT admissionresult.admission_applicantid FROM admissionresult GROUP BY admissionresult.admission_applicantid) AS t2
			ON t1.admission_applicantid=t2.admission_applicantid";
		$qresult=\DB::select($sql,[$admission_programid]);
		$result=collect($qresult);
		return $result;
	}
}
