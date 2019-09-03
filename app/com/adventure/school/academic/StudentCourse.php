<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected  $table='student_courses';
    protected $fillable = ['studentid','courseid','coursetypeid','status'];
    public function getStudentCourses($studentid,$programofferid=0){
        $sql="SELECT
        students.id,
        students.programofferid,
        students.sectionid,
        student_courses.studentid,
        student_courses.courseid,
        courses.courseName,
        courses.courseCode,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid
        INNER JOIN courses ON student_courses.courseid=courses.id
        WHERE studentid=?";
        $data=array();
		array_push($data,$studentid);
        if($programofferid!=0){
			$sql.=" && t1.programofferid=?";
			array_push($data,$programofferid);
		}
        $qResult=\DB::select($sql,$data);
        $result=collect($qResult);
        return $result;
    }
    public function getStudentCourcesForEdit($programofferid,$sectionid,$studentid){
        $sql="SELECT offercourses.*,
        std_courses.studentid,
        std_courses.courseid AS c_courseid,
        std_courses.coursetypeid
        FROM(SELECT 
        courseoffer.*,
        courses.courseName,
        courses.courseCode,
        sct.sectionid,
        sct.teacherid,
        employees.first_name,
        employees.middle_name,
        employees.last_name
        FROM `courseoffer`
        INNER JOIN courses ON courseoffer.courseid=courses.id
        INNER JOIN section_course_teachers AS sct ON  courseoffer.programofferid=sct.programofferid && courseoffer.courseid=sct.courseid
        INNER JOIN employees ON sct.teacherid=employees.id
        WHERE courseoffer.programofferid=? && sct.sectionid=?) AS offercourses
        LEFT JOIN (SELECT
        students.id,
        students.programofferid,
        students.sectionid,
        student_courses.studentid,
        student_courses.courseid,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid
        WHERE programofferid=? && students.id=?) AS std_courses
        ON offercourses.programofferid=std_courses.programofferid && offercourses.courseid=std_courses.courseid";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$programofferid,$studentid]);
        $result=collect($qResult);
        return $result;
    }
    public function checkValue($studentid,$courseid){
        $sql="SELECT * FROM `student_courses`
        WHERE studentid=? && courseid=?";
        $result=\DB::select($sql,[$studentid,$courseid]);
        if(count($result)!=0){
            return true;
        }
        return false;
    }
}
