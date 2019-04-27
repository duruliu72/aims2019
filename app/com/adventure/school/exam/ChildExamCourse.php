<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class ChildExamCourse extends Model
{
    protected $table="child_exam_course";
    protected $fillable = ['child_exam_id','courseofferid','marks','status'];
    public function getAllCourses($programofferid){
        $sql="SELECT 
        courseoffer.*,
        courses.name AS courseName,
        course_codes.name AS courseCode
        FROM `courseoffer` 
        INNER JOIN course_codes ON coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE programofferid=?";
       $qresult=\DB::select($sql,[$programofferid]);
       $result=collect($qresult);
       return $result;
    }
    public function getAllCoursesOnChildExam($child_exam_id){
        $sql="SELECT
        courseoffer.*,
        courses.name AS courseName,
        course_codes.name AS courseCode,
        tcxc.marks
        FROM courseoffer
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        INNER JOIN (SELECT child_exam_course.*,
        child_exam.master_exam_id,
        master_exam.programofferid
        FROM `child_exam_course`
        INNER JOIN child_exam ON child_exam_course.child_exam_id=child_exam.id
        INNER JOIN master_exam ON child_exam.master_exam_id=master_exam.id
        WHERE child_exam_id=?) AS tcxc ON courseoffer.programofferid=tcxc.programofferid && courseoffer.id=tcxc.courseofferid";
       $qresult=\DB::select($sql,[$child_exam_id]);
       $result=collect($qresult);
       return $result;
    }
}