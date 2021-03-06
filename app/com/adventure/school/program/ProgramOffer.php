<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class ProgramOffer extends Model
{
    protected $table='programoffers';
    protected $fillable = ['sessionid','programlabelid','programid','groupid','mediumid','shiftid','cordinator','seat','number_of_courses','status'];
	//=====================================
	public function getProgramOffer($id){
			$sql="SELECT 
			t1.*,
			sessions.name AS sessionName,
            plabels.name AS programLabel,
			programs.name AS programName,
			groups.name AS groupName,
			mediums.name AS mediumName,
			shifts.name AS shiftName,
			employees.first_name,
			employees.middle_name,
			employees.last_name
			FROM `programoffers` AS t1
			INNER JOIN sessions ON t1.sessionid=sessions.id
            INNER JOIN plabels ON t1.programlabelid=plabels.id
			INNER JOIN programs ON t1.programid=programs.id
			INNER JOIN groups ON t1.groupid=groups.id
			INNER JOIN mediums ON t1.mediumid=mediums.id
			INNER JOIN shifts ON t1.shiftid=shifts.id
			LEFT JOIN employees ON t1.cordinator=employees.id
			WHERE t1.id=?";
			$qresult=\DB::select($sql,[$id]);
			$programoffer=collect($qresult)->first();
			return $programoffer;
		}
		public function getProgramOffers(){
			$sql="SELECT 
			t1.*,
			sessions.name AS sessionName,
            plabels.name AS programLabel,
			programs.name AS programName,
			groups.name AS groupName,
			mediums.name AS mediumName,
			shifts.name AS shiftName,
			employees.first_name,
			employees.middle_name,
			employees.last_name
			FROM `programoffers` AS t1
			INNER JOIN sessions ON t1.sessionid=sessions.id
            INNER JOIN plabels ON t1.programlabelid=plabels.id
			INNER JOIN programs ON t1.programid=programs.id
			INNER JOIN groups ON t1.groupid=groups.id
			INNER JOIN mediums ON t1.mediumid=mediums.id
			INNER JOIN shifts ON t1.shiftid=shifts.id
			LEFT JOIN employees ON t1.cordinator=employees.id
			ORDER BY t1.id DESC";
			$qResult=\DB::select($sql);
			$result=collect($qResult);
			return $result;
		}
		public function getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid){
			$sql="SELECT * FROM `programoffers`
			WHERE sessionid=? AND programlabelid=? AND programid=? AND groupid=?  AND mediumid=? AND shiftid=?";
			$qresult=\DB::select($sql,[$sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid]);
			$result = collect($qresult);
			if($result->isNotEmpty()){
				$programofferid=$result->first()->id;
				return $programofferid;
			}
			return 0;
		} 
    public function checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid){
			$sql="SELECT * FROM `programoffers`
			WHERE sessionid=? AND programlabelid=? AND programid=? AND groupid=?  AND mediumid=? AND shiftid=?";
			$result=\DB::select($sql,[$sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid]);
			if(count($result)!=0){
				return true;
			}
			return false;
	}

	// ========================For Dorpdown ==============
	public function getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
		$sql="SELECT t2.* FROM `programoffers` AS t1
		INNER JOIN ".$tableName." AS t2 
		ON t1.".$compareid."=t2.id";
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
