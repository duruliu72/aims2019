<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected  $table='student_courses';
    protected $fillable = ['studentid','courseid','coursetypeid','status'];
    public function getStudentCourses($studentid){
        $sql="SELECT * FROM `student_courses`
        WHERE studentid=?";
        $qResult=\DB::select($sql,[$studentid]);
        $result=collect($qResult);
        return $result;
    }
}
