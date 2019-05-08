<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionProgramSubject extends Model
{
    protected $table='admission_program_subjects';
	protected $fillable = ['admission_programid','subjectid','marks','status'];
	public function getAllAdmission(){
		$admisson_programList=$this->getAllAdmissionProgram();
		$list=array();
		foreach($admisson_programList as $x){
			$subjectList=$this->getProgramSubjects($x->id);
			array_push($list,array(
				"ad_program" => $x,
    			"subjects" =>$subjectList,
			));
		}
		return $list;
	}
	public function getProgramSubjects($admission_programid){
		$sql="SELECT 
		adpsub.admission_programid,
		adpsub.subjectid,
		admission_subjects.name AS subjectName,
		adpsub.marks
		FROM `admission_program_subjects` AS adpsub
		INNER JOIN admission_subjects ON adpsub.subjectid=admission_subjects.id
		WHERE adpsub.admission_programid=?";
		$qresult=\DB::select($sql,[$admission_programid]);
		$result=collect($qresult);
		return $result;
	}
   	public function getAllAdmissionProgram($admission_programid=0){
   		$sql="SELECT 
		   admission_programs.* ,
		   po.sessionid,
		   po.programid,
		   po.groupid,
		   po.mediumid,
		   po.shiftid,
		   sessions.name AS sessionName,
		   programs.name AS programName,
		   groups.name AS groupName,
		   mediums.name AS mediumName,
		   shifts.name AS shiftName
		   FROM admission_programs
		   INNER JOIN programoffers AS po ON admission_programs.programofferid=po.id
		   INNER JOIN sessions ON po.sessionid=sessions.id
		   INNER JOIN programs ON po.programid=programs.id
		   INNER JOIN groups ON po.groupid=groups.id
		   INNER JOIN mediums ON po.mediumid=mediums.id
		   INNER JOIN shifts ON po.shiftid=shifts.id
		   INNER JOIN(SELECT admission_programid FROM `admission_program_subjects`
		   GROUP BY admission_programid) AS t1 ON t1.admission_programid=admission_programs.id";
		$conditionList=array();
		if($admission_programid!=0){
			$sql.=" WHERE admission_programs.id=?";
			array_push($conditionList,$admission_programid);
		}
		$qresult=\DB::select($sql,$conditionList);
		$result=collect($qresult);
		if($admission_programid!=0){
			return collect($qresult)->first();
		}
		return $result;
	}
	public function getId(){
		$lastOne=\DB::table('admission_program_subjects')->orderBy('id', 'desc')->first();
		if($lastOne!=null){
			return ++$lastOne->id;
		}
		return 1;
   }
   	public function CheckAssignAdmissionSubject($admission_programid){
   		return \DB::table('admission_program_subjects')->where('admission_programid', $admission_programid)->exists();
   	}
   	// ==============For Admit Card=================
   	public function getAdmitCardSubject($programofferid){
   		$sql="SELECT t2.*,
		(t1.marks*(SELECT admission_programs.exam_marks
		FROM `admission_programs`
		WHERE programofferid=?)/100) AS marks
		FROM `admission_program_subjects` AS t1
		INNER JOIN  admission_subjects AS t2 ON t1.subjectid=t2.id
		WHERE t1.programofferid=?";
   		$qresult=\DB::select($sql,[$programofferid,$programofferid]);
		$result=collect($qresult);
		return $result;
   	}
   // Admission Marks Entry
   	public function getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid){
   		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT t1.* FROM `admission_program_subjects` AS t1
		INNER JOIN admission_programs AS t2 ON t1.programofferid=t2.programofferid
		INNER JOIN programoffers AS t3 ON t2.programofferid=t3.id
		WHERE t3.sessionid=? AND t3.programid=? AND t3.groupid=?  AND t3.mediumid=? AND t3.shiftid=? GROUP BY t1.programofferid";
		$qresult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid,$shiftid]);
		$result = collect($qresult);
		if($result->isNotEmpty()){
			$programofferid=$result->first()->programofferid;
			return $programofferid;
		}
		return 0;
   	}
   	public function getAdmissioninfo($programofferid){
   		$sql="SELECT t2.*,admission_programs.exam_marks,
		sessions.name AS sessionName,
        programlevels.name AS levelName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM `admission_program_subjects` AS t1
		INNER JOIN admission_subjects ON t1.subjectid=admission_subjects.id
		INNER JOIN admission_programs ON t1.programofferid=admission_programs.programofferid
		INNER JOIN programoffers AS t2 ON admission_programs.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
        INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
        INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id WHERE t1.programofferid=? GROUP BY t1.programofferid";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult)->first();
		return $result;
   	}
}
