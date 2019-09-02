<?php

namespace App\com\adventure\school\courseoffer;
use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;

class CourseOffer extends Model
{
    protected $table='courseoffer';
    protected $fillable = ['programofferid','courseid','coursemark','meargeid','mearge_name','status'];
    // ===========================
    public function checkCouseOffer($programofferid,$courseid){
        $sql="SELECT * FROM `courseoffer`
        WHERE programofferid=? && courseid=?";
        $qResult=\DB::select($sql,[$programofferid,$courseid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
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
    public function getCourseOnProgramoffer($programofferid){
        $sql="SELECT courses.*,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name
        FROM courses
        INNER JOIN courseoffer ON courses.id=courseoffer.courseid
        WHERE courseoffer.programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
		return $result;
    }
    public function getCoursesOnProgramoffer($programofferid){
        $sql="SELECT courses.*,
        courseoffer.coursemark,
        courseoffer.meargeid,
        courseoffer.mearge_name
        FROM courses
        INNER JOIN courseoffer ON courses.id=courseoffer.courseid
        WHERE courseoffer.programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
		return $result;
    }
    public function getMdCourseOnProgramOffer($programofferid){
        $sql="SELECT
        courses.id,
        courses.courseName,
        courses.courseCode,
        courseoffer.coursemark,
        IFNULL(mark_distribution.courseid,0) AS mdcourseid
        FROM courseoffer
        INNER JOIN courses ON courseoffer.courseid=courses.id
        LEFT JOIN mark_distribution ON courseoffer.programofferid=mark_distribution.programofferid 
        AND courseoffer.courseid=mark_distribution.courseid
        WHERE courseoffer.programofferid=?  GROUP BY courseoffer.courseid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function getTotalCourses($programofferid){
        $sql="SELECT COUNT(courseid) AS tot_course FROM `courseoffer`
        WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult)->first();
        return $result->tot_course;
    }
    //============================
    // public function getOfferedCourses($programofferid){
    //     $sql="SELECT * FROM courseoffer
    //     WHERE programofferid=?";
    //     $qResult=\DB::select($sql,[$programofferid]);
    //     $result=collect($qResult);
    //     return $result;
    // }
    // public function isSameCourse($programofferid,$courseid){
    //     $sql="SELECT * FROM `courseoffer` WHERE programofferid=? AND coursecodeid=?";
    //     $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
    //     if(collect($qResult)->count()>0){
    //         return true;
    //     }
    //     return false;
    // }

    // public function getCourseCode($programofferid,$coursecodeid){
    //     $sql="SELECT 
    //     course_codes.* ,
    //     courses.name AS courseName,
    //     courseoffer.coursemark
    //     FROM `courseoffer`
    //     INNER JOIN course_codes on courseoffer.coursecodeid=course_codes.id
    //     INNER JOIN courses ON course_codes.courseid=courses.id
    //     WHERE programofferid=? && coursecodeid=?";
    //     $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
    //     $courseCode=collect($qResult)->first();
    //     return $courseCode;
    // }
    // public function getCourseMarks($programofferid,$coursecodeid){
    //     $sql="SELECT
    //     course_codes.* ,
    //     courses.name AS courseName,
    //     co.coursemark,
    //     SUM(md.cat_hld_mark) AS tot_hld_mark
    //     FROM `courseoffer` AS co
    //     INNER JOIN mark_distribution as md 
    //     ON co.programofferid=md.programofferid  && co.coursecodeid=md.coursecodeid
    //     INNER JOIN course_codes on co.coursecodeid=course_codes.id
    //     INNER JOIN courses ON course_codes.courseid=courses.id
    //     WHERE co.programofferid=? && co.coursecodeid=? GROUP BY co.coursecodeid";
    //     $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
    //     $courseCode=collect($qResult)->first();
    //     return $courseCode;
    // }
    // public function getCoursesOnProgramOffer($programofferid){
    //     $sql="SELECT 
    //     course_codes.id,
    //     courses.name as courseName,
    //     course_codes.name as courseCode,
    //     CONCAT(courses.name,' (',course_codes.name,')') AS courseNameWithCode
    //     FROM `courseoffer`
    //     INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
    //     INNER JOIN courses ON course_codes.courseid=courses.id
    //     WHERE programofferid=?";
    //     $qResult=\DB::select($sql,[$programofferid]);
    //     return collect($qResult);
    // }
     // +++++++++++++++++++
    //  public function getCourseCodes($sessionid){
    //     if($sessionid==0){
	// 		$yearName = date('Y');
	//     	$aSession=new Session();
	//     	$sessionid=$aSession->getSessionId($yearName);
	// 	}
    //     $sql="SELECT
    //     course_codes.id,
    //     CONCAT(courses.name,' (',course_codes.name,')') AS name
    //     FROM `courseoffer`
    //     INNER JOIN course_codes ON courseoffer.coursecodeid=course_codes.id
    //     INNER JOIN courses ON course_codes.courseid=courses.id
    //     INNER JOIN programoffers ON courseoffer.programofferid=programoffers.id
    //     WHERE programoffers.sessionid=? GROUP BY course_codes.id";
    //     $qResult=\DB::select($sql,[$sessionid]);
    //     return collect($qResult);
    // }
    
    // public function getMinimumCourses($programofferid){
    //     $sql="SELECT 
    //     COUNT(coursecodeid) num_of_courses
    //     FROM `courseoffer`
    //     WHERE programofferid=?";
    //     $qResult=\DB::select($sql,[$programofferid]);
    //     $result=collect($qResult)->first();
    //     return $result->num_of_courses;
    // }
    // ========================For Dorpdown ==============
	public function getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
		$sql="SELECT t2.* FROM `programoffers` AS t1
        INNER JOIN(SELECT programofferid FROM `courseoffer` GROUP BY programofferid) AS co ON t1.id=co.programofferid
        INNER JOIN ".$tableName." AS t2 ON t1.".$compareid."=t2.id ";
		$data=array();
		if($sessionid!=0){
			$sql.=" WHERE sessionid=?";
			array_push($data,$sessionid);
		}
		if($programlabelid!=0){
			$sql.=" AND t1.programlabelid=?";
			array_push($data,$programlabelid);
		}
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
}