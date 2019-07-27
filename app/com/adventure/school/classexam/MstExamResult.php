<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\GradePoint;

class MstExamResult extends Model
{
    public function getSingleResult($programofferid,$examnameid,$studentid){
        $studentList=$this->getMstExamResult($programofferid,$examnameid);
        $student=$studentList->where("studentid",$studentid)->first();
        // dd($student);
        return $student;
    }
    public function getMstExamResult($programofferid,$examnameid){
        $students=$this->getStudents($programofferid,$examnameid);
        foreach($students as $std){
            $meargeCourseList=$this->getMerageSubject($std->programofferid,$std->examnameid,$std->studentid);
            dd($meargeCourseList);
            foreach($meargeCourseList as $mg_course){
                $courses=$this->getCoursesOnMearge($std->programofferid,$std->examnameid,$std->studentid,$mg_course->meargeid);
                foreach($courses as $course){
                    $markCategories=$this->getMarkCategory($std->programofferid,$std->examnameid,$std->studentid,$course->coursecodeid);
                    // dd($markCategories);
                }
            }
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
    public function getMerageSubject($programofferid,$examnameid,$studentid){
        $sql="select 
        table1.meargeid,
        table1.coursetypeid,
        COUNT(table1.meargeid) as meargecount,
        CASE
            WHEN COUNT(table1.meargeid)>1 THEN table1.mearge_name
            ELSE table1.courseName
        END AS courseName
        FROM(SELECT 
        mxm.studentid,
        mxm.coursecodeid,
        student_courses.coursetypeid,
        course_codes.name AS courseCode,
        courses.name AS courseName,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name
        FROM mst_exam_marks AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mxm.studentid=student_courses.studentid && mxm.coursecodeid=student_courses.coursecodeid
        INNER JOIN course_codes ON mxm.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? GROUP BY mxm.coursecodeid) AS table1
        GROUP BY table1.meargeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid]);
        $result=collect($qResult);
        return $result;
    }
    public function getCoursesOnMearge($programofferid,$examnameid,$studentid,$meargeid){
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
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? && courseoffer.meargeid=?  GROUP BY mxm.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$meargeid]);
        $result=collect($qResult);
        return $result;
    }
    public function getMarkCategory($programofferid,$examnameid,$studentid,$coursecodeid){
        $sql="SELECT
		mxm.programofferid,
        mxm.coursecodeid,
        md.mark_group_id,
        courseoffer.coursemark,
        md.mark_in_percentage,
        (courseoffer.coursemark* md.mark_in_percentage)/100 AS cal_coursemark,
        md.cat_hld_mark,
        mxm.marks AS std_input_mark,
        ((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks/md.cat_hld_mark as std_obt_mark,
        (((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100 AS pass_mark,
         CASE
         WHEN (((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks/md.cat_hld_mark)>(((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100 THEN 1
         else 0
        end as cat_pass_status
        FROM mst_exam_marks AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.coursecodeid=md.coursecodeid && mxm.markcategoryid=md.markcategoryid
        INNER JOIN mark_categories on md.markcategoryid=mark_categories.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? && mxm.coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }
    public function getGradePoint($programofferid,$marks){
        // dd($marks);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter($programofferid);
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
    public function getGradeLetter($programofferid,$point){
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter($programofferid);
        $point_letters=$point_letters->sortByDesc("gradepoint");
        $point_letter_array=array();
        foreach($point_letters as $x){
            array_push($point_letter_array,array("gradepoint"=>$x->gradepoint,"grade_letter"=>$x->name));
        }
        for ($i=0;$i<(count($point_letter_array)-1);$i++){
            if(($point<$point_letter_array[$i]["gradepoint"]) && ($point>=$point_letter_array[$i+1]["gradepoint"])){
                return $point_letter_array[$i+1];
            }
        }
        return $point_letter_array[0];
    }
}
