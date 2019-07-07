<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class MasterExam extends Model
{
    protected $table="master_exam";
    protected $fillable = ['programofferid','examnameid','exhld_in_percentage','mxm_in_percentage','cxm_in_percentage','result_with_child','status'];
    public static function getAllMaster(){
        $sql="SELECT 
        mxm.id,
        mxm.programofferid,
        sessions.name AS sessionName,
        programlevels.name AS levelName,
        programs.name AS programName,
        groups.name AS groupName,
        mediums.name AS mediumName,
        shifts.name AS shiftName,
        exn.name AS examName,
        mxm.exhld_in_percentage,
        mxm.mxm_in_percentage,
        IFNULL(mxm.cxm_in_percentage,0) as cxm_in_percentage,
        mxm.result_with_child,
        CASE
            WHEN mxm.result_with_child=1 THEN mxm.mxm_in_percentage-IFNULL(mxm.cxm_in_percentage,0)
               WHEN mxm.result_with_child=2 THEN mxm.mxm_in_percentage
        END AS differ_mxm_in_percentage
        FROM `master_exam` AS mxm
        INNER JOIN programoffers AS po ON mxm.programofferid=po.id
        INNER JOIN exam_name AS exn ON mxm.examnameid=exn.id
        INNER JOIN sessions ON po.sessionid=sessions.id
        INNER JOIN programs ON po.programid=programs.id
        INNER JOIN level_programs on programs.id=level_programs.programid
        INNER JOIN programlevels on level_programs.programlevelid=programlevels.id
        INNER JOIN groups ON po.groupid=groups.id
        INNER JOIN mediums ON po.mediumid=mediums.id
        INNER JOIN shifts ON po.shiftid=shifts.id
        ORDER BY mxm.id";
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
    public function getMasterExamOnPO($programofferid){
        $sql="SELECT exam_name.* FROM `master_exam`
        INNER JOIN exam_name ON master_exam.examnameid=exam_name.id
        WHERE programofferid=? && exam_name.examtypeid=1";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
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
    public function hasMasterExam($programofferid){
        $sql="SELECT * FROM `master_exam`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    //===========================For Dorpdown ==============
	public function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
		if($sessionid==0){
			$yearName = date('Y');
			$aSession=new Session();
			$sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT t2.*
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN ".$tableName." AS t2 ON  t1.".$compareid."=t2.id
        WHERE t1.sessionid=?";
		$data=array();
		array_push($data,$sessionid);
		if($programid!=0){
			array_push($data,$programid);
			$sql.=" AND programid=?";
		}
		if($groupid!=0){
			array_push($data,$groupid);
			$sql.=" AND groupid=?";
		}
		if($mediumid!=0){
			array_push($data,$mediumid);
			$sql.=" AND mediumid=?";
		}
		if($shiftid!=0){
			array_push($data,$shiftid);
			$sql.=" AND shiftid=?";
		}
		$sql.=" GROUP BY t2.id";
		$qResult=\DB::select($sql,$data);
		$result=collect($qResult);
		return $result;
	}	
}
