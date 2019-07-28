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
            $common_marks=0;
            $obt_common_marks=0;
            $add_forth_sub_marks=0;
            $tot_marks=0;
            $tot_obt_marks=0;
            $common_fail_sub=0;
            $tot_fail_sub=0;
            $common_pass_sub=0;
            $student_pass_status=true;
            $std_tot_gpa=0;
            $gpa=0.0;
            $letter="F";
            $meargeCourses=$this->getMearge_Courses($std->programofferid,$std->examnameid,$std->studentid);
            // dd($meargeCourses);
            foreach($meargeCourses as $mc){
                // dd($meargeCourses[1]);
                $courses=$this->getCourses($std->programofferid,$std->examnameid,$std->studentid,$mc->meargeid);
                //  dd($courses);
              
                foreach($courses as $course){
                    $group_marks_cats=$this->getGroupMarkCategories($std->programofferid,$std->examnameid,$std->studentid,$course->coursecodeid);
                    //  dd($group_marks_cats);
                     foreach($group_marks_cats as $g_cat){
                        if($g_cat->group_cat_pass_status==0){
                            $mc->mearge_course_pass_satatus=0;
                            if($course->coursetypeid==1){
                                $student_pass_status=false;
                            }
                        }
                     }
                    $marks_cats=$this->getMarkCategories($std->programofferid,$std->examnameid,$std->studentid,$course->coursecodeid);
                    // dd($marks_cats);
                    // dd($course);
                    if($course->coursetypeid==1 && $course->meargeid==$mc->meargeid){
                        $common_marks=$common_marks+$course->coursemark;
                        $tot_marks=$tot_marks+$course->coursemark;
                        if($mc->mearge_course_pass_satatus==1){
                            $obt_common_marks=$obt_common_marks+$course->std_obt_mark;
                            $tot_obt_marks=$tot_obt_marks+$course->std_obt_mark;
                        }else{
                            $common_fail_sub++;
                            $tot_fail_sub++;
                        }
                    }elseif($course->coursetypeid==2 && $course->meargeid==$mc->meargeid){
                        $tot_marks=$tot_marks+$course->coursemark;
                        if($mc->mearge_course_pass_satatus==1){
                            $tot_obt_marks=$tot_obt_marks+$course->std_obt_mark;
                        }else{
                            $tot_fail_sub++;
                        }
                        if($mc->mearge_course_pass_satatus==1&&$course->mark_above_40_percent>0){
                            $obt_common_marks=$obt_common_marks+$course->mark_above_40_percent;
                            $add_forth_sub_marks=$course->mark_above_40_percent;
                        }
                    }elseif($course->coursetypeid==3 && $course->meargeid==$mc->meargeid){
                        if($mc->mearge_course_pass_satatus==1){
                            $tot_obt_marks=$tot_obt_marks+$course->std_obt_mark;
                        }else{
                            $tot_fail_sub++;
                        }
                    }
                    $course->marks_cats=$marks_cats;
                }
                $mc->courses=$courses;
            }
            // dd($meargeCourses);
            $merage_pass_sub=0;
            $tot_common_mearge_point=0;
            foreach($meargeCourses as $mc){
                $marks=0;
                if($mc->mearge_course_pass_satatus==1){
                    $marks=$mc->mearge_std_obt_mark;
                }
                $point_letters=$this->getGradePoint($std->programofferid,$marks,$mc->mearge_cal_coursemark);
                // dd($point_letters);
                $mc->gradepoint=$point_letters["gradepoint"];
                $mc->gradeletter=$point_letters["gradeletter"];
                if($mc->coursetypeid==1){
                    $merage_pass_sub++;
                    $tot_common_mearge_point=$tot_common_mearge_point+$point_letters["gradepoint"];
                }                
            }
            // dd($meargeCourses);
            $gl=$this->getGradeLetter($std->programofferid,$obt_common_marks,$common_marks);
            if($student_pass_status){
                $gpa=$gl->gradepoint;
                $letter=$gl->name;
            }
            $std->mearge_course=$meargeCourses;
            $std->common_marks=$common_marks;
            $std->obt_common_marks=$obt_common_marks;
            $std->add_forth_sub_marks=$add_forth_sub_marks;
            $std->tot_marks=$tot_marks;
            $std->tot_obt_marks=$tot_obt_marks;
            $std->common_fail_sub=$common_fail_sub;
            $std->tot_fail_sub=$tot_fail_sub;
            $std->common_pass_sub=$common_pass_sub;
            $std->student_pass_status=$student_pass_status;
            $std->tot_common_mearge_point=$tot_common_mearge_point;
            $std->merage_pass_sub=$merage_pass_sub;
            $std->gpa=$gpa;
            $std->letter=$letter;
            // dd($std);
        }
        $students=$students->sortByDesc("obt_common_marks")->sortByDesc("gpa")->sortBy("tot_fail_sub")->sortByDesc("status");
        // This loop for Class Position
        $position=1;
        foreach ($students as $std){
            $std->class_position=$position++;
        }
        $student_on_section=$students->groupBy("sectionid");
        foreach ($student_on_section as $section_item) {
           $i=1;
           foreach($section_item as $std){
                $std->section_position=$i++;
           }
        }
        $students=$student_on_section->collapse();
        dd($students);
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
    public function getMearge_Courses($programofferid,$examnameid,$studentid){
        $sql="SELECT 
        programofferid,
        sectionid,
        studentid,
        meargeid,
        COUNT(meargeid) AS course_frequency,
        SUM(coursemark)/COUNT(meargeid) AS mearge_coursemark,
        SUM(mark_in_percentage)/COUNT(meargeid) AS mearge_mark_in_percentage,
        SUM(cal_coursemark)/COUNT(meargeid) AS mearge_cal_coursemark,
        SUM(course_hld_mark)/COUNT(meargeid) AS mearge_course_hld_mark,
        SUM(tot_input_mark)/COUNT(meargeid) AS mearge_tot_input_mark,
        SUM(std_obt_mark)/COUNT(meargeid) AS mearge_std_obt_mark,
        SUM(passmark)/COUNT(meargeid) AS mearge_passmark,
        SUM(mark_above_40_percent)/COUNT(meargeid) AS mark_above_40_percent,
        CASE
         WHEN (SUM(std_obt_mark)/COUNT(meargeid)) > (SUM(passmark)/COUNT(meargeid)) THEN 1
         ELSE 0
        END mearge_course_pass_satatus,
        CASE
          WHEN COUNT(meargeid)>1 THEN mearge_name
          ELSE courseName
        END AS mearge_courseName,
        coursetypeid
        FROM(SELECT table1.programofferid,
        table1.sectionid,
        table1.studentid,
        table1.coursecodeid,
        table1.meargeid,
        table1.coursemark AS coursemark,
        table2.mark_in_percentage AS mark_in_percentage,
        (table1.coursemark*table2.mark_in_percentage)/100 AS cal_coursemark,
        table2.cat_hld_mark AS course_hld_mark,
        table1.obt_coursemark tot_input_mark,
        ((((table1.coursemark*table2.mark_in_percentage)/100)*table1.obt_coursemark)/table2.cat_hld_mark) AS std_obt_mark,
        (((table1.coursemark*table2.mark_in_percentage)/100)*33)/100 AS passmark,
        (((((table1.coursemark*table2.mark_in_percentage)/100)*table1.obt_coursemark)/table2.cat_hld_mark))-((((table1.coursemark*table2.mark_in_percentage)/100)*40)/100) AS mark_above_40_percent,
        table1.mearge_name,
        table1.coursetypeid,
        table1.courseCode,
        table1.courseName
        FROM (SELECT 
        mxm.programofferid,
        students.sectionid,
        students.id AS studentid,
        mxm.coursecodeid,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name,
        SUM(mxm.marks) obt_coursemark,
        student_courses.coursetypeid,
        course_codes.name AS courseCode,
        courses.name AS courseName
        FROM `mst_exam_marks` AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN students ON mxm.programofferid=students.programofferid && mxm.studentid=students.id
        INNER JOIN student_courses ON mxm.studentid=student_courses.studentid && mxm.coursecodeid=student_courses.coursecodeid
        INNER JOIN course_codes ON mxm.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=?
        GROUP BY mxm.coursecodeid) AS table1
        INNER JOIN (SELECT
        programofferid,
        coursecodeid,
        SUM(mark_in_percentage) AS mark_in_percentage,
        sum(cat_hld_mark) AS cat_hld_mark
        FROM `mark_distribution`
        WHERE programofferid=? GROUP BY coursecodeid) AS table2
        ON table1.programofferid=table2.programofferid && table1.coursecodeid=table2.coursecodeid) AS mearge_course
        GROUP BY meargeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$programofferid]);
        $result=collect($qResult);
        return $result;
    } 
    public function getCourses($programofferid,$examnameid,$studentid,$meargeid){
        $sql="SELECT table1.programofferid,
        table1.sectionid,
        table1.studentid,
        table1.coursecodeid,
        table1.meargeid,
        table1.coursemark AS coursemark,
        table2.mark_in_percentage AS mark_in_percentage,
        (table1.coursemark*table2.mark_in_percentage)/100 AS cal_coursemark,
        table2.cat_hld_mark AS course_hld_mark,
        table1.obt_coursemark tot_input_mark,
        ((((table1.coursemark*table2.mark_in_percentage)/100)*table1.obt_coursemark)/table2.cat_hld_mark) AS std_obt_mark,
        (((table1.coursemark*table2.mark_in_percentage)/100)*33)/100 AS passmark,
        (((((table1.coursemark*table2.mark_in_percentage)/100)*table1.obt_coursemark)/table2.cat_hld_mark))-((((table1.coursemark*table2.mark_in_percentage)/100)*40)/100) AS mark_above_40_percent,
        CASE
         WHEN ((table2.mark_in_percentage*table1.obt_coursemark)/table2.cat_hld_mark)>((((table1.coursemark*table2.mark_in_percentage)/100)*33)/100) THEN 1
         ELSE 0
        END AS course_pass_status,
        table1.mearge_name,
        table1.coursetypeid,
        table1.courseCode,
        table1.courseName
        FROM (SELECT 
        mxm.programofferid,
        students.sectionid,
        students.id AS studentid,
        mxm.coursecodeid,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name,
        SUM(mxm.marks) obt_coursemark,
        student_courses.coursetypeid,
        course_codes.name AS courseCode,
        courses.name AS courseName
        FROM `mst_exam_marks` AS mxm
        INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
        INNER JOIN students ON mxm.programofferid=students.programofferid && mxm.studentid=students.id
        INNER JOIN student_courses ON mxm.studentid=student_courses.studentid && mxm.coursecodeid=student_courses.coursecodeid
        INNER JOIN course_codes ON mxm.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=?
        GROUP BY mxm.coursecodeid) AS table1
        INNER JOIN (SELECT
        programofferid,
        coursecodeid,
        SUM(mark_in_percentage) AS mark_in_percentage,
        sum(cat_hld_mark) AS cat_hld_mark
        FROM `mark_distribution`
        WHERE programofferid=? GROUP BY coursecodeid) AS table2
        ON table1.programofferid=table2.programofferid && table1.coursecodeid=table2.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$programofferid]);
        $result=collect($qResult);
        // dd($result);
        $courses = $result->where("meargeid","=",$meargeid);
        return $courses;
    }
    
    public function getGroupMarkCategories($programofferid,$examnameid,$studentid,$coursecodeid){
        $sql="select 
        table1.programofferid,
        table1.coursecodeid,
        table1.mark_group_id,
        COUNT(table1.mark_group_id) AS mark_group_frequency,
        table1.coursemark,
        sum(table1.mark_in_percentage)  AS group_mark_in_percentage,
        sum(table1.cal_coursemark) as group_cal_coursemark,
        sum(table1.cat_hld_mark) as group_cat_hld_mark,
        sum(table1.std_input_mark) AS group_std_input_mark,
        sum(table1.std_obt_mark) as group_std_obt_mark,
        sum(table1.pass_mark) AS group_pass_mark,
        CASE 
        WHEN std_obt_mark > pass_mark THEN 1
         ELSE 0
        END AS group_cat_pass_status
        FROM(SELECT
                mxm.programofferid,
                mxm.coursecodeid,
                md.mark_group_id,
                courseoffer.coursemark,
                md.mark_in_percentage,
                (courseoffer.coursemark* md.mark_in_percentage)/100 AS cal_coursemark,
                md.cat_hld_mark,
                mxm.marks AS std_input_mark,
                ((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks/md.cat_hld_mark as std_obt_mark,
                (((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100 AS pass_mark
                FROM mst_exam_marks AS mxm
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.coursecodeid=courseoffer.coursecodeid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.coursecodeid=md.coursecodeid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN mark_categories on md.markcategoryid=mark_categories.id
                WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=? && mxm.coursecodeid=?) AS table1
                GROUP BY table1.mark_group_id";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }
    public function getMarkCategories($programofferid,$examnameid,$studentid,$coursecodeid){
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
        WHERE mxm.programofferid=? && mxm.examnameid=? && mxm.studentid=6 && mxm.coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }
    public function getGradePoint($programofferid,$obt_marks,$marks){
        // dd($marks);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter($programofferid,$marks);
        foreach($point_letters as $item){
            if($obt_marks>=$item->cal_from_mark && $obt_marks<=$item->cal_to_mark){
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
    public function getGradeLetter($programofferid,$obt_marks,$marks){
        $sql="SELECT * 
        FROM(SELECT grade_point.programofferid,
        courseoffer.coursemark,
        grade_letter.name,
        grade_point.from_mark,
        (grade_point.from_mark*".$marks.")/100 AS cal_from_mark,
        (grade_point.to_mark*".$marks.")/100 AS cal_to_mark,
        grade_point.to_mark,
        grade_point.gradepoint
        FROM `grade_point`  
        INNER JOIN grade_letter ON grade_point.gradeletterid=grade_letter.id
        INNER JOIN courseoffer ON grade_point.programofferid=courseoffer.programofferid
        WHERE grade_point.programofferid=2 && courseoffer.coursecodeid=2) AS gradeletter
        WHERE ".$obt_marks.">=cal_from_mark && ".$obt_marks."<=cal_to_mark";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult)->first();
        return $result;
    }
}
