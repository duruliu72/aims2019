<?php

namespace App\com\adventure\school\courseoffer;
use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;

class CourseOffer extends Model
{
    protected $table='courseoffer';
    protected $fillable = ['programofferid','coursecodeid','coursemark','meargeid','status'];
    public function isSameCourse($programofferid,$coursecodeid){
        $sql="SELECT * FROM `courseoffer` WHERE programofferid=? AND coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
        // ==================================================================
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
    public function getCourseCodesOnProgramOffer($programofferid){
        $sql="SELECT
        course_codes.id,
        CONCAT(courses.name,' (',course_codes.name,')') AS name,
        courseoffer.coursemark,
        IFNULL(mark_distribution.coursecodeid,0) AS mcoursecodeid
        FROM courseoffer
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        LEFT JOIN mark_distribution ON courseoffer.programofferid=mark_distribution.programofferid 
        AND courseoffer.coursecodeid=mark_distribution.coursecodeid
        WHERE courseoffer.programofferid=?  GROUP BY courseoffer.coursecodeid ORDER BY  courseoffer.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }     
}


// $sql="SELECT
// course_codes.id,
// CONCAT(courses.name,' (',course_codes.name,')') AS name,
// courseoffer.coursemark,
// IFNULL(mark_distribution.coursecodeid,0) AS mcoursecodeid
// FROM courseoffer
// INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
// INNER JOIN courses ON course_codes.courseid=courses.id
// LEFT JOIN mark_distribution ON courseoffer.programofferid=mark_distribution.programofferid 
// AND courseoffer.coursecodeid=mark_distribution.coursecodeid
// WHERE courseoffer.programofferid=11  GROUP BY courseoffer.coursecodeid ORDER BY  courseoffer.coursecodeid";


// $sql="SELECT
//         course_codes.id,
//         CONCAT(courses.name,' (',course_codes.name,')') AS name,
//         courseoffer.coursemark
//         FROM `courseoffer`
//         INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
//         INNER JOIN courses ON course_codes.courseid=courses.id
//         INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
//         WHERE programoffers.id=? GROUP BY course_codes.id";
