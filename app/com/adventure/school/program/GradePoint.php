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
    public function hasValue($programofferid){
        $sql="SELECT * FROM `grade_point` WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
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
    public function getGradePointNLetter($programofferid){
        $sql="SELECT grade_point.programofferid,
        grade_letter.name,
        grade_point.from_mark,
        grade_point.to_mark,
        grade_point.gradepoint
        FROM `grade_point`  
        INNER JOIN grade_letter ON grade_point.gradeletterid=grade_letter.id
        WHERE grade_point.programofferid=? ORDER BY gradepoint DESC";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function getGradePointTable($programofferid){
        $sql="SELECT * 
        FROM(SELECT grade_point.programofferid,
        grade_letter.name,
        grade_point.from_mark,
        grade_point.to_mark,
        grade_point.gradepoint
        FROM `grade_point`  
        INNER JOIN grade_letter ON grade_point.gradeletterid=grade_letter.id
        WHERE grade_point.programofferid=?) AS gradeletter
        GROUP BY gradepoint DESC";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
}
