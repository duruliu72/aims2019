<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class MstExamMarksEntry extends Model
{
    public function hasMarkEntry($programofferid,$sectionid,$examnameid,$courseid){
        $sql="SELECT * FROM `mst_exam_marks`
        WHERE programofferid=? & sectionid=? && examnameid=? && courseid=?";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$examnameid,$courseid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getCourses($programofferid,$sectionid,$mstexamnameid){
        $sql="SELECT * FROM(SELECT courses.*,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name
        FROM courses
        INNER JOIN courseoffer ON courses.id=courseoffer.courseid
        WHERE courseoffer.programofferid=?) AS t1
        WHERE t1.id NOT IN(SELECT courseid FROM `mst_exam_marks`
WHERE programofferid=? && sectionid=? && examnameid=?
GROUP BY courseid)";
    $qResult=\DB::select($sql,[$programofferid,$programofferid,$sectionid,$mstexamnameid]);
    $result=collect($qResult);
    return $result;
    }
    public function getEditCourse($programofferid,$sectionid,$mstexamnameid){
        $sql="SELECT * FROM(SELECT courses.*,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name
        FROM courses
        INNER JOIN courseoffer ON courses.id=courseoffer.courseid
        WHERE courseoffer.programofferid=?) AS t1
        WHERE t1.id IN(SELECT courseid FROM `mst_exam_marks`
WHERE programofferid=? && sectionid=? && examnameid=?
GROUP BY courseid)";
    $qResult=\DB::select($sql,[$programofferid,$programofferid,$sectionid,$mstexamnameid]);
    $result=collect($qResult);
    return $result;
    }
}
