<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class Applicant extends Model
{
    protected $table="applicants";
	protected $fillable = ['programofferid','admssion_roll','name','fatherName','motherName','f_occupation','m_occupation','father_nid','mother_nid','father_Phone','mother_Phone','dob','age','birthregno','birthpalace','genderid','bloodgroupid','marital_status','religionid','nationalityid','ethnicty','quotaid','abled','email','parent_income','present_addressid','permanent_addressid','guardianName','g_religion','g_contactno','g_occupation','g_income','gurdian_addressid','prevschool','lastclass','result','passingyear','tcno','tcissueddate','picture','signature','father_picture','mother_picture','username','password'];
	public function getApplicant($username,$password){
		$sql="SELECT t1.* ,
        t2.sessionid,
		sessions.name AS sessionName,
		t2.programid,
		programs.name AS programName,
		t2.groupid,
		groups.name AS groupName,
		t2.mediumid,
		mediums.name AS mediumName,
		t2.shiftid,
		shifts.name AS shiftName,
		genders.name AS genderName,
		blood_groups.name AS bloodgroupName,
		religions.name AS religionName,
		nationalities.name AS nationalityName,
		quotas.name AS quotaName                              
        FROM applicants AS t1
        INNER JOIN admission_programs ON t1.programofferid=admission_programs.programofferid 
        INNER JOIN programoffers AS t2 ON admission_programs.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id
		INNER JOIN genders ON t1.genderid=genders.id
		INNER JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
		INNER JOIN religions ON t1.religionid=religions.id
		INNER JOIN nationalities ON t1.`nationalityid`=nationalities.id
		INNER JOIN quotas ON t1.`quotaid`=quotas.id
        WHERE t1.username=? AND password=?";
		$qresult=\DB::select($sql,[$username,$password]);
		$result=collect($qresult)->first();
		return $result;
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
	public function getApplicantByApplicantID($applicantid){
		$sql="SELECT 
		sum(bill_accounts.amount)  AS amount,
		IF(sum(bill_accounts.amount)>=500, 'Paid', 'Not Paid') AS statement,
		t1.* ,
        t2.sessionid,
		sessions.name AS sessionName,
		t2.programid,
		programs.name AS programName,
		t2.groupid,
		groups.name AS groupName,
		t2.mediumid,
		mediums.name AS mediumName,
		t2.shiftid,
		shifts.name AS shiftName,
		genders.name AS genderName,
		blood_groups.name AS bloodgroupName,
		religions.name AS religionName,
		nationalities.name AS nationalityName,
		quotas.name AS quotaName                              
        FROM applicants AS t1
        INNER JOIN admission_programs ON t1.programofferid=admission_programs.programofferid 
        INNER JOIN programoffers AS t2 ON admission_programs.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id
		INNER JOIN genders ON t1.genderid=genders.id
		INNER JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
		INNER JOIN religions ON t1.religionid=religions.id
		INNER JOIN nationalities ON t1.`nationalityid`=nationalities.id
		INNER JOIN quotas ON t1.`quotaid`=quotas.id
        LEFT JOIN bill_accounts ON t1.programofferid=bill_accounts.programofferid AND t1.applicantid=bill_accounts.sender_receiver
        WHERE t1.applicantid=? GROUP BY t1.applicantid";
		$qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult)->first();
		return $result;
	}
	public function checkUsername($username){
		$sql="SELECT * FROM `applicants` WHERE username=?";
		$qresult=\DB::select($sql,[$username]);
		$result=collect($qresult);
		if ($result->count()>0) {
			return true;
		}
		return false;
	}
	public function isPaid($applicantid){
		$sql="SELECT t3.* FROM(SELECT 
		t1.programofferid,
		t1.applicantid ,
		sum(t2.amount)  AS amount,
		IF(sum(t2.amount)>=500, 1, 0) AS checkstatus
		FROM `applicants` AS t1
		LEFT JOIN bill_accounts AS t2 ON t1.applicantid=t2.sender_receiver GROUP BY t1.applicantid) AS t3 WHERE t3.applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult);
		$aObj=$result->first();
		$checkstatus=$aObj->checkstatus;
		return ($checkstatus==1)?true:false;
	}
	public function getAllApplicantStatus(){
		$sql="SELECT 
		IFNULL(sum(bill_accounts.amount),0) AS amount,
		IF(sum(bill_accounts.amount)>=500, 'Paid', 'Not Paid') AS paymentstatus,
		t1.* ,
        t2.sessionid,
		sessions.name AS sessionName,
		t2.programid,
		programs.name AS programName,
		t2.groupid,
		groups.name AS groupName,
		t2.mediumid,
		mediums.name AS mediumName,
		t2.shiftid,
		shifts.name AS shiftName,
		genders.name AS genderName,
		blood_groups.name AS bloodgroupName,
		religions.name AS religionName,
		nationalities.name AS nationalityName,
		quotas.name AS quotaName                              
        FROM applicants AS t1
        INNER JOIN admission_programs ON t1.programofferid=admission_programs.programofferid 
        INNER JOIN programoffers AS t2 ON admission_programs.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id
		INNER JOIN genders ON t1.genderid=genders.id
		INNER JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
		INNER JOIN religions ON t1.religionid=religions.id
		INNER JOIN nationalities ON t1.`nationalityid`=nationalities.id
		INNER JOIN quotas ON t1.`quotaid`=quotas.id
        LEFT JOIN bill_accounts ON t1.programofferid=bill_accounts.programofferid AND t1.applicantid=bill_accounts.sender_receiver GROUP BY t1.applicantid";
        $qresult=\DB::select($sql);
		$result=collect($qresult);
		return $result;
	}
	public function getAllApplicantsByPrograoffer($programofferid){
		$sql="SELECT applicants.* FROM `applicants`
		INNER JOIN (SELECT t1.id,
		t1.programofferid,
		t1.sender_receiver,
		sum(t1.amount) AS amount,
		t1.transactionid,
		t1.payment_type,
		t1.methodid,
		t1.from_account,
		t1.`to_account`,
		t1.`payment_date`,
		t1.`approved_date`,
		t1.`short_desc`,
		t1.`status`
		FROM `bill_accounts` AS t1 GROUP BY sender_receiver) AS t2 ON applicants.programofferid=t2.programofferid && applicants.applicantid=t2.sender_receiver WHERE applicants.programofferid=? order by applicants.admssion_roll";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	public function getApplicantsForMarkEntry($programofferid){
		$sql="SELECT t1.* 
		FROM `applicants` AS t1
		INNER JOIN bill_accounts ON bill_accounts.sender_receiver=t1.applicantid
		WHERE t1.programofferid=? AND t1.applicantid NOT IN(SELECT admissionresult.applicantid FROM `admissionresult` GROUP BY admissionresult.applicantid)  GROUP BY t1.applicantid";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	public function getApplicantsForMarkEdit($programofferid){
		$sql="SELECT 
		sum(admissionresult.marks) AS totamarks,
		table1.* FROM 
		(SELECT 
		 sum(bill_accounts.amount) AS amount,
		 t1.*
		FROM `applicants` AS t1
		INNER JOIN bill_accounts ON bill_accounts.sender_receiver=t1.applicantid GROUP BY t1.applicantid) AS table1
		INNER JOIN admissionresult ON table1.applicantid=admissionresult.applicantid WHERE table1.amount>=500
		AND table1.programofferid=? GROUP BY admissionresult.applicantid ORDER BY admissionresult.applicantid";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		// dd($result);
		$list=array();
		$i=0;
		foreach ($result as $x) {
			$a=$this->getAdmissionSubjectMarks($x->applicantid);
			$list[$i]=[
				'applicants'=>$x,
				'subjectinfo'=>$a
			];
			$i++;
		}
		return $list;
	} 
	private function getAdmissionSubjectMarks($applicantid){
		$sql="SELECT * FROM `admissionresult` WHERE applicantid=?";
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
	// ===============================================For Dorpdown ==============
	public function getProgramsOnSession($sessionid){
		if($sessionid==0){
			$yearName = date('Y');
			$aSession=new Session();
			$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT programs.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
		INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
		INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
		INNER JOIN programs ON  t1.programid=programs.id 
		WHERE t1.sessionid=? GROUP BY programs.id";
		$qResult=\DB::select($sql,[$sessionid]);
		return collect($qResult);
	}
	public function getGroupsOnSession($sessionid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT groups.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN groups ON  t1.groupid=groups.id
			WHERE t1.sessionid=? GROUP BY groups.id";
			$qResult=\DB::select($sql,[$sessionid]);
			return collect($qResult);
	}
	public function getMediumsOnSession($sessionid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT mediums.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN mediums ON  t1.mediumid=mediums.id
			WHERE t1.sessionid=? GROUP BY mediums.id";
			$qResult=\DB::select($sql,[$sessionid]);
			return collect($qResult);
	}
	public function getShiftsOnSession($sessionid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT shifts.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN shifts ON  t1.shiftid=shifts.id
			WHERE t1.sessionid=? GROUP BY shifts.id";
			$qResult=\DB::select($sql,[$sessionid]);
			return collect($qResult);
	}
	// =========================
	public function getGroupsOnSessionAndProgram($sessionid,$programid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT groups.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN groups ON  t1.groupid=groups.id
			WHERE t1.sessionid=? AND t1.programid=? GROUP BY groups.id";
			$qResult=\DB::select($sql,[$sessionid,$programid]);
			return collect($qResult);
	}
	public function getMediumsOnSessionAndProgram($sessionid,$programid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT mediums.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN mediums ON  t1.mediumid=mediums.id
			WHERE t1.sessionid=? AND t1.programid=? GROUP BY mediums.id";
			$qResult=\DB::select($sql,[$sessionid,$programid]);
			return collect($qResult);
	}
	public function getShiftsOnSessionAndProgram($sessionid,$programid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT shifts.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN shifts ON  t1.shiftid=shifts.id
			WHERE t1.sessionid=? AND t1.programid=? GROUP BY shifts.id";
			$qResult=\DB::select($sql,[$sessionid,$programid]);
			return collect($qResult);
	}
	// =================================
	public function getMediumsOnSessionAndPrograAndGroup($sessionid,$programid,$groupid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT mediums.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN mediums ON  t1.mediumid=mediums.id
			WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY mediums.id";
			$qResult=\DB::select($sql,[$sessionid,$programid,$groupid]);
			return collect($qResult);
	}
	public function getShiftsOnSessionAndPrograAndGroup($sessionid,$programid,$groupid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT shifts.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN shifts ON  t1.shiftid=shifts.id
			WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY shifts.id";
			$qResult=\DB::select($sql,[$sessionid,$programid,$groupid]);
			return collect($qResult);
	}
	// ============================================
	public function getShiftsOnSessionAndPrograAndGroupAndMedium($sessionid,$programid,$groupid,$mediumid){
			if($sessionid==0){
				$yearName = date('Y');
				$aSession=new Session();
				$sessionid=$aSession->getSessionId($yearName);
			}
			$sql="SELECT shifts.* FROM(SELECT * FROM `applicants`GROUP BY applicants.programofferid) AS ap 
			INNER JOIN admission_programs ON ap.programofferid=admission_programs.programofferid
			INNER JOIN programoffers AS t1 ON ap.programofferid=t1.id
			INNER JOIN shifts ON  t1.shiftid=shifts.id
			WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? AND t1.mediumid=? GROUP BY shifts.id";
			$qResult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
			return collect($qResult);
	}
}
