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
    public function getCoursesOnProgramOffer($programofferid){
        $sql="SELECT 
        courseoffer.coursecodeid,
        CONCAT(courses.name,' (',course_codes.name,')') AS courseNameWithCode
        FROM `courseoffer`
        INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
        INNER JOIN courses ON course_codes.courseid=courses.id
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
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
    public function hasCourseAssign($programofferid){
        $sql="SELECT * FROM `courseoffer`
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
        FROM `courseoffer`
        INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
        INNER JOIN ".$tableName." AS t2 ON programoffers.".$compareid."=t2.id 
        WHERE programoffers.sessionid=?";
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