<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\ProgramOffer;
class MeargeOffer extends Model
{
    public function meargeDetails(){
        $sql="SELECT 
        courseoffer.id,
        courseoffer.programofferid,
        CONCAT(sessions.name,'--',programs.name,'--',groups.name,'--',mediums.name,'--',shifts.name) AS programdetails,
        SUM(courseoffer.coursemark) AS total_coursemark,
        mearges.name AS meargeName,
        GROUP_CONCAT(courses.name SEPARATOR ', ') AS meargeCourseName,
        GROUP_CONCAT(course_codes.id SEPARATOR ',') AS meargeCourseCodeid,
        GROUP_CONCAT(course_codes.name SEPARATOR ', ') AS meargeCourseCode,
        courseoffer.meargeid
        FROM `courseoffer`
        INNER JOIN mearges ON courseoffer.meargeid=mearges.id
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
          GROUP BY courseoffer.programofferid, courseoffer.meargeid ORDER BY courseoffer.programofferid,course_codes.name";
        $qResult=\DB::select($sql);
        return collect($qResult);
    }
    public function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
        if($sessionid==0){
            $yearName = date('Y');
            $aSession=new Session();
            $sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT t2.* 
        FROM `courseoffer` AS t1
        INNER JOIN programoffers ON t1.programofferid=programoffers.id
        INNER JOIN ".$tableName." AS t2 ON programoffers.".$compareid."=t2.id WHERE sessionid=?";
        $data=array();
        array_push($data,$sessionid);
        if($programid!=0){
            $sql.=" AND programid=?";
            array_push($data,$programid);
        }
        if($groupid!=0){
            $sql.=" AND groupid=?";
            array_push($data,$groupid);
        }
        if($mediumid!=0){
            $sql.=" AND mediumid=?";
            array_push($data,$mediumid);
        }
        if($shiftid!=0){
            $sql.=" AND shiftid=?";
            array_push($data,$shiftid);
        }
        $sql.=" GROUP BY t2.id";
        $qResult=\DB::select($sql,$data);
        $result=collect($qResult);
        return $result;
    }	
    public function getCourseCodes($sessionid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT
        course_codes.id,
        CONCAT(courses.name,' (',course_codes.name,')') AS name
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        WHERE programoffers.sessionid=? GROUP BY course_codes.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    public function getCourseCodesOnProgramOffer($sessionid,$programid,$groupid,$mediumid,$shiftid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
        }
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $sql="SELECT
        course_codes.id,
        CONCAT(courses.name,' (',course_codes.name,')') AS name
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        WHERE programoffers.id=? GROUP BY course_codes.id";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
}
