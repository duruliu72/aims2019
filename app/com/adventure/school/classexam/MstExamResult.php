<?php

namespace App\com\adventure\school\classexam;
use App\com\adventure\school\program\GradePoint;
use Illuminate\Database\Eloquent\Model;

class MstExamResult extends Model
{
    public function getMstExamResult($programofferid,$examnameid){
         //Result 
        $resultSql="SELECT 
        mem.studentid,
        mem.coursecodeid,
        student_courses.coursetypeid,
        courseoffer.meargeid,
        sum(FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0)) AS tot_marks,
        sum(mem.marks) as obt_marks
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=1 && mem.examnameid=1 GROUP BY mem.studentid,mem.coursecodeid asc
        ORDER BY obt_marks DESC";
        $qResult=\DB::select($resultSql,[$programofferid,$examnameid]);
        $result=collect($qResult);
        // dd($result);
        foreach($result as $item){
            // if(){

            // }
            $item->pointleter=$this->getGradePoint($item->obt_marks);
        }
        return $result;       
    }
    public function getGradePoint($marks){
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter(1);
        foreach($point_letters as $item){
            if($marks>=$item->from_mark && $marks<=$item->to_mark){
                return array(
                    "gradepoint"=>$item->gradepoint,
                    "gradeletter"=>$item->name
                );
            }
        }
        return array(
            "gradepoint"=>0,
            "gradeletter"=>"F"
        );
    }
}



// ========================
// $sql="SELECT 
// mem.programofferid,
// mem.sectionid,
// mem.teacherid,
// mem.studentid,
// mem.coursecodeid,
// mem.examnameid,
// mem.examtypeid,
// mem.markcategoryid,
// student_courses.coursetypeid,
// md.passtypeid,
// courseoffer.meargeid,
// FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0) AS categorymarks,
// mem.marks as obt_marks
// FROM `mst_exam_marks` AS mem
// INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
// INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
// INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
// WHERE mem.programofferid=1 && mem.examnameid=1";
// // Grouping Mark Category
// $passTypeSql="SELECT passtypeid FROM `mark_distribution`
// WHERE programofferid=1 && coursecodeid=1 GROUP BY passtypeid";
// // CourseType such as Compulsory Optional
// $courseTypeSql="SELECT student_courses.coursetypeid,
// course_type.name
// FROM `student_courses`
// INNER join students students ON student_courses.studentid=students.id
// INNER JOIN course_type ON student_courses.coursetypeid=course_type.id
// WHERE programofferid=1 && studentid=1 GROUP BY coursetypeid";
// //Mark Category id
// $markCategorySql="SELECT * FROM `mark_distribution`
// WHERE programofferid=1 && coursecodeid=1";
// //Mearge Id 
// $meargeSql="SELECT programofferid,meargeid FROM `courseoffer`
// WHERE programofferid=1  GROUP BY meargeid"; 
