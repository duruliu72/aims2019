<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class MasterExam extends Model
{
    protected $table="master_exam";
    protected $fillable = ['programofferid','examnameid','exhld_mark_in_percentage','mxm_in_percentage','with_child','status'];

    public static function getAllMaster(){
        $sql="SELECT mxm.*,
        CASE
            WHEN mxm.with_child=1 THEN mxm.mxm_in_percentage-IFNULL(cxm.cxm_in_percentage,0)
            WHEN mxm.with_child=2 THEN mxm.mxm_in_percentage
        END AS differ_mxm_in_percentage
        FROM(SELECT 
                mex.id,
                mex.programofferid,
                sessions.name AS sessionName,
                programlevels.name AS levelName,
                programs.name AS programName,
                groups.name AS groupName,
                mediums.name AS mediumName,
                shifts.name AS shiftName,
                exn.name AS examName,
                mex.exhld_mark_in_percentage,
                mex.mxm_in_percentage,
                mex.with_child
                FROM `master_exam` AS mex
                INNER JOIN programoffers AS po ON mex.programofferid=po.id
                INNER JOIN exam_name AS exn ON mex.examnameid=exn.id
                INNER JOIN sessions ON po.sessionid=sessions.id
                INNER JOIN programs ON po.programid=programs.id
                INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
                INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
                INNER JOIN groups ON po.groupid=groups.id
                INNER JOIN mediums ON po.mediumid=mediums.id
                INNER JOIN shifts ON po.shiftid=shifts.id
                ORDER BY mex.id) AS mxm
                LEFT JOIN (SELECT
        child_exam.master_exam_id,
        SUM(child_exam.cxm_in_percentage) AS cxm_in_percentage
        FROM `child_exam` GROUP BY child_exam.master_exam_id) AS cxm ON mxm.id=cxm.master_exam_id";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
        return $result;
    }
    public static function getMasterExamId($id){
        $sql="SELECT 
        mex.*,
        po.sessionid,
        po.programid,
        po.groupid,
        po.mediumid,
        po.shiftid
        FROM `master_exam` AS mex
        INNER JOIN programoffers AS po ON mex.programofferid=po.id
        WHERE mex.id=?";
        $qResult=\DB::select($sql,[$id]);
        $result=collect($qResult)->first();
        return $result;
    }
    public function getMasterExamOnPOAndExamNameId($programofferid,$examnameid){
        $sql="SELECT * FROM `master_exam`
        WHERE programofferid=? && examnameid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid]);
        $result=collect($qResult)->first();
        return $result;
    }
    public function hasItem($programofferid,$examnameid){
        $sql="SELECT * FROM `master_exam`
        WHERE programofferid=? && examnameid=?";
        $qResult=\DB::select($sql,[$programofferid,$examnameid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}
