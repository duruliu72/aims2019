<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\ProgramOffer;
class AdmissionProgramSubject extends Model
{
	protected $table='admission_program_subjects';
	
	protected $fillable = ['programofferid','subjectid','marks','status'];

	public function getAdmissionProgramSubjects($programofferid){
		$sql="SELECT 
		admission_subjects.*,
		t1.programofferid,
		IFNULL(t1.subjectid,0) AS subjectid,
		t1.marks
		FROM admission_subjects
		LEFT JOIN
		(SELECT * FROM `admission_program_subjects`
		WHERE programofferid=?) AS t1 ON t1.subjectid=admission_subjects.id";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	// only assign subject retrive
	public function getAdmissionSubject($programofferid){
		$sql="SELECT 
		admission_subjects.*,
		t1.programofferid,
		IFNULL(t1.subjectid,0) AS subjectid,
		t1.marks
		FROM admission_subjects
		INNER JOIN
		(SELECT * FROM `admission_program_subjects`
		WHERE programofferid=?) AS t1 ON t1.subjectid=admission_subjects.id";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	private function getAllAdmissionProgram(){
		$sql="SELECT
		programofferid
		FROM `admission_program_subjects`
		GROUP BY programofferid ORDER BY programofferid DESC";
		$qresult=\DB::select($sql);
		$result=collect($qresult);
		return $result;
	}
	public function admissionSubjectDisplay(){
		$programofferidList=$this->getAllAdmissionProgram();
		$aProgramOffer=new ProgramOffer();
		$list=array();
		foreach($programofferidList as $x){
			$programoffer=$aProgramOffer->getProgramOffer($x->programofferid);
			array_push($list,array(
				"programoffer" => $programoffer,
			));
		}
		return $list;
	}
	public function admissionSubjectEdit($programofferid){
		$aProgramOffer=new ProgramOffer();
		$programoffer=$aProgramOffer->getProgramOffer($programofferid);
		$subjectList=$this->getAdmissionProgramSubjects($programofferid);
		$data=array();
		array_push($data,array(
			"programoffer" => $programoffer,
			"subjects" =>$subjectList,
		));
		return $data;
	}
   	public function checkAssignAdmissionSubject($programofferid){
   		return \DB::table('admission_program_subjects')->where('programofferid', $programofferid)->exists();
	}	 
}
	
   