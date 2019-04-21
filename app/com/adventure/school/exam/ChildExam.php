<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class ChildExam extends Model
{
    protected $table="child_exam";
    protected $fillable = ['name','status'];
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
    public static function getExamName($examtypeid){
        $sql="SELECT exam_name.* FROM `master_exam`
        INNER JOIN exam_name ON master_exam.examnameid=exam_name.id
        WHERE exam_name.examtypeid=? GROUP BY exam_name.id";
        $qResult=\DB::select($sql,[$examtypeid]);
        return collect($qResult);
    }
    public function getExamNameOnProgramOffer($programofferid,$examtypeid){
        $sql="SELECT exam_name.*,
        master_exam.programofferid
        FROM `master_exam`
        INNER JOIN exam_name ON master_exam.examnameid=exam_name.id
        WHERE master_exam.programofferid=? && exam_name.examtypeid=? GROUP BY exam_name.id";
        $qResult=\DB::select($sql,[$programofferid,$examtypeid]);
        return collect($qResult);
    }
    	// ===============================================For Dorpdown ==============
	public function getProgramsOnSession($sessionid){
        if($sessionid==0){
            $yearName = date('Y');
            $aSession=new Session();
            $sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT programs.*
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN programs ON  t1.programid=programs.id
        WHERE t1.sessionid=? GROUP BY programs.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
	}
	public function getGroupsOnSession($sessionid){
        if($sessionid==0){
            $yearName = date('Y');
            $aSession=new Session();
            $sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT groups.*
        FROM `programoffers` AS t1
        INNER JOIN groups ON  t1.groupid=groups.id
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        WHERE t1.sessionid=? GROUP BY groups.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
	}
	public function getMediumsOnSession($sessionid){
        if($sessionid==0){
            $yearName = date('Y');
            $aSession=new Session();
            $sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT mediums.*
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN mediums ON  t1.mediumid=mediums.id
        WHERE t1.sessionid=? GROUP BY mediums.id";
        $qResult=\DB::select($sql,[$sessionid]);
        return collect($qResult);
	}
	public function getShiftsOnSession($sessionid){
        if($sessionid==0){
            $yearName = date('Y');
            $aSession=new Session();
            $sessionid=$aSession->getSessionId($yearName);
        }
        $sql="SELECT shifts.*
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN shifts ON  t1.shiftid=shifts.id
        WHERE t1.sessionid=? GROUP BY shifts.id";
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
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN groups ON t1.groupid=groups.id
        WHERE t1.sessionid=? AND t1.programid=? GROUP BY groups.id";
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
        FROM `programoffers` as t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN mediums ON t1.mediumid=mediums.id 
        WHERE t1.sessionid=? AND t1.programid=? GROUP BY mediums.id";
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
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN shifts ON t1.shiftid=shifts.id 
        WHERE t1.sessionid=? AND t1.programid=? GROUP BY shifts.id";
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
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN mediums ON t1.mediumid=mediums.id 
        WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY mediums.id";
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
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN shifts ON t1.shiftid=shifts.id 
        WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY shifts.id";
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
        FROM `programoffers` AS t1
        INNER JOIN master_exam ON t1.id=master_exam.programofferid
        INNER JOIN shifts ON t1.shiftid=shifts.id 
        WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? AND t1.mediumid=? GROUP BY shifts.id";
        $qResult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
        return collect($qResult);
	}
}
