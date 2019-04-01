<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class VLevelProgram extends Model
{
    protected $table="vlevel_programs";
	protected $fillable = ['programlevelid','programid','status'];
	public function getAllGroupsOnProgram(){
		$sql="SELECT vlevel_programs.*,
		programlevels.name AS levelName,
		programs.name AS programName
		FROM `vlevel_programs`
		INNER JOIN programlevels ON vlevel_programs.programlevelid=programlevels.id
		INNER JOIN programs ON vlevel_programs.programid=programs.id";
		$result=\DB::select($sql);
		return $result;
	}
	public function checkValue($programid){
		$sql="SELECT * FROM `vlevel_programs`
		WHERE programid=?";
		$result=\DB::select($sql,[$programid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	public function checkValueforUpdate($programlevelid,$programid){
		$sql="SELECT * FROM `vlevel_programs`
		WHERE programlevelid=? AND programid=?";
		$result=\DB::select($sql,[$programlevelid,$programid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	public function getLevelByProgram($programid){
		$sql="SELECT  programlevels.*
		FROM `vlevel_programs` AS t1
		INNER JOIN programlevels ON t1.programlevelid=programlevels.id
		INNER JOIN programs ON t1.programid=programs.id WHERE t1.programid=?";
		$result=\DB::select($sql,[$programid]);
		return $result;
	}
	
}
