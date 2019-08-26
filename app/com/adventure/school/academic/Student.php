<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\academic\StudentCourse;
class Student extends Model
{
    protected  $table='students';
    protected $fillable = ['r_studentid','programofferid','sectionid','applicantid','classroll','fromclass','fromsection','studenttype','currentclass','status'];
    public function getLastID(){
        $sql="SELECT * FROM `students` ORDER BY id DESC";
        $qResult=\DB::select($sql);
        $aStudent=collect($qResult)->first();
        return $aStudent->id;
    }
    public function checkStudent($programofferid,$applicantid){
        $sql="SELECT * FROM `students`
        WHERE programofferid=? && applicantid=?";
        $qResult=\DB::select($sql,[$programofferid,$applicantid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function checkStudentOnPO($programofferid){
        $sql="SELECT * FROM `students`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getStudent($applicantid){
        $sql="SELECT * FROM `students`
        WHERE applicantid=?";
        $qResult=\DB::select($sql,[$applicantid]);
        $result=collect($qResult);
        $student=$result->first();
        $aStudentCourse=new StudentCourse();
        $courses=$aStudentCourse->getStudentCourses($student->id);
        $student->courses=$courses;
        return $student;
    }
    public function getCurrentStudent($applicantid){
        $sql="SELECT * FROM `students`
        WHERE applicantid=? && currentclass=1";
        $qResult=\DB::select($sql,[$applicantid]);
        $result=collect($qResult);
        $student=$result->first();
        $aStudentCourse=new StudentCourse();
        $courses=$aStudentCourse->getStudentCourses($student->id);
        $student->courses=$courses;
        return $student;
    }
    // Base on Program offer and section
    public function getStudentsOnClsNSec($programofferid,$sectionid){
        $sql="SELECT t2.* ,
		t1.firstName,
        t1.middleName,
        t1.lastName,
		genders.name AS genderName,
		blood_groups.name AS bloodgroupName,
		religions.name AS religionName,
		nationalities.name AS nationalityName,
		quotas.name AS quotaName                              
		FROM applicants AS t1
		LEFT JOIN genders ON t1.genderid=genders.id
		LEFT JOIN blood_groups ON t1.bloodgroupid=blood_groups.id
		LEFT JOIN religions ON t1.religionid=religions.id
		LEFT JOIN nationalities ON t1.`nationalityid`=nationalities.id
		LEFT JOIN quotas ON t1.`quotaid`=quotas.id
        INNER JOIN (SELECT * FROM `students`
        WHERE programofferid=? && sectionid=?) AS t2 ON t1.applicantid=t2.applicantid";
        $qResult=\DB::select($sql,[$programofferid,$sectionid]);
        $students=collect($qResult);
        return $students;
    }
    public function getStudents($programofferid){
        $sql="SELECT * FROM `students`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $students=collect($qResult);
        return $students;
    }
    // =========================
    public function getStudentsOnProgramofferID($programofferid){
        $sql="SELECT 
        students.*,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        students.classroll,
        applicants.dob,
        applicants.fatherName,
        applicants.father_Phone,
        applicants.motherName,
        applicants.mother_Phone,
        applicants.picture,
        applicants.signature,
        applicants.genderid,
        genders.name AS genderName,
        blood_groups.name AS bloodgroupName,
        religions.name AS religionName,
        nationalities.name AS nationalityName,
        quotas.name AS quotaName  
        FROM `students`
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        LEFT JOIN genders ON applicants.genderid=genders.id
        LEFT JOIN blood_groups ON applicants.bloodgroupid=blood_groups.id
        LEFT JOIN religions ON applicants.religionid=religions.id
        LEFT JOIN nationalities ON applicants.`nationalityid`=nationalities.id
        LEFT JOIN quotas ON applicants.`quotaid`=quotas.id
        WHERE students.programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $students=collect($qResult);
        return $students;
    }
   
    public function makeStudentid($programofferid){
        $sql="SELECT 
		concat(substr(sessions.name,3),programs.programsign,'0000') AS startpoint
		FROM `programoffers`
		INNER JOIN sessions ON programoffers.sessionid=sessions.id
		 INNER JOIN programs ON programoffers.programid=programs.id
		WHERE programoffers.id=?";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult);
        $r_studentid=$result->first()->startpoint;
        $substr=substr($r_studentid, 0,4);
        $r_studentid++;
        $sql="SELECT * FROM `students` WHERE students.r_studentid LIKE concat($substr,'%%%%') ORDER BY id DESC";
		$qresult=\DB::select($sql);
		$result=collect($qresult);
		if($result->count()>0){
			$r_studentid=$result->first()->r_studentid;
            $r_studentid++;
			return $r_studentid;
        }
		return $r_studentid;
    }
    // =================================
}