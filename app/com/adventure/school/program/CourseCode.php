<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class CourseCode extends Model
{
    protected $table='course_codes';
   	protected $fillable = ['name','courseid','status'];
   	public function getAllCourse(){
   		$sql="SELECT course_codes.*,
		courses.name AS courseName
		FROM `course_codes`
		INNER JOIN courses ON course_codes.courseid=courses.id";
   		$result=\DB::select($sql);
		return $result;
	}
	public function getAllCourseOnProgramOffer($programofferid){
		$sql="SELECT course_codes.*,
		courses.name AS courseName,
		CONCAT(courses.name,'(',course_codes.name,')') AS courseNameWithCode,
		IFNULL(table1.programofferid,0) AS programofferid,
		IFNULL(table1.coursecodeid,0) AS coursecodeid,
		table1.coursemark
		from course_codes
		INNER JOIN courses ON course_codes.courseid=courses.id
		LEFT JOIN (SELECT course_codes.*,
		courseoffer.programofferid,
		courseoffer.coursecodeid,
		courseoffer.coursemark
		FROM `course_codes`
		INNER JOIN courseoffer ON course_codes.id=courseoffer.coursecodeid
		WHERE courseoffer.programofferid=?) AS table1 ON course_codes.id=table1.coursecodeid";
		$qResult=\DB::select($sql,[$programofferid]);
		$result=collect($qResult);
		return $result;
	}
	public function getCourse($id){
		$sql="SELECT course_codes.*,
		courses.name AS courseName
		FROM `course_codes`
		INNER JOIN courses ON course_codes.courseid=courses.id where course_codes.id=?";
   		$qResult=\DB::select($sql,[$id]);
		$course=collect($qResult)->first();
		return $course;
	}  
}
