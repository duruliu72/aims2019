<?php

namespace App\com\adventure\school\classexam;
use App\com\adventure\school\program\GradePoint;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\academic\Student;
use Illuminate\Database\Eloquent\Model;

class MstExamResult extends Model
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
            $mearge_courses=$this->getCourseOnMearge($x->programofferid,$x->examnameid,$x->studentid);
            $courses=$this->getCourses($x->programofferid,$x->examnameid,$x->studentid);
            $course_data=array();
            foreach($courses as $y){
                $markcat_data=array();
                $markCategories=$this->getMarkCategory($x->programofferid,$x->examnameid,$x->studentid,$y->coursecodeid);
                $tot_mark=0;
                $tot_course_marks=0;
                $pass_status=true;
                $group_result = $markCategories->groupBy("passtypeid")->map(function($item,$key){
                    $c["categorymarks"]=$item->sum("categorymarks");
                    $c["obt_marks"]=$item->sum("obt_marks");
                    return $c;
                });
                foreach($group_result as $v){
                    $t=($v["categorymarks"]*33)/100;
                    if($v["obt_marks"]<$t){
                        $pass_status=false;
                    }
                }
                foreach($markCategories as $markcat){
                    $markcat_data[$markcat->markcategoryid]=array(
                        "markcategoryid"=>$markcat->markcategoryid,
                        "markcatName"=>$markcat->markcatName,
                        "passtypeid"=>$markcat->passtypeid,
                        "categorymarks"=>$markcat->categorymarks,
                        "obt_marks"=>$markcat->obt_marks
                    );
                    $tot_mark=$tot_mark+$markcat->obt_marks;
                    $tot_course_marks=$tot_course_marks+$markcat->categorymarks;
                    $point_letter=$this->getGradePoint($programofferid,$tot_mark);
                }
                $course_data[$y->coursecodeid]=array(
                    "coursecodeid"=>$y->coursecodeid,
                    "courseCode"=>$y->courseCode,
                    "courseName"=>$y->courseName,
                    "coursetypeid"=>$y->coursetypeid,
                    "meargeid"=>$y->meargeid,
                    "markcat"=>$markcat_data,
                    "tot_course_marks"=>$tot_course_marks,
                    "tot_mark"=>$tot_mark,
                    "pass_status"=>$pass_status,
                    "gradepoint"=>$point_letter["gradepoint"],
                    "gradeletter"=>$point_letter["gradeletter"]
                );
            }
            $tot_pass_status=true;
            $grand_courses_marks=0;
            $grand_obt_marks=0;
            $tot_gradepoint=0;
            $tot_fail_sub=0;
            $compalsary_subj=0;
            $all_course_marks=0;
            $all_course_obt_marks=0;
            $collect_courses=collect($course_data);
            $group_courses11 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",1);
            foreach($group_courses11 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                    $tot_fail_sub++;
                }
                $compalsary_subj++;
                $grand_obt_marks=$grand_obt_marks+$item["tot_mark"];
                $grand_courses_marks=$grand_courses_marks+$item["tot_course_marks"];
                $tot_gradepoint=$tot_gradepoint+$item["gradepoint"];
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            $group_courses12 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",1);
            foreach($group_courses12 as $item){
                if($item["pass_status"]==false){
                    $tot_fail_sub++;
                }
                $compalsary_subj++;
                $grand_obt_marks=$grand_obt_marks+$item["tot_mark"];
                $grand_courses_marks=$grand_courses_marks+$item["tot_course_marks"];
                $tot_gradepoint=$tot_gradepoint+$item["gradepoint"];
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            $group_courses21 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",2);
            foreach($group_courses21 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                }
                if($item["tot_mark"]>40){
                    $grand_obt_marks=$grand_obt_marks+$item["tot_mark"]-40;
                }
                if($item["gradepoint"]>3){
                    $tot_gradepoint=$tot_gradepoint+$item["gradepoint"]-3;
                }
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            $group_courses22 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",2);
            foreach($group_courses22 as $item){
                if($item["tot_mark"]>40){
                    $grand_obt_marks=$grand_obt_marks+$item["tot_mark"]-40;
                }
                if($item["gradepoint"]>2){
                    $tot_gradepoint=$tot_gradepoint+$item["gradepoint"]-2;
                }
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            $group_courses31 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",3);
            foreach($group_courses31 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                }
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            $group_courses32 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",3);
            foreach($group_courses32 as $item){
                $all_course_marks=$all_course_marks+$item["tot_course_marks"];
                $all_course_obt_marks=$all_course_obt_marks+$item["tot_mark"];
            }
            // ========
            $group_mearge_courses1=$mearge_courses->where("coursetypeid","=",1);
            $group_mearge_courses2=$mearge_courses->where("coursetypeid","=",2);
            $group_mearge_courses3=$mearge_courses->where("coursetypeid","=",3);
            foreach($group_mearge_courses1 as $item){
                $t=($item->categorymarks*33)/100;
                if($item->obt_marks<$t){
                    $tot_pass_status=false;
                }
            }
            foreach($group_mearge_courses2 as $item){
                $t=($item->categorymarks*33)/100;
                if($item->obt_marks<$t){
                    $tot_pass_status=false;
                }

            }
            foreach($group_mearge_courses3 as $item){
                $t=($item->categorymarks*33)/100;
                if($item->obt_marks<$t){
                    $tot_pass_status=false;
                }
            }
            $x->course_array=$course_data;
            $x->tot_pass_status=$tot_pass_status;
            $x->grand_courses_marks=$grand_courses_marks;
            $x->grand_obt_marks=$grand_obt_marks;
            $x->percentage_mark=($grand_obt_marks*100)/$grand_courses_marks;
            $x->tot_gradepoint=$tot_gradepoint;
            $x->all_course_marks=$all_course_marks;
            $x->all_course_obt_marks=$all_course_obt_marks;
            if($tot_pass_status==true){
                $x->tot_fail_sub=0;
            }else{
                $x->tot_fail_sub=$tot_fail_sub;
            }
            $x->gpa=round(($tot_gradepoint)/$compalsary_subj,2);
        }
        foreach($students as $item){
            if($item->tot_pass_status==true){
                $item->grade_letter=$this->getGradeLetter($programofferid,$item->gpa);;
            }else{
                $item->grade_letter="F";
                $item->gpa=0;
            }
        }
        $students1=$students->where("tot_pass_status",TRUE)
        ->sortByDesc("tot_gradepoint")->sortByDesc("grand_tot_mark");
        $students2=$students->where("tot_pass_status",false)
        ->sortByDesc("tot_gradepoint")->sortByDesc("grand_tot_mark");
        $students=$students1->concat($students2);
        // dd($students);
        return $students;
    }
    public function getStudents($programofferid,$examnameid){
        $sql="SELECT 
        mem.programofferid,
        mem.examnameid,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        mem.studentid,
        students.applicantid,
        students.classroll
        FROM `mst_exam_marks` AS mem
        INNER JOIN students ON mem.studentid=students.id
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=? && mem.examnameid=? GROUP BY studentid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid]);
        $result=collect($qResult);
        return $result;
    }
    public function getCourses($programofferid,$examnameid,$studentid){
        $sql="SELECT 
        mem.programofferid,
        mem.examnameid,
        mem.examtypeid,
        mem.sectionid,
        mem.teacherid,
        mem.studentid,
        mem.coursecodeid,
    	course_codes.name AS courseCode,
        courses.name AS courseName,
        student_courses.coursetypeid,
        courseoffer.meargeid
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
  		 INNER JOIN course_codes ON mem.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=? && mem.examnameid=? && mem.studentid=? GROUP BY   mem.coursecodeid";
         $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid]);
         $result=collect($qResult);
         return $result;
    }
    public function getCourseOnMearge($programofferid,$examnameid,$studentid){
        $sql="SELECT 
        mem.programofferid,
        mem.examnameid,
        mem.examtypeid,
        mem.sectionid,
        mem.teacherid,
        mem.studentid,
        student_courses.coursetypeid,
        courseoffer.meargeid,
        md.passtypeid,
        sum(FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0)) AS categorymarks,
        sum(mem.marks) as obt_marks
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=? && mem.examnameid=? && mem.studentid=? && courseoffer.meargeid IS NOT NULL GROUP BY courseoffer.meargeid,md.passtypeid";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid]);
        $result=collect($qResult);
        return $result;
    }
    public function getMarkCategory($programofferid,$examnameid,$studentid,$coursecodeid){
        $sql="SELECT 
        mem.programofferid,
        mem.examnameid,
        mem.examtypeid,
        mem.sectionid,
        mem.teacherid,
        mem.studentid,
        mem.coursecodeid,
        mem.markcategoryid,
        mark_categories.name AS markcatName,
        md.passtypeid,
        FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0) AS categorymarks,
        mem.marks as obt_marks
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        INNER JOIN mark_categories on md.markcategoryid=mark_categories.id
        WHERE mem.programofferid=? && mem.examnameid=? && mem.studentid=? && mem.coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }

    public function getMstExamResultOnPOAndExax($programofferid,$examnameid){
        $resultSql="SELECT 
        mem.programofferid,
        mem.sectionid,
        mem.teacherid,
        mem.studentid,
        mem.coursecodeid,
        mem.examnameid,
        mem.examtypeid,
        mem.markcategoryid,
        student_courses.coursetypeid,
        md.passtypeid,
        courseoffer.meargeid,
        FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0) AS categorymarks,
        mem.marks as obt_marks
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=1 && mem.examnameid=1";
        $qResult=\DB::select($resultSql,[$programofferid,$examnameid]);
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
                return $point_letter_array[$i+1]["grade_letter"];
            }
        }
        return $point_letter_array[0]["grade_letter"];
    }
}