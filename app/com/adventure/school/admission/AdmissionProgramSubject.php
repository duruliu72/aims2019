<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionProgramSubject extends Model
{
    protected $table='admission_program_subjects';
   	protected $fillable = ['admission_programid','subjectid','marks','status'];
   	public function getId(){
   		 $lastOne=\DB::table('admission_program_subjects')->orderBy('id', 'desc')->first();
   		 if($lastOne!=null){
   		 	return ++$lastOne->id;
   		 }
   		 return 1;
   	}
   	public function getAllAdmissionProgram(){
   		$sql="SELECT t2.*,
		sessions.name AS sessionName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM `admission_program_subjects` AS t1
		INNER JOIN admission_subjects ON t1.subjectid=admission_subjects.id
		INNER JOIN admission_programs ON t1.admission_programid=admission_programs.id
		INNER JOIN programoffers AS t2 ON admission_programs.programofferid=t2.id
		INNER JOIN sessions ON t2.sessionid=sessions.id
		INNER JOIN programs ON t2.programid=programs.id
		INNER JOIN groups ON t2.groupid=groups.id
		INNER JOIN mediums ON t2.mediumid=mediums.id
		INNER JOIN shifts ON t2.shiftid=shifts.id GROUP BY t2.id";
   		$qresult=\DB::select($sql);
		$result=collect($qresult);
		return $result;
   	}
   	public function getAdmissionSubject($programofferid){
   		$sql="SELECT t1.*,
		t2.programofferid,
		t2.marks
		FROM admission_program_subjects AS t1
		LEFT JOIN (SELECT * FROM `admission_program_subjects`
		WHERE programofferid=?) AS t2 ON t1.id=t2.subjectid";
   		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
   	}
   	public function CheckAdmissionSubject($programofferid){
   		return \DB::table('admission_program_subjects')->where('programofferid', $programofferid)->exists();
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
