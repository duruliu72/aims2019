<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\GradePoint;

class MstExamResult1 extends Model
{
    public function getSingleResult($programofferid,$examnameid,$studentid){
        $studentList=$this->getMstExamResult($programofferid,$examnameid);
        $increment=1;
        foreach($studentList as $item){
            $item->position=$increment;
            $increment++;
        }
        $student=$studentList->where("studentid",$studentid)->first();
        // dd($student);
        return $student;
    }
    public function getMstExamResult($programofferid,$examnameid){
        $students=$this->getStudents($programofferid,$examnameid);
        foreach($students as $x){
            $meargeCourseList=$this->getMerageSubject($x->programofferid,$x->examnameid,$x->studentid);
            foreach($meargeCourseList as $item){
                $courses=$this->getCoursesOnMearge($x->programofferid,$x->examnameid,$x->studentid,$item->meargeid);
                $check=$this->check($x->programofferid,$x->examnameid,$x->studentid,$item->meargeid);
                foreach($courses as $y){
                    $markCategories=$this->getMarkCategory($x->programofferid,$x->examnameid,$x->studentid,$y->coursecodeid);
                    $course_marks=0;
                    $obt_course_marks=0;
                    $course_pass_status=true;
                    $group_result=$markCategories->groupBy("mark_group_id")->map(function($item,$key){
                        $c["catmarks"]=$item->sum("catmarks");
                        $c["obt_marks"]=$item->sum("obt_marks");
                        return $c;
                    });
                   
                    // for markcategory pass status
                    foreach($markCategories as $mc){
                        $cat_pass_status=true;
                        $temp=($mc->catmarks*33)/100;
                        if($mc->obt_marks<$temp){
                            $cat_pass_status=false;
                        }
                        $mc->cat_pass_status=$cat_pass_status;
                    }
                     // dd($group_result);
                    foreach($group_result as $z){
                        $course_pass_status=true;
                        $temp=($z["catmarks"]*33)/100;
                        if($z["obt_marks"]<$temp){
                            $course_pass_status=false;
                        }
                        $course_marks=$course_marks+$z["catmarks"];
                        $obt_course_marks=$obt_course_marks+$z["obt_marks"];
                        // dd($z);
                    }
                    $y->obt_course_marks=$obt_course_marks;
                    $y->course_marks=$course_marks;
                    $y->course_pass_status=$course_pass_status;
                    $y->markCategories=$markCategories;
                    $point_letter=$this->getGradePoint($programofferid,$obt_course_marks);
                    if($course_pass_status==false){
                        $gradepoint=0;
                        $gradeletter="F";
                    }else{
                        $gradepoint=$point_letter["gradepoint"];
                        $gradeletter=$point_letter["gradeletter"];
                    }
                    $y->gradepoint=$gradepoint;
                    $y->gradeletter=$gradeletter;
                    // dd($y);
                }
                $mearge_marks=0;
                $obt_mearge_marks=0;
                $mearge_pass_status=true;
                foreach($check as $ck){
                    $temp=($ck->catmarks*33)/100;
                    if($ck->obt_mearge_marks<$temp){
                        $mearge_pass_status=false;
                    }
                    $mearge_marks=$mearge_marks+$ck->catmarks;
                    $obt_mearge_marks=$obt_mearge_marks+$ck->obt_mearge_marks;
                }
                $mearge_point_letter=$this->getGradePoint($programofferid,$obt_mearge_marks/$item->meargecount);
                $mearge_point=0;
                $mearge_letter="F";
                if($mearge_pass_status==false){
                    $mearge_point=0;
                    $mearge_letter="F";
                }else{
                    $mearge_point=$mearge_point_letter["gradepoint"];
                    $mearge_letter=$mearge_point_letter["gradeletter"];
                }
                $item->mearge_pass_status=$mearge_pass_status;
                $item->mearge_marks=$mearge_marks;
                $item->obt_mearge_marks=$obt_mearge_marks;
                $item->mearge_point=$mearge_point;
                $item->mearge_letter=$mearge_letter;
                $item->courses=$courses;
            }
            // dd($meargeCourseList);
            $x->meargeCourseList=$meargeCourseList;
            // For Compulsary Subject
            $compalsary_courses = $meargeCourseList->where("coursetypeid","=",1);
            // For Optional Subject
            $optional_courses = $meargeCourseList->where("coursetypeid","=",2);
            // For Additional Subject
            $additional_courses = $meargeCourseList->where("coursetypeid","=",3);
            $common_marks=0;
            $obt_common_marks=0;
            $grand_marks=0;
            $grand_obt_marks=0;
            $compalsary_subj=0;
            $common_fail_sub=0;
            $tot_fail_sub=0;
            $std_tot_gpa=0;
            $std_gpa=0.0;
            $std_letter="F";
            $status=1;
            $student_pass_status=true;
            foreach($compalsary_courses as $cc){
                $common_marks=$common_marks+$cc->mearge_marks;
                $obt_common_marks=$obt_common_marks+$cc->obt_mearge_marks;
                $grand_marks=$grand_marks+$cc->mearge_marks;
                $grand_obt_marks=$grand_obt_marks+$cc->obt_mearge_marks;
                $std_tot_gpa=$std_tot_gpa+$mearge_point;
                if($cc->mearge_pass_status==false){
                    $student_pass_status=false;
                    $status=0;
                    $common_fail_sub++;
                    $tot_fail_sub++;
                }
                $compalsary_subj++;
            }
            foreach($optional_courses as $oc){
                $grand_marks=$grand_marks+$oc->mearge_marks;
                $grand_obt_marks=$grand_obt_marks+$oc->obt_mearge_marks;
                if($oc->mearge_pass_status==false){
                    $tot_fail_sub++;
                }
            }
            foreach($additional_courses as $ac){
                $grand_marks=$grand_marks+$ac->mearge_marks;
                $grand_obt_marks=$grand_obt_marks+$ac->obt_mearge_marks;
                if($ac->mearge_pass_status==false){
                    $tot_fail_sub++;
                }
            }
            $x->common_marks=$common_marks;
            $x->obt_common_marks=$obt_common_marks;
            $x->grand_marks=$grand_marks;
            $x->grand_obt_marks=$grand_obt_marks;
            $x->compalsary_subj=$compalsary_subj;
            $x->common_fail_sub=$common_fail_sub;
            $x->tot_fail_sub=$tot_fail_sub;
            $x->std_tot_gpa=$std_tot_gpa;
            $letter_grade=$this->getGradeLetter($programofferid,$std_tot_gpa/$compalsary_subj);
            $x->std_gpa=$std_tot_gpa/$compalsary_subj;
            $x->std_letter=$letter_grade["grade_letter"];
            $x->student_pass_status=$student_pass_status;
            $x->status=$status;
            // dd($x);
        }
        $students1=$students->sortByDesc("obt_common_marks")->groupBy("status")->collapse();
        // dd($students1);
        return $students1;
        return $students;
    }
    public function check($programofferid,$examnameid,$studentid,$meargeid){
        $sql="SELECT 
        mxm.studentid,
        student_courses.coursetypeid,
        courseoffer.meargeid,
        courseoffer.mearge_name,
        md.mark_group_id,
        mark_categories.name AS markcatName,
       	SUM(FORMAT((courseoffer.coursemark*md.mark_in_percentage)/100,0)) AS catmarks,
        sum(mxm.marks) AS obt_mearge_marks
        FROM mst_exam_marks AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.coursecodeid=md.coursecodeid && mxm.markcategoryid=md.markcategoryid
        INNER JOIN student_courses ON mxm.studentid=student_courses.studentid && mxm.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_categories on md.markcategoryid=mark_categories.id
        INNER JOIN course_codes ON mxm.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? && courseoffer.meargeid=? GROUP BY  md.mark_group_id";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$meargeid]);
        $result=collect($qResult);
        return $result;
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
    public function getGradePoint($programofferid,$marks){
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
        for ($i=0;$i<(count($point_letter_array)-2);$i++){
            if(($point<$point_letter_array[$i]["gradepoint"]) && ($point>=$point_letter_array[$i+1]["gradepoint"])){
                return $point_letter_array[$i+1];
            }
        }
        return $point_letter_array[0];
    }
}
