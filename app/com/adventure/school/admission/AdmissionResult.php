<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AdmissionResult extends Model
{
    protected $table="admissionresult";
	protected $fillable = ['applicantid','subjectid','marks'];
	public function getMeritList($programofferid){
		$sql="SELECT finaltable.* 
		from(SELECT 
		@row_number:=CASE
			WHEN @temp_no=table1.programofferid THEN @row_number + 1 ELSE 1
		END AS serialno,
		@temp_no:=table1.programofferid AS temp,
		table1.*
		FROM(SELECT
		applicants.*,
		sum(admissionresult.marks) AS total_obtain_mark,
		admission_programs.exam_marks
		FROM `admissionresult`
		INNER JOIN applicants ON admissionresult.applicantid=applicants.applicantid
		INNER JOIN admission_programs ON applicants.programofferid=admission_programs.programofferid
		GROUP BY admissionresult.applicantid ORDER BY applicants.programofferid,marks DESC) AS table1,
		(SELECT @temp_no:=0,@row_number:=0) as t) AS finaltable WHERE finaltable.programofferid=? AND finaltable.total_obtain_mark>=(finaltable.exam_marks*(0/100))";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	public function getMeritPosition($programofferid,$applicantid){
		$sql="SELECT finaltable.* 
		from(SELECT 
		@row_number:=CASE
			WHEN @temp_no=table1.programofferid THEN @row_number + 1 ELSE 1
		END AS serialno,
		@temp_no:=table1.programofferid AS temp,
		table1.*
		FROM(SELECT
		applicants.*,
		sum(admissionresult.marks) AS total_obtain_mark,
		admission_programs.exam_marks
		FROM `admissionresult`
		INNER JOIN applicants ON admissionresult.applicantid=applicants.applicantid
		INNER JOIN admission_programs ON applicants.programofferid=admission_programs.programofferid
		GROUP BY admissionresult.applicantid ORDER BY applicants.programofferid,marks DESC) AS table1,
		(SELECT @temp_no:=0,@row_number:=0) as t) AS finaltable WHERE finaltable.programofferid=? And finaltable.applicantid=? AND finaltable.total_obtain_mark>=(finaltable.exam_marks*(0/100))";
		$qresult=\DB::select($sql,[$programofferid,$applicantid]);
		$result=collect($qresult)->first();
		return $result;
	}
	
}
