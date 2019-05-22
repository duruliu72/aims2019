<?php

namespace App\com\adventure\school\courseoffer;
use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;

class CourseOffer extends Model
{
    protected $table='courseoffer';
    protected $fillable = ['programofferid','coursecodeid','coursemark','meargeid','status'];
    public function isSameCourse($programofferid,$coursecodeid){
        $sql="SELECT * FROM `courseoffer` WHERE programofferid=? AND coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    public function getStudentCoursesOnProgramOffer($programofferid){
        $sql="SELECT 
        courseoffer.coursecodeid,
        CONCAT(courses.name,' (',course_codes.name,')') AS courseNameWithCode
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function getStudentCourses($applicantid,$programofferid){
        $sql="SELECT table1.*,
        table2.studentid,
        IFNULL(table2.coursecodeid,0) AS vcoursecodeid,
        IFNULL(table2.coursetypeid,0) AS coursetypeid,
        table2.courseTypeName
        FROM (SELECT 
        courseoffer.coursecodeid,
        CONCAT(courses.name,' (',course_codes.name,')') AS courseNameWithCode
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE programofferid=?) AS table1
        LEFT JOIN
        (SELECT 
        students.programofferid,
        students.sectionid,
        student_courses.studentid,
        student_courses.coursecodeid,
        student_courses.coursetypeid,
        course_type.name AS courseTypeName
        FROM `students`
        INNER JOIN applicants ON students.studentregid=applicants.studentregid
        INNER JOIN student_courses ON students.id=student_courses.studentid
         INNER JOIN course_type ON student_courses.coursetypeid=course_type.id
        WHERE applicants.applicantid=?) AS table2 ON table1.coursecodeid=table2.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid,$applicantid]);
        return collect($qResult);
    }
     // +++++++++++++++++++
     public function getCourseCodes($sessionid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT
        course_codes.id,
        CONCAT(courses.name,' (',course_codes.name,')') AS name
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        WHERE programoffers.sessionid=? GROUP BY course_codes.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    public function getCourseCodesOnProgramOffer($programofferid){
        $sql="SELECT
        course_codes.id,
        CONCAT(courses.name,' (',course_codes.name,')') AS name,
        courseoffer.coursemark,
        IFNULL(mark_distribution.coursecodeid,0) AS mcoursecodeid
        FROM courseoffer
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        LEFT JOIN mark_distribution ON courseoffer.programofferid=mark_distribution.programofferid 
        AND courseoffer.coursecodeid=mark_distribution.coursecodeid
        WHERE courseoffer.programofferid=?  GROUP BY courseoffer.coursecodeid ORDER BY  courseoffer.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function hasCourseAssign($programofferid){
        $sql="SELECT * FROM `courseoffer`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }     
}