<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\ProgramOffer;
class MeargeOffer extends Model
{
    public function meargeDetails(){
        $result=$this->getProgramoffer();
        foreach($result as $x){
            $meargeidList=$this->getMeargeid($x->programofferid);
            foreach($meargeidList as $y){
                $x->meargesubjects[$y->meargeid]=$this->meargeSubjects($x->programofferid,$y->meargeid);
            }
        }
        return $result;        
    }
    public function getProgramoffer(){
        $sql="SELECT courseoffer.programofferid,
        sessions.name AS sessionName,
        programs.name AS programName,
        groups.name AS groupName,
        mediums.name AS mediumName,
        shifts.name AS shiftName
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id
        INNER JOIN courses ON courseoffer.courseid=courses.id
        INNER JOIN (SELECT 
        programofferid,
        meargeid  
        FROM `courseoffer`
        GROUP BY programofferid,meargeid HAVING COUNT(courseoffer.meargeid)>1) AS tbl_mearge
        ON courseoffer.programofferid=tbl_mearge.programofferid && courseoffer.meargeid=tbl_mearge.meargeid GROUP BY courseoffer.programofferid";
        $qResult=\DB::select($sql);
        return collect($qResult);
    }
    public function getMeargeid($programofferid){
        $sql="SELECT courseoffer.meargeid
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id
        INNER JOIN courses ON courseoffer.courseid=courses.id
        INNER JOIN (SELECT 
        programofferid,
        meargeid  
        FROM `courseoffer`
        GROUP BY programofferid,meargeid HAVING COUNT(courseoffer.meargeid)>1) AS tbl_mearge
        ON courseoffer.programofferid=tbl_mearge.programofferid && courseoffer.meargeid=tbl_mearge.meargeid WHERE courseoffer.programofferid=? GROUP BY courseoffer.meargeid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function meargeSubjects($programofferid,$meargeid){
        $sql="SELECT courseoffer.courseid,
        courses.courseName,
        courses.courseCode
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id
        INNER JOIN courses ON courseoffer.courseid=courses.id
        INNER JOIN (SELECT 
        programofferid,
        meargeid  
        FROM `courseoffer`
        GROUP BY programofferid,meargeid HAVING COUNT(courseoffer.meargeid)>1) AS tbl_mearge
        ON courseoffer.programofferid=tbl_mearge.programofferid && courseoffer.meargeid=tbl_mearge.meargeid
        WHERE courseoffer.programofferid=? && courseoffer.meargeid=?";
        $qResult=\DB::select($sql,[$programofferid,$meargeid]);
        return collect($qResult);
    }
    // =========================
    public function getCourses($programofferid){
        $sql="SELECT
        courseoffer.*,
        courses.courseName,
        courses.courseCode
        FROM `courseoffer`
        INNER JOIN courses ON courseoffer.courseid=courses.id
        WHERE courseoffer.programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    // ============================
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
