<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table="groups";
    protected $fillable = ['name','status'];
    public static function getGroupsOnProgram(){
        $sql="SELECT 
        groups.*
        FROM `vprogram_groups`
        INNER JOIN groups ON vprogram_groups.groupid=groups.id
        GROUP BY vprogram_groups.groupid";
        $qresul=\DB::select($sql);
        $result=collect($qresul);
        return $result;
    }
    public static function getGroupsOnProgramID($programid){
        $sql="SELECT 
        groups.*
        FROM `vprogram_groups`
        INNER JOIN groups ON vprogram_groups.groupid=groups.id
        WHERE vprogram_groups.programid=?";
        $qresul=\DB::select($sql,[$programid]);
        $result=collect($qresul);
        return $result;
    }
}
