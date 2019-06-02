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
}