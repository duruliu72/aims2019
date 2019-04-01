<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;

class SectionTeacher extends Model
{
    protected $table='section_teachers';
    protected $fillable = ['programofferid','sectionid','coursecodeid','employeeid','status'];
    public function isSameEmployee($programofferid,$sectionid,$coursecodeid,$employeeid){
        $sql="SELECT * FROM `section_teachers` WHERE programofferid=? AND sectionid=? AND coursecodeid=? AND employeeid=?";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$coursecodeid,$employeeid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    public function getSectionTeacher($programofferid){
        $sql="SELECT section_teachers.*,
        CONCAT(employees.first_name,' ',employees.middle_name,' ',employees.last_name) AS employeeName
        FROM `section_teachers`
        left JOIN employees ON section_teachers.employeeid=employees.id
        WHERE section_teachers.programofferid=? ORDER BY section_teachers.sectionid,section_teachers.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
		return $result;
    }
    
}
