<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected  $table='students';
    protected $fillable = ['programofferid','sectionid','applicantid','classroll','studenttype','status'];

    public function checkRegisterOrNot($programofferid,$applicantid){
        $sql="SELECT * FROM `applicants` WHERE programofferid=? AND applicantid=? AND studentregid IS NOT NULL";
        $qresult=\DB::select($sql,[$programofferid,$applicantid]);
        $result=collect($qresult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getLastID(){
        $sql="SELECT * FROM `students` ORDER BY id DESC";
        $qresult=\DB::select($sql);
        $aStudent=collect($qresult)->first();
        return $aStudent->id;
    }
    public function generateStudentRegID($programofferid){
        $hasStudentRedId=$this->checkStudentRegID($programofferid);
        if($hasStudentRedId){
            $sql="SELECT * FROM `students`
            WHERE programofferid=?  ORDER BY studentregid DESC";
            $qresult=\DB::select($sql,[$programofferid]);
            $aStudent=collect($qresult)->first();
            $studentregid=$aStudent->studentregid;
            $studentregid++;
            return $studentregid;
        }else{
            $sql="SELECT 
            concat(substr(sessions.name,3),programs.programsign,'0000') AS startpoint
            FROM `programoffers`
            INNER JOIN sessions ON programoffers.sessionid=sessions.id
            INNER JOIN programs ON programoffers.programid=programs.id
            WHERE programoffers.id=?";
            $qresult=\DB::select($sql,[$programofferid]);
            $startregid=collect($qresult)->first()->startpoint;
            $studentregid=(int)$startregid;
            $studentregid++;
            return $studentregid;
        }
    }
    public function checkStudentRegID($programofferid){
        $sql="SELECT * FROM `students` WHERE programofferid=?";
        $qresult=\DB::select($sql,[$programofferid]);
        $result=collect($qresult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}