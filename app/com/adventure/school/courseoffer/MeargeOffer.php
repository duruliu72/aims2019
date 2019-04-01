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
        WHERE meargeid NOT  IN (0,1)  GROUP BY courseoffer.programofferid, courseoffer.meargeid ORDER BY courseoffer.programofferid,course_codes.name";
        $qResult=\DB::select($sql);
        return collect($qResult);
    }
    public function getProgramsOnSession($sessionid){
        $sql="SELECT programs.* 
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN programs ON programoffers.programid=programs.id WHERE programoffers.sessionid=? GROUP BY programs.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    public function getGroupsOnSession($sessionid){
        $sql="SELECT groups.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN groups ON programoffers.groupid=groups.id WHERE programoffers.sessionid=? GROUP BY groups.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    public function getMediumsOnSession($sessionid){
        $sql="SELECT mediums.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id WHERE programoffers.sessionid=? GROUP BY mediums.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    public function getShiftsOnSession($sessionid){
        $sql="SELECT shifts.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id WHERE programoffers.sessionid=? GROUP BY shifts.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
    }
    // =========================
    public function getGroupsOnSessionAndProgram($sessionid,$programid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT groups.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        WHERE programoffers.sessionid=? AND programoffers.programid=? GROUP BY groups.id";
        $qResult=\DB::select($sql,[$sessionid,$programid]);
        return collect($qResult);
    }
    public function getMediumsOnSessionAndProgram($sessionid,$programid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT mediums.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id 
        WHERE programoffers.sessionid=? AND programoffers.programid=? GROUP BY mediums.id";
        $qResult=\DB::select($sql,[$sessionid,$programid]);
        return collect($qResult);
    }
    public function getShiftsOnSessionAndProgram($sessionid,$programid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT shifts.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id 
        WHERE programoffers.sessionid=? AND programoffers.programid=? GROUP BY shifts.id";
        $qResult=\DB::select($sql,[$sessionid,$programid]);
        return collect($qResult);
    }
    // =================================
    public function getMediumsOnSessionAndPrograAndGroup($sessionid,$programid,$groupid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT mediums.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id 
        WHERE programoffers.sessionid=? AND programoffers.programid=? AND programoffers.groupid=? GROUP BY mediums.id";
        $qResult=\DB::select($sql,[$sessionid,$programid,$groupid]);
        return collect($qResult);
    }
    public function getShiftsOnSessionAndPrograAndGroup($sessionid,$programid,$groupid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT shifts.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id 
        WHERE programoffers.sessionid=? AND programoffers.programid=? AND programoffers.groupid=? GROUP BY shifts.id";
        $qResult=\DB::select($sql,[$sessionid,$programid,$groupid]);
        return collect($qResult);
    }
    // ============================================
    public function getShiftsOnSessionAndPrograAndGroupAndMedium($sessionid,$programid,$groupid,$mediumid){
        if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
        $sql="SELECT shifts.*
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id 
        WHERE programoffers.sessionid=? AND programoffers.programid=? AND programoffers.groupid=? AND programoffers.mediumid=? GROUP BY shifts.id";
        $qResult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
        return collect($qResult);
    }
    // +++++++++++++++++++
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
