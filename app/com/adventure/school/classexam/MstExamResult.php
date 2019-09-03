<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\academic\StudentCourse;
use App\com\adventure\school\courseoffer\MarkDistribution;
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
        // $aStudentCourse=new StudentCourse();
        // $student_courses=$aStudentCourse->getStudentCourses(1);
        // dd($student_courses);
        $aCourseOffer=new CourseOffer();
        $students=$this->getStudents($programofferid,$examnameid);
        $tot_courses=$aCourseOffer->getTotalCourses($programofferid);
        // 1.
        // dd($students);
        $course_highest_mark=array();
        foreach($students as $student){
            $common_marks=0;
            $common_obt_marks=0;
            $tot_common_marks=0;
            $tot_common_obt_marks=0;
            $tot_grade_point=0;
            $common_pass_sub=0;
            $common_fail_sub=0;
            $student_pass_status=1;
            $grade_point=0;
            $grade_letter="";
            $mearge_courses=$this->getMeargeCourse($programofferid,$examnameid,$student->id);
            // 2.
            // dd($mearge_courses);
            $tot_mcourse_grade_point=0;
            $tot_mcourse=0;
            foreach($mearge_courses as $mc){
                //Mearge course group for pass check
                $mearge_course_groups=$this->getMeargeGroupCourse($programofferid,$examnameid,$student->id,$mc->meargeid);
                // 3.
                $courses=$this->getCourses($programofferid,$examnameid,$student->id,$mc->meargeid);
                // 4.
                // dd($courses);
                $m_tot_point=0;
                foreach($courses as $course){
                    $course_grade_point=0;
                    $course_grade_letter="";
                    $gradepoint=$this->getGradePoint($programofferid,$course->round_std_course_obt_mark,$course->tot_course_mark);
                    $m_tot_point=$m_tot_point+$gradepoint['grade_point'];
                    if(!isset($course_highest_mark[$course->courseid])){
                        $course_highest_mark[$course->courseid]=array();
                    }
                    array_push($course_highest_mark[$course->courseid],$course->round_std_course_obt_mark);
                    // =================
                    $group_categories=$this->getGroupCategory($programofferid,$examnameid,$student->id,$course->courseid);
                    // 5.
                    foreach($group_categories as $gc){
                        if($gc->g_cat_pass_status==0){
                            $course->course_pass_status=0;
                        }
                    }
                    if($course->coursetypeid==1){
                        if($course->course_pass_status==0){
                            $common_fail_sub++;
                            // dd($common_fail_sub);
                        }
                        $common_marks=$common_marks+$course->tot_course_mark;
                        $common_obt_marks=$common_obt_marks+$course->round_std_course_obt_mark;
                        $common_pass_sub++;
                        $tot_grade_point=$tot_grade_point+$gradepoint['grade_point'];
                    }elseif($course->coursetypeid==2){
                        $mark_40_percent=($course->tot_course_mark*40)/100;
                        $grade_point_c=2;
                        if($gradepoint['grade_point']>$grade_point_c){
                            $diff_point=$gradepoint['grade_point']-$grade_point_c;
                            $tot_grade_point=$tot_grade_point+$diff_point;
                            if($tot_grade_point>$common_pass_sub*5){
                                $tot_grade_point=$common_pass_sub*5;
                            }
                        }
                        if($course->round_std_course_obt_mark>$mark_40_percent){
                            $diff=$course->round_std_course_obt_mark-$mark_40_percent;
                            $common_obt_marks=$common_obt_marks+$diff;
                            if($common_obt_marks>$common_marks){
                                $common_obt_marks=$common_marks;
                            }
                        }
                    }
                    $tot_common_marks=$tot_common_marks+$course->tot_course_mark;
                    $tot_common_obt_marks=$tot_common_obt_marks+$course->round_std_course_obt_mark;
                    // =================
                    // course group categories for pass check
                    // $group_categories=$this->getGroupCategory($programofferid,$examnameid,$student->id,$course->courseid);
                    // // 5.
                    // foreach($group_categories as $gc){
                    //     if($gc->g_cat_pass_status==0){
                    //         $course->course_pass_status=0;
                    //     }
                    // }
                    $categories=$this->getCategories($programofferid,$examnameid,$student->id,$course->courseid);
                    // 6.
                    // dd($categories);
                    $course->categories=$categories;
                    $course->course_grade_point=$gradepoint['grade_point'];
                    $course->course_grade_letter=$gradepoint['grade_letter'];
                    // dd($course);
                }
                foreach($mearge_course_groups as $mcg){
                    if($mcg->mg_cat_pass_status==0){
                        $mc->mc_pass_status=0;
                    }
                }
                if($mc->mc_pass_status==1){
                    $m_averagepoint=$m_tot_point/$mc->course_frequency;
                }else{
                    $m_averagepoint=0;
                }
                if($mc->coursetypeid==1 && $mc->mc_pass_status==0){
                    $student_pass_status=0;
                }
                $m_point_letter=$this->getGradeLetter($programofferid,$m_averagepoint);
                $mc->mcourse_grade_point=$m_point_letter['gradepoint'];
                if($mc->coursetypeid==1){
                    $tot_mcourse_grade_point=$tot_mcourse_grade_point+$m_point_letter['gradepoint'];
                    $tot_mcourse++;
                }elseif($mc->coursetypeid==2){
                    if($m_point_letter['gradepoint']>2){
                        $tot_mcourse_grade_point=$tot_mcourse_grade_point+$m_point_letter['gradepoint']-2;
                        if($tot_mcourse_grade_point>$tot_mcourse*5){
                            $tot_mcourse_grade_point=$tot_mcourse*5;
                        }
                    }
                }
                $mc->mcourse_grade_letter=$m_point_letter['grade_letter'];
                $mc->courses=$courses;
                $mc->mcg=$mearge_course_groups;
                // reset course and categories status if student pass
                if($student_pass_status==1){
                    $reset_course=$this->getCourses($programofferid,$examnameid,$student->id,$mc->meargeid);
                    foreach($reset_course as $course){
                        $course_grade_point=0;
                        $course_grade_letter="";
                        $gradepoint=$this->getGradePoint($programofferid,$course->round_std_course_obt_mark,$course->tot_course_mark);
                        $re_group_categories=$this->getGroupCategory($programofferid,$examnameid,$student->id,$course->courseid);
                        $categories=$this->getCategories($programofferid,$examnameid,$student->id,$course->courseid);
                        if($course->coursetypeid==1){
                            $course->course_pass_status=1;
                            foreach($categories as $c_cat){
                                $c_cat->cat_pass_status=1;
                            }
                        }else{
                            foreach($re_group_categories as $gc){
                                if($gc->g_cat_pass_status==0){
                                    $course->course_pass_status=0;
                                }
                            }
                        }
                        $course->course_grade_point=$gradepoint['grade_point'];
                        $course->course_grade_letter=$gradepoint['grade_letter'];
                        $course->categories=$categories;
                    }
                    $mc->courses=$reset_course;
                }
                // =======End reset=========
            }
            $student->tot_mcourse_grade_point=$tot_mcourse_grade_point;
            $student->tot_mcourse=$tot_mcourse;
            // dd($tot_mcourse_grade_point);
            $temp_tot_avg_point=0;
            $std_percentage_marks=0;
            if($student_pass_status==1){
                $temp_tot_avg_point=$tot_mcourse_grade_point/$tot_mcourse;
                $std_percentage_marks=($common_obt_marks*100)/$common_marks;
            }
            $tot_point_letter=$this->getGradeLetter($programofferid,$temp_tot_avg_point);
            $student->m_courses=$mearge_courses;
            $student->common_marks=$common_marks;
            $student->common_obt_marks=$common_obt_marks;
            $student->std_percentage_marks=$std_percentage_marks;
            $student->tot_common_marks=$tot_common_marks;
            $student->tot_common_obt_marks=$tot_common_obt_marks;
            $student->tot_grade_point=$tot_grade_point;
            $student->grade_point=$temp_tot_avg_point;
            $student->grade_letter=$tot_point_letter['grade_letter'];
            $student->common_pass_sub=$common_pass_sub;
            $student->common_fail_sub=$common_fail_sub;
            $student->student_pass_status=$student_pass_status;
            $student->class_position=0;
            $student->section_position=0; 
            // dd($student); 
        }
        // dd($students);
        // Calcuate Highest Mark
        $highest_course_mark=array();
        foreach($course_highest_mark as $k=>$v){
            $highest_course_mark[$k]=max($v);
        }
        // dd($highest_course_mark);
        // sorting for position
        $students=$students
        ->sortByDesc("student_pass_status")
        ->sortByDesc("common_obt_marks")
        ->sortByDesc("grade_point");
        $position=1;
        foreach ($students as $std){
            $std->class_position=$position++;
            $std->highest_course_mark=$highest_course_mark;
        }
        $student_on_section=$students->groupBy("sectionid");
        foreach ($student_on_section as $section_item) {
            $i=1;
            foreach($section_item as $std){
                    $std->section_position=$i++;
            }
        }
        $students=$student_on_section->collapse();
        // dd($students);
        return $students;
    }
    public function getGradePoint($programofferid,$tot_obt_course_mark,$tot_course_mark){
        $compare=($tot_obt_course_mark*100)/$tot_course_mark;
        // dd($compare);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointTable($programofferid);
        $data_array=array();
        $length=count($point_letters);
        $start=1;
        $diff= .5;
        // dd($diff);
        for($i=0;$i<$length;$i++){
            if($start==1){
                $from_mark=$point_letters[$i]->from_mark;
                $to_mark=$point_letters[$i]->to_mark;
                $compare_mark=$point_letters[$i]->to_mark;
            }else{
                $from_mark=$point_letters[$i]->from_mark;
                $to_mark=$point_letters[$i]->to_mark;
                $compare_mark=$point_letters[$i]->to_mark+$diff;
            }
            $start++;
            array_push($data_array,array(
                "from_mark"=>$from_mark,
                "to_mark"=>$to_mark,
                "compare_mark"=>$compare_mark,
                "grade_letter"=>$point_letters[$i]->name,
                "grade_point"=>$point_letters[$i]->gradepoint
            ));
        }
        // dd($data_array);
        for($i=0;$i<count($data_array)-1;$i++){
            if($compare>=$data_array[$i+1]['compare_mark'] && $compare<=$data_array[$i]['to_mark']){
                return $data_array[$i];
            }
        }
        return $data_array[count($data_array)-1];
    }
    public function getGradeLetter($programofferid,$tot_grade_point){
        // dd($point);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointTable($programofferid);
        $point_letters=$point_letters->sortByDesc("gradepoint");
        // dd($point_letters);
        $point_letter_array=array();
        foreach($point_letters as $x){
            array_push($point_letter_array,array("gradepoint"=>$x->gradepoint,"grade_letter"=>$x->name));
        }
        for ($i=0;$i<count($point_letter_array)-1;$i++){
            if(($tot_grade_point<$point_letter_array[$i]["gradepoint"]) && ($tot_grade_point>=$point_letter_array[$i+1]["gradepoint"])){
                return $point_letter_array[$i+1];
            }
        }
        return $point_letter_array[0];
    }
    public function getStudents($programofferid,$examnameid){
        $sql="select 
        students.*,
        IFNULL(mxm.studentid,0) AS studentid
        from(SELECT 
        students.*,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        applicants.picture,
        applicants.signature
        FROM `students`
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        WHERE programofferid=?) AS students
        LEFT JOIN (SELECT programofferid, studentid FROM `mst_exam_marks`
        WHERE programofferid=? && examnameid=? GROUP BY studentid) AS mxm
        ON students.id=mxm.studentid";
        $qResult=\DB::select($sql,[$programofferid,$programofferid,$examnameid]);
        $result=collect($qResult);
        return $result;
    }
    // Get Courses
    public function getCourses($programofferid,$examnameid,$studentid,$meargeid){
        $sql="SELECT
        programofferid,
        sectionid,
        studentid,
        examnameid,
        courseid,
        meargeid,
        courseCode,
        coursetypeid,
        tot_course_mark,
        round_std_course_obt_mark,
        course_pass_status
        FROM(SELECT 
        programofferid,
        sectionid,
        studentid,
        examnameid,
        courseid,
        coursetypeid,
        meargeid,
        mark_group_id,
        courseName,
        courseCode,
        coursemark,
        sum(mark_in_percentage) AS tot_percentage,
        SUM(cat_hld_mark) AS course_hld_mark,
        (coursemark*sum(mark_in_percentage))/100 AS tot_course_mark,
        sum(std_input_mark) AS tot_input_mark,
        (((coursemark*sum(mark_in_percentage))/100)*33)/100 AS coursepass,
        ROUND((((coursemark*sum(mark_in_percentage))/100)*33)/100,0) AS round_coursepass,
        (((coursemark*sum(mark_in_percentage))/100)*sum(std_input_mark))/SUM(cat_hld_mark) as std_course_obt_mark,
        ROUND((((coursemark*sum(mark_in_percentage))/100)*sum(std_input_mark))/SUM(cat_hld_mark),0) AS round_std_course_obt_mark,
        CASE
                 WHEN ROUND((((coursemark*sum(mark_in_percentage))/100)*sum(std_input_mark))/SUM(cat_hld_mark),0)>=ROUND((((coursemark*sum(mark_in_percentage))/100)*33)/100,0) THEN 1
                 else 0
             end as course_pass_status
        FROM (SELECT
                mxm.programofferid,
                mxm.sectionid,
                mxm.studentid,
                   mxm.examnameid,
                mxm.courseid,
                  stdu.coursetypeid,
                courseoffer.meargeid,
                md.markcategoryid,
                md.mark_group_id,
                courses.courseName,
                courses.courseCode,
                courseoffer.mearge_name,
                courseoffer.coursemark,
                md.mark_in_percentage,
                md.cat_hld_mark,
                mxm.marks AS std_input_mark,
                (courseoffer.coursemark* md.mark_in_percentage)/100 AS cat_mark,
                (((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100 AS pass_mark,
                ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100,0) AS round_pass_mark,
                (((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark AS std_obt_mark,
                ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark,0) AS round_std_obt_mark,
                CASE
                 WHEN  ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark,0)>=ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100,0) THEN 1
                 else 0
                end as cat_pass_status
                FROM mst_exam_marks AS mxm
               INNER JOIN(SELECT 
        students.programofferid,
        student_courses.studentid,
        student_courses.courseid,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid) AS stdu ON mxm.programofferid=stdu.programofferid && mxm.studentid=stdu.studentid  && mxm.courseid=stdu.courseid 
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.courseid=courseoffer.courseid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.courseid=md.courseid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN courses ON mxm.courseid=courses.id
          GROUP BY mxm.programofferid,mxm.examnameid,mxm.sectionid,mxm.studentid,mxm.courseid,md.markcategoryid,md.mark_group_id) AS course group BY programofferid,sectionid,studentid,courseid) AS course_table
         WHERE programofferid=? && examnameid=? && studentid=? && meargeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$meargeid]);
        $result=collect($qResult);
        return $result;
    }
    // Course Group pass Status
    public function getGroupCategory($programofferid,$examnameid,$studentid,$courseid){
        $sql="SELECT 
        programofferid,
        sectionid,
        studentid,
        examnameid,
        courseid,
        coursetypeid,
        markcategoryid,
        g_cat_pass_status
        FROM(SELECT
                mxm.programofferid,
                mxm.sectionid,
                mxm.studentid,
                 mxm.examnameid,
                mxm.courseid,
                coursetypeid,
                md.markcategoryid,
                mark_categories.name AS markcatName,
                courseoffer.meargeid,
                md.mark_group_id,
                courses.courseName,
                courses.courseCode,
                courseoffer.mearge_name,
                courseoffer.coursemark,
                sum(md.mark_in_percentage) AS g_mark_in_percentage,
                sum(md.cat_hld_mark) AS g_cat_hld_mark,
                sum(mxm.marks) AS g_std_input_mark,
                sum((courseoffer.coursemark* md.mark_in_percentage)/100) AS g_cat_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100) AS g_pass_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) AS g_round_pass_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark) AS g_std_obt_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0) AS g_round_std_obt_mark,
                CASE
                 WHEN  ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0)>=ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) THEN 1
                 else 0
                end as g_cat_pass_status
                FROM mst_exam_marks AS mxm
                INNER JOIN mark_categories ON mxm.markcategoryid=mark_categories.id
                 INNER JOIN(SELECT 
        students.programofferid,
        student_courses.studentid,
        student_courses.courseid,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid) AS stdu ON mxm.programofferid=stdu.programofferid && mxm.studentid=stdu.studentid  && mxm.courseid=stdu.courseid
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.courseid=courseoffer.courseid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.courseid=md.courseid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN courses ON mxm.courseid=courses.id
          GROUP BY mxm.programofferid,mxm.examnameid,mxm.sectionid,mxm.studentid,mxm.courseid,md.mark_group_id) AS course_GROUP
          WHERE programofferid=? && examnameid=? && studentid=? && courseid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$courseid]);
        $result=collect($qResult);
        return $result;
    }
    public function getCategories($programofferid,$examnameid,$studentid,$courseid){
        $sql="SELECT
        programofferid,
        sectionid,
        studentid,
        examnameid,
        courseid,
        coursetypeid,
        markcategoryid,
        markcatName,
        cat_mark,
        round_cat_pass_mark,
        round_std_obt_mark,
        cat_pass_status
        FROM(SELECT
                mxm.programofferid,
                mxm.sectionid,
                mxm.studentid,
                 mxm.examnameid,
                mxm.courseid,
                coursetypeid,
                courseoffer.meargeid,
                md.markcategoryid,
                 mark_categories.name AS markcatName,
                md.mark_group_id,
                courses.courseName,
                courses.courseCode,
                courseoffer.mearge_name,
                courseoffer.coursemark,
                md.mark_in_percentage,
                md.cat_hld_mark,
                mxm.marks AS std_input_mark,
                (courseoffer.coursemark* md.mark_in_percentage)/100 AS cat_mark,
                (((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100 AS cat_pass_mark,
                ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100,0) AS round_cat_pass_mark,
                (((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark AS std_obt_mark,
                ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark,0) AS round_std_obt_mark,
                CASE
                 WHEN  ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark,0)>=ROUND((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100,0) THEN 1
                 else 0
                end as cat_pass_status
                FROM mst_exam_marks AS mxm
             INNER JOIN mark_categories ON mxm.markcategoryid=mark_categories.id
                INNER JOIN(SELECT 
        students.programofferid,
        student_courses.studentid,
        student_courses.courseid,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid) AS stdu ON mxm.programofferid=stdu.programofferid && mxm.studentid=stdu.studentid  && mxm.courseid=stdu.courseid 
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.courseid=courseoffer.courseid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.courseid=md.courseid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN courses ON mxm.courseid=courses.id
          GROUP BY mxm.programofferid,mxm.examnameid,mxm.sectionid,mxm.studentid,mxm.courseid,md.markcategoryid) AS categories
        WHERE programofferid=? && examnameid=? && studentid=? && courseid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$courseid]);
        $result=collect($qResult);
        return $result;
    }
    // Mearge Course Pass
    public function getMeargeCourse($programofferid,$examnameid,$studentid){
        $sql="SELECT 
        programofferid,
        sectionid,
        examnameid,
        studentid,
        meargeid,
        course_frequency,
        coursetypeid,
        mc_name,
        mc_pass_status 
        FROM (SELECT 
         programofferid,
         sectionid,
         examnameid,
                studentid,
                meargeid,
              course_frequency,
              coursetypeid,
                mark_group_id,
                   IFNULL(mearge_name,courseName) mc_name,
                mg_coursemark AS mc_coursemark,
                sum(mg_mark_in_percentage) AS mc_mark_in_percentage,
                sum(mg_cat_hld_mark) AS mc_cat_hld_mark,
                sum(mg_std_input_mark) AS mc_std_input_mark,
                (mg_coursemark*sum(mg_mark_in_percentage))/100 AS mc_mark,
                (((mg_coursemark*sum(mg_mark_in_percentage))/100)*33)/100 as mc_pass_mark,
                ROUND((((mg_coursemark*sum(mg_mark_in_percentage))/100)*33)/100,0) as round_mc_pass_mark,
                (sum(mg_std_input_mark)*((mg_coursemark*sum(mg_mark_in_percentage))/100))/sum(mg_cat_hld_mark) AS mc_std_obt_mark,
                ROUND((sum(mg_std_input_mark)*((mg_coursemark*sum(mg_mark_in_percentage))/100))/sum(mg_cat_hld_mark),0) AS round_mc_std_obt_mark,
                 CASE
                 WHEN  ROUND((sum(mg_std_input_mark)*((mg_coursemark*sum(mg_mark_in_percentage))/100))/sum(mg_cat_hld_mark),0)>=ROUND((((mg_coursemark*sum(mg_mark_in_percentage))/100)*33)/100,0) THEN 1
                 else 0
                end as mc_pass_status
        FROM (SELECT
         programofferid,
                sectionid,
              examnameid,
                studentid,
                meargeid,
              coursetypeid,
              COUNT(meargeid) AS course_frequency,
                mark_group_id,
                courseName,
                courseCode,
                mearge_name,
        sum(coursemark) AS mg_coursemark,
        g_mark_in_percentage as mg_mark_in_percentage,
        sum(g_cat_hld_mark) AS mg_cat_hld_mark,
        sum(g_std_input_mark) AS mg_std_input_mark,
        (sum(coursemark)*g_mark_in_percentage)/100 AS mg_cat_mark,
        ((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100) AS mg_pass_mark,
        ROUND(((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100),0) AS round_mg_pass_mark,
        (sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark) as mg_std_obt_mark,
        round((sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark)) AS round_mg_std_obt_mark,
        case
         WHEN  round((sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark))>=ROUND(((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100),0) THEN 1
                 else 0
                end as mg_cat_pass_status
        FROM(SELECT
                mxm.programofferid,
                mxm.sectionid,
                mxm.examnameid,
                mxm.studentid,
                mxm.courseid,
             coursetypeid,
                meargeid,
                mark_group_id,
                courseName,
                courseCode,
                mearge_name,
                coursemark,
                sum(md.mark_in_percentage) AS g_mark_in_percentage,
                sum(md.cat_hld_mark) AS g_cat_hld_mark,
                sum(mxm.marks) AS g_std_input_mark,
                sum((courseoffer.coursemark* md.mark_in_percentage)/100) AS g_cat_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100) AS g_pass_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) AS g_round_pass_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark) AS g_std_obt_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0) AS g_round_std_obt_mark,
                CASE
                 WHEN  ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0)>=ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) THEN 1
                 else 0
                end as g_cat_pass_status
                FROM mst_exam_marks AS mxm
             INNER JOIN mark_categories ON mxm.markcategoryid=mark_categories.id
             INNER JOIN(SELECT 
        students.programofferid,
        student_courses.studentid,
        student_courses.courseid,
        student_courses.coursetypeid
        FROM `students`
        INNER JOIN student_courses ON students.id=student_courses.studentid) AS stdu ON mxm.programofferid=stdu.programofferid && mxm.studentid=stdu.studentid  && mxm.courseid=stdu.courseid 
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.courseid=courseoffer.courseid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.courseid=md.courseid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN courses ON mxm.courseid=courses.id
          GROUP BY mxm.programofferid,mxm.examnameid,mxm.sectionid,mxm.studentid,mxm.courseid,md.mark_group_id) AS mgtable
          group BY programofferid,examnameid,sectionid,studentid,meargeid,mark_group_id) AS mg_course
          GROUP BY programofferid,examnameid,sectionid,studentid,meargeid) AS mearge_course
          WHERE programofferid=? && examnameid=? && studentid=?";
          $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid]);
          $result=collect($qResult);
          return $result;
    }
    // Mearge Course Group Pass
    public function getMeargeGroupCourse($programofferid,$examnameid,$studentid,$meargeid){
        $sql="SELECT 
        programofferid,
        sectionid,
        examnameid,
        studentid,
        meargeid,
        markcategoryid,
        mg_cat_pass_status 
        FROM(SELECT
         programofferid,
                sectionid,
         examnameid,
                studentid,
                courseid,
                meargeid,
                markcategoryid,
                mark_group_id,
                courseName,
                courseCode,
                mearge_name,
        sum(coursemark) AS mg_coursemark,
        g_mark_in_percentage as mg_mark_in_percentage,
        sum(g_cat_hld_mark) AS mg_cat_hld_mark,
        sum(g_std_input_mark) AS mg_std_input_mark,
        (sum(coursemark)*g_mark_in_percentage)/100 AS mg_cat_mark,
        ((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100) AS mg_pass_mark,
        ROUND(((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100),0) AS round_mg_pass_mark,
        (sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark) as mg_std_obt_mark,
        round((sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark)) AS round_mg_std_obt_mark,
        case
         WHEN  round((sum(g_std_input_mark)*((sum(coursemark)*g_mark_in_percentage)/100))/sum(g_cat_hld_mark))>=ROUND(((((sum(coursemark)*g_mark_in_percentage)/100)*33)/100),0) THEN 1
                 else 0
                end as mg_cat_pass_status
        FROM(SELECT
                mxm.programofferid,
                mxm.sectionid,
                 mxm.examnameid,
                mxm.studentid,
                mxm.courseid,
                meargeid,
                 md.markcategoryid,
                mark_group_id,
                courseName,
                courseCode,
                mearge_name,
                coursemark,
                sum(md.mark_in_percentage) AS g_mark_in_percentage,
                sum(md.cat_hld_mark) AS g_cat_hld_mark,
                sum(mxm.marks) AS g_std_input_mark,
                sum((courseoffer.coursemark* md.mark_in_percentage)/100) AS g_cat_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100) AS g_pass_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) AS g_round_pass_mark,
                sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark) AS g_std_obt_mark,
                ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0) AS g_round_std_obt_mark,
                CASE
                 WHEN  ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*mxm.marks)/md.cat_hld_mark),0)>=ROUND(sum((((courseoffer.coursemark* md.mark_in_percentage)/100)*33)/100),0) THEN 1
                 else 0
                end as g_cat_pass_status
                FROM mst_exam_marks AS mxm
                INNER JOIN courseoffer ON mxm.programofferid=courseoffer.programofferid && mxm.courseid=courseoffer.courseid
                INNER JOIN mark_distribution as md on mxm.programofferid=md.programofferid && mxm.courseid=md.courseid && mxm.markcategoryid=md.markcategoryid
                INNER JOIN courses ON mxm.courseid=courses.id
          GROUP BY mxm.programofferid,mxm.examnameid,mxm.sectionid,mxm.studentid,mxm.courseid,md.mark_group_id) AS mgtable
          group BY programofferid,examnameid,sectionid,studentid,meargeid,mark_group_id) AS mearge_group
          WHERE programofferid=? && examnameid=? && studentid=? && meargeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$meargeid]);
        $result=collect($qResult);
        return $result;
    }
    public function getCoursesWithCategories($programofferid){
        $aCourseOffer=new CourseOffer();
        $aMarkDistribution=new MarkDistribution();
        $courses=$aCourseOffer->getCoursesOnProgramoffer($programofferid);
        // dd($courses);
        $result_array=array();
        foreach($courses as $course){
            $categories=$aMarkDistribution->getMarkCategory($programofferid,$course->id);
            $course->categories=$categories;
            $result_array[$course->id]=$course;
        }
        // dd($result_array);
        return $result_array;
    }
}
