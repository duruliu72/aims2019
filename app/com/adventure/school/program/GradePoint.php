<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class GradePoint extends Model
{
    protected $table="grade_point";
    protected $fillable = ['programofferid','gradeletterid','from_mark','to_mark','gradepoint','status'];
    public function checkValue($programofferid,$gradeletterid){
        $sql="SELECT * FROM `grade_point` WHERE programofferid=? AND gradeletterid=?";
        $qResult=\DB::select($sql,[$programofferid,$gradeletterid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    public function getGradeLetter($programofferid){
        $sql="SELECT t1.* ,
        IFNULL(t2.gradeletterid,0) AS gradeletterid,
        t2.from_mark,
        t2.to_mark,
        t2.gradepoint
        FROM `grade_letter` AS t1
        LEFT JOIN (SELECT * FROM grade_point WHERE grade_point.programofferid=?) AS t2 ON t1.id=t2.gradeletterid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function getEditedGradeLetter($programofferid){
        $sql="SELECT t1.* ,
        IFNULL(t2.gradeletterid,0) AS gradeletterid,
        t2.from_mark,
        t2.to_mark,
        t2.gradepoint
        FROM `grade_letter` AS t1
        INNER JOIN (SELECT * FROM grade_point WHERE grade_point.programofferid=?) AS t2 ON t1.id=t2.gradeletterid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
}
