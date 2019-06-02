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

	public function getApplicantid($applicantid,$pin_code=""){
		$sql="SELECT * FROM `applicants` WHERE applicantid=?";
		$data=array();
		array_push($data,$applicantid);
		if($pin_code!=""){
			$sql.=" && pin_code=?";
			array_push($data,$pin_code);
		}
		$qresult=\DB::select($sql,$data);
		$result=collect($qresult);
		$applicant=$result->first();
		$applicantid=$applicant->applicantid;
		return $applicantid;
	}
	public function getApplicant($applicantid,$pin_code=""){
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
		if($pin_code!=""){
			$sql.=" && pin_code=?";
			array_push($data,$pin_code);
		}
		$qresult=\DB::select($sql,$data);
		$applicant=collect($qresult)->first();
		return $applicant;
	}
	public function makeAppicantid($programofferid){
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
}
