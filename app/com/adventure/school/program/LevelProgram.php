<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class LevelProgram extends Model
{
    protected $table="level_programs";
	protected $fillable = ['programlevelid','programid','status'];
	public function getLevelPrograms(){
		$sql="SELECT level_programs.*,
		programlevels.name AS levelName,
		programs.name AS programName
		FROM `level_programs`
		INNER JOIN programlevels ON level_programs.programlevelid=programlevels.id
		INNER JOIN programs ON level_programs.programid=programs.id";
		$result=\DB::select($sql);
		return $result;
	}
	public function getLevelOnProgram($programid){
		$sql="SELECT  programlevels.*
		FROM `level_programs` AS t1
		INNER JOIN programlevels ON t1.programlevelid=programlevels.id
		INNER JOIN programs ON t1.programid=programs.id WHERE t1.programid=?";
		$result=\DB::select($sql,[$programid]);
		return $result;
	}
	public function getProgramOnLevel($programlevelid){
		$sql="SELECT 
		programs.* 
		FROM `level_programs` AS t1
		INNER JOIN programlevels ON t1.programlevelid=programlevels.id
		INNER JOIN programs ON t1.programid=programs.id
		WHERE programlevelid=?";
		$qResult=\DB::select($sql,[$programlevelid]);
		$result=collect($qResult);
		return $result;
	}
	public function checkValue($programid){
		$sql="SELECT * FROM `level_programs`
		WHERE programid=?";
		$result=\DB::select($sql,[$programid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	public function checkValueforUpdate($programlevelid,$programid){
		$sql="SELECT * FROM `level_programs`
		WHERE programlevelid=? AND programid=?";
		$result=\DB::select($sql,[$programlevelid,$programid]);
		if(count($result)!=0){
			return true;
		}
		return false;
	}
	
}
