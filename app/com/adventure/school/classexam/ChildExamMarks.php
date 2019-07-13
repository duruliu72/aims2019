<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class ChildExamMarks extends Model
{
    protected $table='child_exam_marks';
    protected $fillable = ['programofferid','sectionid','mst_examnameid','child_examnameid','studentid','coursecodeid','obt_marks','status'];
    public function checkMarkEntry($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$exam_no,$studentid,$coursecodeid){
        $sql="SELECT * FROM child_exam_marks
        WHERE programofferid=? && sectionid=? && mst_examnameid=? && child_examnameid=? && studentid=? && coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$mst_examnameid,$child_examnameid,$exam_no,$studentid,$coursecodeid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}
