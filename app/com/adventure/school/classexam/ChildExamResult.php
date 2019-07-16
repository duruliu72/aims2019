<?php

namespace App\com\adventure\school\classexam;
use App\com\adventure\school\program\GradePoint;
use App\com\adventure\school\academic\Student;

use Illuminate\Database\Eloquent\Model;

class ChildExamResult extends Model
{
    public function getChildExamResult($programofferid,$mst_examnameid,$child_examnameid){
        $aStudent=new Student();
        $students=$aStudent->getStudentsOnProgramofferID($programofferid);
        
        return $students;
    }
    
}
