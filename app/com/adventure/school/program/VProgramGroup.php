<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class VProgramGroup extends Model
{
    protected $table="vprogram_groups";
	protected $fillable = ['programid','groupid','status'];
	public function getAllGroupsOnProgram(){
		$sql="SELECT vprogram_groups.* ,
		programs.name AS programName,
		groups.name AS groupName
		FROM `vprogram_groups`
		INNER JOIN programs ON vprogram_groups.programid=programs.id
		INNER JOIN groups ON vprogram_groups.groupid=groups.id ORDER BY programid";
		$result=\DB::select($sql);
		return $result;
	}
	public function checkValue($programid,$groupid){
		$sql="SELECT * FROM `vprogram_groups`
		WHERE programid=? AND groupid=?";
		$result=\DB::select($sql,[$programid,$groupid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
}
