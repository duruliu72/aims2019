<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\academic\StudentCourse;
class Student extends Model
{
    protected  $table='students';
    protected $fillable = ['programofferid','sectionid','applicantid','classroll','fromclass','fromsection','studenttype','currentclass','status'];
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
}