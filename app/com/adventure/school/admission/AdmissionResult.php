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
	public function getApplicantinfo($applicantid){
		$sql="SELECT finaltable.*,
		sessions.name AS sessionName,
		programlevels.name AS levelName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM (SELECT 
		outertable.applicantid,
        IFNULL(outertable.studentregid,0) AS studentregid,
		outertable.fullName,
		outertable.picture,
		@row_number:=CASE
			WHEN @temp_no=outertable.programofferid THEN @row_number+1 ELSE 1
		END as serialno,
		@temp_no:=outertable.programofferid AS programofferid,
		outertable.result
		FROM(select 
		table1.programofferid,
		table1.applicantid,
        table1.studentregid,
		table1.fullName,
		table1.picture,
		SUM(table1.marks) AS result
		FROM(SELECT 
		applicants.programofferid,
        applicants.studentregid,
		CONCAT(applicants.name,' ') AS fullName,
		applicants.picture,
		admissionresult.applicantid,
		admissionresult.subjectid,
		(vadmission_subjects.marks*admission_programs.exam_marks)/100 AS subjectmark,
		admissionresult.marks,
		((SELECT subjectmark)*50)/100 AS passMark,
		IF(admissionresult.marks>=(select passMark),'pass','fail') AS status
		FROM `admissionresult`
		INNER JOIN applicants ON admissionresult.applicantid=applicants.applicantid
		INNER JOIN admission_programs ON applicants.programofferid=admission_programs.programofferid
		INNER JOIN vadmission_subjects ON applicants.programofferid=vadmission_subjects.programofferid AND admissionresult.subjectid=vadmission_subjects.subjectid) AS table1 GROUP BY table1.programofferid,table1.applicantid
		ORDER BY table1.programofferid DESC,result DESC) AS outertable,(SELECT @temp_no:=0,@row_number:=0) as t) AS finaltable
		INNER JOIN programoffers ON finaltable.programofferid=programoffers.id
		INNER JOIN sessions ON programoffers.sessionid=sessions.id
		INNER JOIN programs ON programoffers.programid=programs.id
		INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
		INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
		INNER JOIN groups ON programoffers.groupid=groups.id
		INNER JOIN mediums ON programoffers.mediumid=mediums.id
		INNER JOIN shifts ON programoffers.shiftid=shifts.id
		WHERE finaltable.applicantid=?";
		$qresult=\DB::select($sql,[$applicantid]);
		$result=collect($qresult)->first();
		return $result;
	}
	public function getAdmissionApplicants($programofferid){
		$sql="SELECT 
		table1.programofferid,
		table1.applicantid,
		table1.serialno,
		IFNULL(table1.studentregid,0) AS studentregid,
		table1.name,
		table1.genderid,
		table1.genderName,
		table1.religionid,
		table1.religionName,
		table1.picture,
		table1.totalmark,
		students.classroll
		FROM(select t1.* ,
				@row_number:=CASE
					WHEN @temp_no=t1.programofferid THEN @row_number+1 ELSE 1
					END as serialno,
					@temp_no:=t1.programofferid AS temp
				FROM
				(SELECT 
				applicants.programofferid,
				applicants.applicantid,
				applicants.studentregid,
				applicants.name,
				applicants.genderid,
				genders.name AS genderName,
				applicants.religionid,
				religions.name AS religionName,
				applicants.picture,
				sum(admissionresult.marks) AS totalmark
				FROM `admissionresult`
				INNER JOIN applicants ON admissionresult.applicantid=applicants.applicantid
				INNER JOIN genders ON applicants.genderid=genders.id
				INNER JOIN religions ON applicants.religionid=religions.id
				WHERE applicants.programofferid=?
				GROUP BY applicants.programofferid,applicants.applicantid
				ORDER BY applicants.programofferid,totalmark DESC) AS t1,
				(SELECT @temp_no:=0,@row_number:=0) AS t) AS table1
				LEFT JOIN students ON table1.studentregid=students.studentregid ORDER BY table1.serialno";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	
}
