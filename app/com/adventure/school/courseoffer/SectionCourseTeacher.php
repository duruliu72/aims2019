<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;

class SectionCourseTeacher extends Model
{
    protected $table='section_course_teachers';
    protected $fillable = ['programofferid','sectionid','courseid','teacherid','status'];
    public function getSectionCourseTeacher($programofferid){
        $sql="SELECT * FROM `section_course_teachers`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        $scTeacherList=array();
        foreach ($result as $key => $item) {
            $scTeacherList[$item->courseid][$item->sectionid]=$item->teacherid;
        }
        return $scTeacherList;
    }
}
