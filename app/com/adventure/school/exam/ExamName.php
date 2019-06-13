<?php

namespace App\com\adventure\school\exam;

use Illuminate\Database\Eloquent\Model;

class ExamName extends Model
{
    protected $table="exam_name";
    protected $fillable = ['name','examtypeid','status'];
    public static function getAll(){
        $sql="SELECT id,name,
        CASE WHEN examtypeid=1 THEN 'Master' 
        WHEN examtypeid=2 THEN 'Child' 
        END AS examtypeName
        FROM exam_name";
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
    public function getExamONID($id){
        $sql="SELECT * FROM `exam_name`
        WHERE id=?";
        $qResult=\DB::select($sql,[$id]);
        $exam=collect($qResult)->first();
        return $exam;
    }
    public function getExamNameOnProgramOffer($programofferid,$examtypeid){
        $sql="SELECT exam_name.*,
        master_exam.programofferid
        FROM `master_exam`
        INNER JOIN exam_name ON master_exam.examnameid=exam_name.id
        WHERE master_exam.programofferid=? && exam_name.examtypeid=? GROUP BY exam_name.id";
        $qResult=\DB::select($sql,[$programofferid,$examtypeid]);
        return collect($qResult);
    }
}
