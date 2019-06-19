<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class MstExamResult extends Model
{
    public function getMstExamMarks(){
        $sql="SELECT mem.*, 
        student_courses.coursetypeid,
        md.distribution_mark,
        md.passtypeid,
        courseoffer.coursemark,
        courseoffer.meargeid
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid";
    }
}
