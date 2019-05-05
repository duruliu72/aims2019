<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\ProgramOffer;
class AdmissionProgram extends Model
{
    protected $table="admission_programs";
    // protected $primaryKey = 'programofferid';
	protected $fillable = ['programofferid','required_gpa','exam_marks','exam_date','exam_time','status'];
	
	//===========================For Dorpdown ==============
	public function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
		if($sessionid==0){
			$yearName = date('Y');
			$aSession=new Session();
			$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t2.* FROM `programoffers` AS t1
		INNER JOIN ".$tableName." as t2 ON  t1.".$compareid."=t2.id
		INNER JOIN admission_programs on t1.id=admission_programs.programofferid
		WHERE sessionid=?";
		$data=array();
		array_push($data,$sessionid);
		if($programid!=0){
			array_push($data,$programid);
			$sql.=" AND programid=?";
		}
		if($groupid!=0){
			array_push($data,$groupid);
			$sql.=" AND groupid=?";
		}
		if($mediumid!=0){
			array_push($data,$mediumid);
			$sql.=" AND mediumid=?";
		}
		if($shiftid!=0){
			array_push($data,$shiftid);
			$sql.=" AND shiftid=?";
		}
		$sql.=" GROUP BY t2.id";
		$qResult=\DB::select($sql,$data);
		$result=collect($qResult);
		return $result;
	}	
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
	
	public function getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid){
		$aProgramOffer=new ProgramOffer();
		$programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
		$sql="SELECT * FROM `admission_programs`
		WHERE programofferid=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result = collect($qresult);
		if($result->isNotEmpty()){
			$admission_programid=$result->first()->id;
			return $admission_programid;
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
