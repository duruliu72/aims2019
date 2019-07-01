<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class MstExamResult1 extends Model
{
    public function getMstExamResult($programofferid,$examnameid){
        $students=$this->getStudents($programofferid,$examnameid);
        foreach($students as $x){
            $tot_pass_status=true;
            $courses=$this->getCourses($x->programofferid,$x->examnameid,$x->studentid);
            foreach($courses as $y){
                $markCategories=$this->getMarkCategory($x->programofferid,$x->examnameid,$x->studentid,$y->coursecodeid);
                $tot_mark=0;
                $tot_course_marks=0;
                $course_pass_status=true;
                foreach($markCategories as $z){
                    $cat_pass_status=true;
                    $tot_mark=$tot_mark+$z->obt_marks;
                    $tot_course_marks=$tot_course_marks+$z->catmarks;
                    $temp=($z->catmarks*33)/100;
                    if($z->obt_marks<$temp){
                        $cat_pass_status=false;
                        $course_pass_status=false;
                    }
                    $z->cat_pass_status=$cat_pass_status;
                }
                $y->tot_mark=$tot_mark;
                $y->tot_course_marks=$tot_course_marks;
                $y->course_pass_status=$course_pass_status;
                $y->markCategories=$markCategories;
                if($course_pass_status==false){
                    $tot_pass_status=false;
                }
            }
            $x->class_position=0;
            $x->section_position=0;
            $x->tot_pass_status=$tot_pass_status;
            $x->courses=$courses;
        }
        return $students;
    }
    public function getStudents($programofferid,$examnameid){
        $sql="SELECT 
        mxm.programofferid,
        mxm.sectionid,
        mxm.examnameid,
        mxm.studentid,
        applicants.applicantid,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        students.classroll,
        applicants.picture,
        applicants.signature
        FROM mst_exam_marks AS mxm
        INNER JOIN students ON mxm.studentid=students.id
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        WHERE mxm.programofferid=? && mxm.examnameid=?
        GROUP BY mxm.studentid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid]);
        $result=collect($qResult);
        return $result;
    }
    public function getCourses($programofferid,$examnameid,$studentid){
        $sql="SELECT 
        mxm.studentid,
        mxm.coursecodeid,
        student_courses.coursetypeid,
        course_codes.name AS courseCode,
        courses.name AS courseName,
        courseoffer.coursemark,
        courseoffer.meargeid
        FROM mst_exam_marks AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mxm.studentid=student_courses.studentid && mxm.coursecodeid=student_courses.coursecodeid
        INNER JOIN course_codes ON mxm.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? GROUP BY mxm.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid]);
        $result=collect($qResult);
        return $result;
    }
    public function getMarkCategory($programofferid,$examnameid,$studentid,$coursecodeid){
        $sql="SELECT
        mxm.coursecodeid,
        mxm.markcategoryid,
        md.mark_group_id,
        mark_categories.name AS markcatName,
        md.mark_in_percentage,
        FORMAT((courseoffer.coursemark*md.mark_in_percentage)/100,0) AS catmarks,
        mxm.marks AS obt_marks
        FROM mst_exam_marks AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.coursecodeid=md.coursecodeid && mxm.markcategoryid=md.markcategoryid
        INNER JOIN mark_categories on md.markcategoryid=mark_categories.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? && mxm.coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }
}
