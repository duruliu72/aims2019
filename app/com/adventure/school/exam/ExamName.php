<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class ExamName extends Model
{
    protected $table="exam_name";
    protected $fillable = ['name','examptypeid','status'];
    public static function getAll(){
        $sql="SELECT id,name,
        CASE WHEN examtypeid=1 THEN 'Master' 
        WHEN examtypeid=2 THEN 'Child' 
        END AS examtypeName
        FROM `exam_name`";
        $qresult=\DB::select($sql);
        $result=collect($qresult);
        return $result;
    }
    public static function getExamName($examtypeid){
        $sql="SELECT * FROM `exam_name` WHERE examtypeid=?";
        $qResult=\DB::select($sql,[$examtypeid]);
        $result=collect($qResult);
        return $result;
    }
}
