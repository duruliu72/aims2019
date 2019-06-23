<?php

namespace App\com\adventure\school\classexam;
use App\com\adventure\school\program\GradePoint;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\academic\Student;
use Illuminate\Database\Eloquent\Model;

class MstExamResult extends Model
{
    public function getMstExamResult($programofferid,$examnameid){
        $students=$this->getStudents(1,1);
        foreach($students as $x){
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
                        "passtypeid"=>$markcat->passtypeid,
                        "categorymarks"=>$markcat->categorymarks,
                        "obt_marks"=>$markcat->obt_marks
                    );
                    $tot_mark=$tot_mark+$markcat->obt_marks;
                    $tot_course_marks=$tot_course_marks+$markcat->categorymarks;
                    $point_letter=$this->getGradePoint($tot_mark);
                }
                $course_data[$y->coursecodeid]=array(
                    "coursecodeid"=>$y->coursecodeid,
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
            $grand_tot_mark=0;
            $tot_gradepoint=0;
            $collect_courses=collect($course_data);
            // dd($collect_courses);
            $group_courses11 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",1);
            foreach($group_courses11 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                }
                $grand_tot_mark=$grand_tot_mark+$item["tot_mark"];
                $tot_gradepoint=$tot_gradepoint+$item["gradepoint"];
            }
            $group_courses12 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",1)->groupBy("meargeid")->map(function($item,$key){
                $c["g_tot_mark"]=$item->sum("tot_mark");
                $c["g_tot_course_marks"]=$item->sum("tot_course_marks");
                $c["meargeid"]=$item[0]["meargeid"];
                $p=collect($c);
            });
            foreach($group_courses12 as $item){
                $comp=$item["g_tot_course_marks"]*33/100;
                if($item["g_tot_mark"]<$comp){
                    $tot_pass_status=false;
                }
                $point_letter=$this->getGradePoint($tot_mark);
                $gradepoint=$point_letter["gradepoint"];
                $tot_gradepoint=$tot_gradepoint+$gradepoint;
                $grand_tot_mark=$grand_tot_mark+$item["g_tot_mark"];
            }
            // dd($group_courses12);
            $group_courses21 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",2);
            foreach($group_courses21 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                }
                $grand_tot_mark=$grand_tot_mark+$item["tot_mark"];
                $tot_gradepoint=$tot_gradepoint+$item["gradepoint"];
            }
            $group_courses22 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",2)->groupBy("meargeid")->map(function($item,$key){
                $c["g_tot_mark"]=$item->sum("tot_mark");
                $c["g_tot_course_marks"]=$item->sum("tot_course_marks");
                $c["meargeid"]=$item[0]["meargeid"];
                $p=collect($c);
                return $p;
            });
            foreach($group_courses22 as $item){
                $comp=$item["g_tot_course_marks"]*33/100;
                if($item["g_tot_mark"]<$comp){
                    $tot_pass_status=false;
                }
                $point_letter=$this->getGradePoint($tot_mark);
                $gradepoint=$point_letter["gradepoint"];
                $tot_gradepoint=$tot_gradepoint+$gradepoint;
                $grand_tot_mark=$grand_tot_mark+$item["g_tot_mark"];
            }
            $group_courses31 = $collect_courses->where("meargeid","=",NULL)->where("coursetypeid","=",3);
            foreach($group_courses31 as $item){
                if($item["pass_status"]==false){
                    $tot_pass_status=false;
                }
                $grand_tot_mark=$grand_tot_mark+$item["tot_mark"];
                $tot_gradepoint=$tot_gradepoint+$item["gradepoint"];
            }
            $group_courses32 = $collect_courses->where("meargeid","!=",NULL)->where("coursetypeid","=",3)->groupBy("meargeid")->map(function($item,$key){
                $c["g_tot_mark"]=$item->sum("tot_mark");
                $c["g_tot_course_marks"]=$item->sum("tot_course_marks");
                $c["meargeid"]=$item[0]["meargeid"];
                $p=collect($c);
            });
            foreach($group_courses32 as $item){
                $comp=$item["g_tot_course_marks"]*33/100;
                if($item["g_tot_mark"]<$comp){
                    $tot_pass_status=false;
                }
                $point_letter=$this->getGradePoint($tot_mark);
                $gradepoint=$point_letter["gradepoint"];
                $tot_gradepoint=$tot_gradepoint+$gradepoint;
                $grand_tot_mark=$grand_tot_mark+$item["g_tot_mark"];
            }
            $x->course_array=$course_data;
            $x->tot_pass_status=$tot_pass_status;
            $x->grand_tot_mark=$grand_tot_mark;
            $x->tot_gradepoint=$tot_gradepoint;
        }
        dd($students);
        return $students;
    }
    public function getStudents($programofferid,$examnameid){
        $sql="SELECT 
        mem.programofferid,
        mem.examnameid,
        mem.studentid
        FROM `mst_exam_marks` AS mem
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
        student_courses.coursetypeid,
        courseoffer.meargeid
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
        WHERE mem.programofferid=? && mem.examnameid=? && mem.studentid=? GROUP BY   mem.coursecodeid";
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
        md.passtypeid,
        FORMAT((courseoffer.coursemark*md.distribution_mark)/100,0) AS categorymarks,
        mem.marks as obt_marks
        FROM `mst_exam_marks` AS mem
        INNER JOIN courseoffer ON mem.programofferid=courseoffer.programofferid && mem.coursecodeid=courseoffer.coursecodeid
        INNER JOIN student_courses ON mem.studentid=student_courses.studentid && mem.coursecodeid=student_courses.coursecodeid
        INNER JOIN mark_distribution as md on mem.programofferid=md.programofferid && mem.coursecodeid=md.coursecodeid && mem.markcategoryid=md.markcategoryid
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