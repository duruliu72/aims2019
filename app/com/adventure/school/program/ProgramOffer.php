<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class ProgramOffer extends Model
{
    protected $table='programoffers';
    protected $fillable = ['sessionid','programid','groupid','mediumid','shiftid','cordinator','seat','status'];
    public function getAllProgramOffer(){
    	$sql="SELECT t1.*,
			sessions.name AS sessionName,
			programs.name AS programName,
			groups.name AS groupName,
			mediums.name AS mediumName,
			shifts.name AS shiftName,
			CONCAT(employees.first_name,' ',employees.middle_name,' ',employees.last_name) AS cordinatorName
			FROM `programoffers` AS t1
			INNER JOIN sessions ON t1.sessionid=sessions.id
			INNER JOIN programs ON t1.programid=programs.id
			INNER JOIN groups ON t1.groupid=groups.id
			INNER JOIN mediums ON t1.mediumid=mediums.id
			INNER JOIN shifts ON t1.shiftid=shifts.id
			INNER JOIN employees ON t1.cordinator=employees.id";
		$result=\DB::select($sql);
		return $result;
		}
		public function getProgramOfferinfo($programofferid){
				$sql="SELECT 
				t1.*,
				sessions.name AS sessionName,
				programlevels.name AS levelName,
				programs.name AS programName,
				groups.name AS groupName,
				mediums.name AS mediumName,
				shifts.name AS shiftName,
				CONCAT(employees.first_name,' ',employees.middle_name,' ',employees.last_name) AS cordinatorName
				FROM `programoffers` AS t1
				INNER JOIN sessions ON t1.sessionid=sessions.id
				INNER JOIN programs ON t1.programid=programs.id
				INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
				INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
				INNER JOIN groups ON t1.groupid=groups.id
				INNER JOIN mediums ON t1.mediumid=mediums.id
				INNER JOIN shifts ON t1.shiftid=shifts.id
				INNER JOIN employees ON t1.cordinator=employees.id
				WHERE t1.id=?";
				$qresult=\DB::select($sql,[$programofferid]);
				$result=collect($qresult)->first();
				return $result;
		}
    public function getProgramOnLevel(){
    	$sql="SELECT t1.* ,
		programlevels.name AS levelName,
		programs.id,
		programs.name
		FROM `vlevel_programs` AS t1
		INNER JOIN programlevels ON t1.programlevelid=programlevels.id
		INNER JOIN programs ON t1.programid=programs.id";
		$result=\DB::select($sql);
		return $result;
    }
    public function getGroupOnProgramByID($programid){
    	$sql="SELECT groups.*
		FROM `vprogram_groups` AS t1
		INNER JOIN programs ON t1.programid=programs.id
		INNER JOIN groups ON t1.groupid=groups.id
        WHERE programid=?";
        $result=\DB::select($sql,[$programid]);
		return $result;
    }
    public function checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid){
		$sql="SELECT * FROM `programoffers`
		WHERE sessionid=? AND programid=? AND groupid=?  AND mediumid=? AND shiftid=?";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid,$shiftid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	public function getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid){
		$sql="SELECT * FROM `programoffers`
		WHERE sessionid=? AND programid=? AND groupid=?  AND mediumid=? AND shiftid=?";
		$qresult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid,$shiftid]);
		$result = collect($qresult);
		if($result->isNotEmpty()){
			$programofferid=$result->first()->id;
			return $programofferid;
		}
		return 0;
	}
	public function getAllProgram($sessionid){
		$sql="SELECT programs.*
		FROM `programoffers` AS t1
		INNER JOIN programs ON  t1.programid=programs.id
		WHERE t1.sessionid=? GROUP BY programs.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllMedium($sessionid){
		$sql="SELECT mediums.*
		FROM `programoffers` AS t1
		INNER JOIN mediums ON  t1.mediumid=mediums.id
		WHERE t1.sessionid=? GROUP BY mediums.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllShift($sessionid){
		$sql="SELECT shifts.*
		FROM `programoffers` AS t1
		INNER JOIN shifts ON  t1.shiftid=shifts.id
		WHERE t1.sessionid=? GROUP BY shifts.id";
		$result=\DB::select($sql,[$sessionid]);
		return $result;
	}
	public function getAllGroup($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  groups.*
		FROM `programoffers` AS t1
		INNER JOIN groups ON t1.groupid=groups.id
		WHERE t1.sessionid=? AND t1.programid=? GROUP BY groups.id";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	// ========================================================================
	public function getGroup($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  groups.*
		FROM `programoffers` AS t1
		INNER JOIN groups ON t1.groupid=groups.id
		WHERE t1.sessionid=? AND t1.programid=? GROUP BY groups.id";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getMedium($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  mediums.*
		FROM `programoffers` AS t1
		INNER JOIN mediums ON t1.mediumid=mediums.id
		WHERE t1.sessionid=? AND t1.groupid=? GROUP BY mediums.id";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getShift($sessionid,$programid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  shifts.*
		FROM `programoffers` AS t1
		INNER JOIN shifts ON t1.shiftid=shifts.id
		WHERE t1.sessionid=? AND t1.mediumid=? GROUP BY shifts.id";
		$result=\DB::select($sql,[$sessionid,$programid]);
		return $result;
	}
	public function getMediumWithProgram($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  mediums.*
		FROM `programoffers` AS t1
		INNER JOIN mediums ON t1.mediumid=mediums.id
		WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY mediums.id";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getShiftWithProgram($sessionid,$programid,$groupid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  shifts.*
		FROM `programoffers` AS t1
		INNER JOIN shifts ON t1.shiftid=shifts.id
		WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? GROUP BY shifts.id";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid]);
		return $result;
	}
	public function getShiftWithProgramAndGroup($sessionid,$programid,$groupid,$mediumid){
		if($sessionid==0){
			$yearName = date('Y');
	    	$aSession=new Session();
	    	$sessionid=$aSession->getSessionId($yearName);
		}
		$sql="SELECT  shifts.*
		FROM `programoffers` AS t1
		INNER JOIN shifts ON t1.shiftid=shifts.id
		WHERE t1.sessionid=? AND t1.programid=? AND t1.groupid=? and t1.mediumid=? GROUP BY shifts.id";
		$result=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
		return $result;
	}
	public function getProgramofferDetails($programofferid){
		$sql="SELECT
		programoffers.id,
		sessions.name AS sessionName,
		programlevels.name AS levelName,
		programs.name AS programName,
		groups.name AS groupName,
		mediums.name AS mediumName,
		shifts.name AS shiftName
		FROM `programoffers`
		INNER JOIN sessions ON programoffers.sessionid=sessions.id
		INNER JOIN programs ON programoffers.programid=programs.id
		INNER JOIN vlevel_programs on programs.id=vlevel_programs.programid
		INNER JOIN programlevels on vlevel_programs.programlevelid=programlevels.id
		INNER JOIN groups ON programoffers.groupid=groups.id
		INNER JOIN mediums ON programoffers.mediumid=mediums.id
		INNER JOIN shifts ON programoffers.shiftid=shifts.id
		WHERE programoffers.id=?
		ORDER BY programoffers.id";
		$qresult=\DB::select($sql,[$programofferid]);
		$result=collect($qresult)->first();
		return $result;
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
			FROM `programoffers`
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
			FROM `programoffers`
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
			FROM `programoffers`
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
			FROM `programoffers`
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
			FROM `programoffers`
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
			FROM `programoffers`
			INNER JOIN shifts ON programoffers.shiftid=shifts.id 
			WHERE programoffers.sessionid=? AND programoffers.programid=? AND programoffers.groupid=? AND programoffers.mediumid=? GROUP BY shifts.id";
			$qResult=\DB::select($sql,[$sessionid,$programid,$groupid,$mediumid]);
			return collect($qResult);
	}
}
