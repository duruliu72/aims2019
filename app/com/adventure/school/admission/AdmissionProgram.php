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
	
	public function getAdmissionProgram($admission_programid){
		$resurt=$this->getAdmissionPrograms($admission_programid);
		$item=$resurt->first();
		return $item;
	}
	public function getAdmissionPrograms($admission_programid=0){
		$sql="SELECT t1.* ,
		t2.sessionid,
		sessions.name AS sessionName,
        programlevels.id AS levelid,
        programlevels.name AS levelName,
        t2.programid,
		programs.name AS programName,
        t2.groupid,
		groups.name AS groupName,
        t2.mediumid,
		mediums.name AS mediumName,
        t2.shiftid,
		shifts.name AS shiftName
		FROM `admission_programs` AS t1
		INNER JOIN programoffers AS t2 ON t1.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
        INNER JOIN level_programs on programs.id=level_programs.programid
		INNER JOIN programlevels on level_programs.programlevelid=programlevels.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id";
		$data=array();
		if($admission_programid!=0){
			$sql.=" WHERE t1.id=?";
			array_push($data,$admission_programid);
		}else{
			$sql.=" ORDER BY sessionName DESC";
		}
		$qResult=\DB::select($sql,$data);
		$result=collect($qResult);
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
	public function getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid){
		$aProgramOffer=new ProgramOffer();
		$programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
		$sql="SELECT * FROM admission_programs
		WHERE programofferid=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result = collect($qresult);
		if($result->isNotEmpty()){
			$admission_programid=$result->first()->id;
			return $admission_programid;
		}
		return 0;
	}
	public function getAdmissionProgram_id($programofferid){
		$sql="SELECT * FROM `admission_programs`
		WHERE programofferid=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result = collect($qresult)->first();
		if($result==null){
			return 0;
		}
		$admission_programid=$result->id;
		return $admission_programid;
	}
	public function getProgramofferid($admission_programid){
		$sql="SELECT * FROM `admission_programs`
		WHERE id=?";
		$qresult=\DB::select($sql,[$admission_programid]);
		$result = collect($qresult)->first();
		if($result==null){
			return 0;
		}
		$programofferid=$result->programofferid;
		return $programofferid;
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
	/////////////////sd

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
}
