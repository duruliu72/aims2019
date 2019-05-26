<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class ProgramGroup extends Model
{
    protected $table="program_groups";
	protected $fillable = ['programid','groupid','status'];
	public function getGroupsOnProgram(){
		$sql="SELECT program_groups.* ,
		programs.name AS programName,
		groups.name AS groupName
		FROM `program_groups`
		INNER JOIN programs ON program_groups.programid=programs.id
		INNER JOIN groups ON program_groups.groupid=groups.id ORDER BY programid";
		$result=\DB::select($sql);
		return $result;
	}
	public function getGroupOnProgram($programid){
    	$sql="SELECT groups.*
		FROM `program_groups` AS t1
		INNER JOIN programs ON t1.programid=programs.id
		INNER JOIN groups ON t1.groupid=groups.id
				WHERE programid=?";
		$result=\DB::select($sql,[$programid]);
		return $result;
    }
	public function checkValue($programid,$groupid){
		$sql="SELECT * FROM `program_groups`
		WHERE programid=? AND groupid=?";
		$result=\DB::select($sql,[$programid,$groupid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
}
