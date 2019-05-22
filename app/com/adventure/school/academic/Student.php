<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected  $table='students';
    protected $fillable = ['programofferid','sectionid','applicantid','classroll','fromclass','fromsection','studenttype','status'];
    public function getLastID(){
        $sql="SELECT * FROM `students` ORDER BY id DESC";
        $qresult=\DB::select($sql);
        $aStudent=collect($qresult)->first();
        return $aStudent->id;
    }
    public function checkStudent($programofferid,$applicantid){
        $sql="SELECT * FROM `students`
        WHERE programofferid=? && applicantid=?";
        $qresult=\DB::select($sql,[$programofferid,$applicantid]);
        $result=collect($qresult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}