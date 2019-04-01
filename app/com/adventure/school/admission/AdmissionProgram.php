<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class AdmissionProgram extends Model
{
    protected $table="admission_programs";
    protected $primaryKey = 'programofferid';
	protected $fillable = ['programofferid','required_gpa','exam_marks','exam_date','exam_time','status'];
	public function getAllAdmissionProgram(){
		$sql="SELECT t1.* ,
		sessions.name AS sessionName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id ORDER BY sessionName DESC";
		$result=\DB::select($sql);
		return $result;
	}
	public function checkValue($programofferid){
		$sql="SELECT * FROM `admission_programs`
		WHERE programofferid=?";
		$result=\DB::select($sql,[$programofferid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	public function getAllProgram($sessionid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT programs.* 
		FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER join sessions on t2.sessionid=sessions.id
		INNER join programs on t2.programid=programs.id
		WHERE t2.sessionid=? group by t2.programid ORDER BY programs.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllMedium($sessionid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT mediums.* 
		FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER join sessions on t2.sessionid=sessions.id
		INNER join mediums on t2.mediumid=mediums.id
		WHERE t2.sessionid=? group by t2.mediumid ORDER BY mediums.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllShift($sessionid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT shifts.* 
		FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER join sessions on t2.sessionid=sessions.id
		INNER join shifts on t2.shiftid=shifts.id
		WHERE t2.sessionid=? group by t2.shiftid ORDER BY shifts.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllGroup($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		groups.*
		FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN groups ON t2.groupid=groups.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.groupid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getAllMediumOnProgram($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		mediums.*
		FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN mediums ON t2.mediumid=mediums.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.mediumid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getAllShiftOnProgram($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		shifts.*
		FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.shiftid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getFAllMedium($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT mediums.* FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN mediums ON t2.mediumid=mediums.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? GROUP BY t2.mediumid";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getFAllShiftOnMedium($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT shifts.* FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? GROUP BY t2.shiftid";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getFAllShift($sessionid,$programid,$groupid,$mediumid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT shifts.* FROM `admission_programs` AS t1 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? AND t2.mediumid=?";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
		return $result;
	}
	public function getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t2.* FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		WHERE sessionid=? AND programid=? AND groupid=?  AND mediumid=? AND shiftid=?";
		$qresult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid,$shiftid]);
		$result = collect($qresult);
		if($result->isNotEmpty()){
			$programofferid=$result->first()->id;
			return $programofferid;
		}
		return 0;
	}
	public function getAdmissionProgram($programofferid){
		$sql="SELECT admission_programs.*,
		programoffers.id,
		programoffers.sessionid,
		programoffers.programid,
		programoffers.groupid,
		programoffers.mediumid,
		programoffers.shiftid
		FROM `admission_programs`
		INNER JOIN programoffers ON admission_programs.programofferid=programoffers.id
		WHERE admission_programs.programofferid=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result = collect($qresult)->first();
		return $result;
	}
	public function getExamInfo($programofferid){
		$sql="SELECT 
		t1.programofferid,
		t1.exam_marks,
		t1.exam_date,
		t1.exam_time
		FROM `admission_programs` AS t1
		INNER JOIN programoffers ON t1.programofferid=programoffers.id
		WHERE t1.programofferid=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result = collect($qresult)->first();
		return $result;
	}
}
