<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class Admission extends Model
{
    public function getAllProgram($sessionid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t1.programofferid,programs.* 
		FROM `admission_programs` AS t1
        INNER JOIN (SELECT admission_programid FROM `admission_program_subjects` GROUP BY admission_programid) AS t3 ON t1.programofferid=t3.programofferid
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
		$sql="SELECT t1.programofferid,mediums.* 
		FROM `admission_programs` AS t1
        INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
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
		$sql="SELECT t1.programofferid,shifts.* 
		FROM `admission_programs` AS t1
        INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER join sessions on t2.sessionid=sessions.id
		INNER join shifts on t2.shiftid=shifts.id
		WHERE t2.sessionid=1 group by t2.shiftid ORDER BY shifts.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getGroup($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		t1.programofferid,groups.*
		FROM `admission_programs` AS t1
        INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN groups ON t2.groupid=groups.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.groupid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getMedium($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		t1.programofferid,mediums.*
		FROM `admission_programs` AS t1
		INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN mediums ON t2.mediumid=mediums.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.mediumid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getShift($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT 
		t1.programofferid,shifts.*
		FROM `admission_programs` AS t1
		INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid 
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id 
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? GROUP BY t2.shiftid";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getMediumWithProgram($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t1.programofferid,mediums.* FROM `admission_programs` AS t1
		INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN mediums ON t2.mediumid=mediums.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? GROUP BY t2.mediumid";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getShiftWithProgram($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t1.programofferid,shifts.* FROM `admission_programs` AS t1
		INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? GROUP BY t2.shiftid";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getShiftWithProgramAndGroup($sessionid,$programid,$groupid,$mediumid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t1.programofferid,shifts.* FROM `admission_programs` AS t1
		INNER JOIN (SELECT programofferid FROM `admission_program_subjects` GROUP BY programofferid) AS t3 ON t1.programofferid=t3.programofferid
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id 
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN shifts ON t2.shiftid=shifts.id 
		WHERE t2.sessionid=? AND t2.programid=? AND t2.groupid=? AND t2.mediumid=?";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
		return $result;
	}
}
