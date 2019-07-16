<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class ChildExam extends Model
{
    protected $table="tbl_child_exam";
    protected $fillable = ['programofferid','mst_examnameid','child_examnameid','hld_marks','status'];
    public function checkChildExam($programofferid,$mst_examnameid,$child_examnameid){
        $sql="SELECT * FROM `tbl_child_exam`
        WHERE programofferid=? && mst_examnameid=? && child_examnameid=?";
        $qResult=\DB::select($sql,[$programofferid,$mst_examnameid,$child_examnameid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getChildExamOnPO($programofferid){
        $sql="SELECT exam_name.*
        FROM `tbl_child_exam`
        INNER JOIN exam_name ON tbl_child_exam.child_examnameid=exam_name.id
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        return $result;
    }
    public function getChildExam($programofferid,$mst_examnameid,$child_examnameid){
        $sql="SELECT * FROM `tbl_child_exam`
        WHERE programofferid=? && mst_examnameid=? && child_examnameid=?";
        $qResult=\DB::select($sql,[$programofferid,$mst_examnameid,$child_examnameid]);
        $result=collect($qResult)->first();
        return $result;
    }
    public function getChildExams(){
        $sql="SELECT 
        tbl_child_exam.*,
        sessions.name AS sessionName,
        programlevels.name AS levelName,
        programs.name AS programName,
        groups.name AS groupName,
        mediums.name AS mediumName,
        shifts.name AS shiftName,
        mst_table.name AS mstEaxmName,
        cild_table.name AS childExamName
        FROM `tbl_child_exam`
        INNER JOIN programoffers AS t1 ON t1.id=tbl_child_exam.programofferid
        INNER JOIN sessions ON t1.sessionid=sessions.id
        INNER JOIN programs ON t1.programid=programs.id
        INNER JOIN level_programs on programs.id=level_programs.programid
        INNER JOIN programlevels on level_programs.programlevelid=programlevels.id
        INNER JOIN groups ON t1.groupid=groups.id
        INNER JOIN mediums ON t1.mediumid=mediums.id
        INNER JOIN shifts ON t1.shiftid=shifts.id
        INNER JOIN exam_name AS mst_table ON tbl_child_exam.mst_examnameid=mst_table.id
        INNER JOIN exam_name AS cild_table ON tbl_child_exam.child_examnameid=cild_table.id
        ORDER BY sessionName DESC";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
        return $result;
    }
}
