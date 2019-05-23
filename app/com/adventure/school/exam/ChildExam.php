<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class ChildExam extends Model
{
    protected $table="child_exam";
    protected $fillable = ['master_exam_id','examnameid','cxm_in_percentage','status'];
    public static function getAllChild(){
        $sql="SELECT 
        child_exam.id,
        child_exam.master_exam_id,
        child_exam.examnameid,
        childexam.name AS childexamName,
        child_exam.cxm_in_percentage,
        master_exam.programofferid,
        sessions.name AS sessionName,
        programlevels.name AS levelName,
        programs.name AS programName,
        groups.name AS groupName,
        mediums.name AS mediumName,
        shifts.name AS shiftName,
        master_exam.examnameid AS masterexanameid,
        masterexam.name AS masterexamName
        FROM `child_exam`
        INNER JOIN master_exam ON child_exam.master_exam_id=master_exam.id
        INNER JOIN programoffers on master_exam.programofferid=programoffers.id
        INNER JOIN exam_name AS masterexam ON master_exam.examnameid=masterexam.id
        INNER JOIN exam_name AS childexam ON child_exam.examnameid=childexam.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
        INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
        return $result;
    }
    public static function getProgramofferidOnChildExamId($child_exam_id){
        $sql="SELECT master_exam.programofferid 
        FROM `child_exam`
        INNER JOIN master_exam ON master_exam_id=master_exam.id
        WHERE child_exam.id=?";
        $qResult=\DB::select($sql,[$child_exam_id]);
        $result=collect($qResult)->first();
        $programofferid=$result->programofferid;
        return $programofferid;
    }
    public function getLastid(){
        $sql="SELECT * FROM `child_exam` 
        ORDER BY id DESC";
        $qResult=\DB::select($sql);
        $result=collect($qResult)->first();
        $id=$result->id;
        return $id;
    }
    public static function getExamName($examtypeid){
        $sql="SELECT exam_name.* FROM `master_exam`
        INNER JOIN exam_name ON master_exam.examnameid=exam_name.id
        WHERE exam_name.examtypeid=? GROUP BY exam_name.id";
        $qResult=\DB::select($sql,[$examtypeid]);
        return collect($qResult);
    }
    public function hasItem($master_exam_id,$examnameid){
        $sql="SELECT * FROM `child_exam`
        WHERE master_exam_id=? && examnameid=?";
        $qResult=\DB::select($sql,[$master_exam_id,$examnameid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getMasterExamOnPOAndExamNameId($programofferid,$examnameid){
        $sql="SELECT * FROM `master_exam` 
        WHERE programofferid=? && examnameid=?";
         $qResult=\DB::select($sql,[$programofferid,$examnameid]);
         $result=collect($qResult)->first();
         $master_exam_id=$result->id;
         return $master_exam_id;
    }
    public static function getChildExam($id){
        $sql="SELECT
        cex.id,
        mex.examnameid AS mxm_examnameid,
        cex.examnameid AS cxm_examnameid,
        cex.cxm_in_percentage,
        po.sessionid,
        po.programid,
        po.groupid,
        po.mediumid,
        po.shiftid
        FROM `child_exam`  AS cex
        INNER JOIN master_exam AS mex ON cex.master_exam_id=mex.id
        INNER JOIN programoffers AS po ON mex.programofferid=po.id
        WHERE cex.id=?";
        $qResult=\DB::select($sql,[$id]);
        $result=collect($qResult)->first();
        return $result;
    }
}
