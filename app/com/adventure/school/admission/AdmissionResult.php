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
		$sql="SELECT meritap.*,
		students.classroll,
		religions.name AS religionName
		from (select 
		totalap.*,
		@row_number:=CASE
		WHEN @temp_no=totalap.programofferid THEN @row_number+1 ELSE 1
		END as serialno,
		@temp_no:=totalap.programofferid AS temp
		FROM(SELECT 
		ap.programofferid,
		ap.applicantid,
		IFNULL(ap.studentregid,0) AS studentregid,
		ap.name,
		ap.religionid,
		ap.picture,
		SUM(admissionresult.marks) AS totalmark
		FROM(SELECT * FROM `applicants`
		WHERE programofferid=?) AS ap
		LEFT JOIN admissionresult ON ap.applicantid=admissionresult.applicantid
		WHERE ap.admssion_roll IS NOT NULL GROUP BY ap.applicantid ORDER BY totalmark DESC) AS totalap,
		(SELECT @temp_no:=0,@row_number:=0) AS t) AS meritap
		LEFT JOIN students ON meritap.programofferid=students.programofferid AND meritap.studentregid=students.studentregid
		INNER JOIN religions ON meritap.religionid=religions.id
		WHERE meritap.applicantid=?
		ORDER BY meritap.applicantid";
		$qresult=\DB::select($sql,[$programofferid,$applicantid]);
		$result=collect($qresult)->first();
		return $result;
	}
	public function getAdmissionApplicantsCommon($programofferid){
		$sql="SELECT meritap.*,
		students.classroll,
		religions.name AS religionName
		from (select 
		totalap.*,
		@row_number:=CASE
		WHEN @temp_no=totalap.programofferid THEN @row_number+1 ELSE 1
		END as serialno,
		@temp_no:=totalap.programofferid AS temp
		FROM(SELECT 
		ap.programofferid,
		ap.applicantid,
		IFNULL(ap.studentregid,0) AS studentregid,
		ap.name,
		ap.religionid,
		ap.picture,
		SUM(admissionresult.marks) AS totalmark
		FROM(SELECT * FROM `applicants`
		WHERE programofferid=?) AS ap
		LEFT JOIN admissionresult ON ap.applicantid=admissionresult.applicantid
		WHERE ap.admssion_roll IS NOT NULL GROUP BY ap.applicantid ORDER BY totalmark DESC) AS totalap,
		(SELECT @temp_no:=0,@row_number:=0) AS t) AS meritap
		LEFT JOIN students ON meritap.programofferid=students.programofferid AND meritap.studentregid=students.studentregid
		INNER JOIN religions ON meritap.religionid=religions.id
		ORDER BY meritap.applicantid";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
		return $result;
	}
	
}
