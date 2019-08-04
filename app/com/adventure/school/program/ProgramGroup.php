<?php

namespace App\com\adventure\school\program;
use App\com\adventure\school\program\Program;
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
	// Add f
	public function getGroupsOnProgramid($programid,$join){
		$sql="SELECT groups.*,
		IFNULL(pg_table.groupid,0) AS groupid,
		pg_table.programid,
		pg_table.name AS programName
		FROM groups
		".$join." JOIN
		(select pg.*,
		 programs.name
		 FROM program_groups as pg
		INNER JOIN programs ON pg.programid=programs.id
		WHERE pg.programid=?) AS pg_table
		ON groups.id=pg_table.groupid";
		$qResult=\DB::select($sql,[$programid]);
		$result=collect($qResult);
		return $result;
	}
	public function displayProgram(){
		$aProgram=new Program();
		$programList=$aProgram->getPrograms();
		foreach($programList as $p){
			$p->groupList=$this->getGroupsOnProgramid($p->id,"INNER");
		}
		return $programList;
	}
}
