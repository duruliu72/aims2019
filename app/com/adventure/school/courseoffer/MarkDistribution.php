<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;

class MarkDistribution extends Model
{
    protected $table='mark_distribution';
    protected $fillable = ['programofferid','coursecodeid','markcategoryid','distribution_mark','passtypeid','status'];
    public function isThereMarkCategory($programofferid,$coursecodeid,$markcategoryid){
        $sql="SELECT * FROM `mark_distribution` WHERE programofferid=? AND coursecodeid=? AND markcategoryid=?";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid,$markcategoryid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    public function getMarkDistributionOnProgramOffer($programofferid){
        $sql="SELECT * FROM `mark_distribution`
        WHERE mark_distribution.programofferid=? ORDER BY mark_distribution.coursecodeid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }
    public function getCourseCategoryOnCourse($programofferid,$coursecodeid){
        $sql="SELECT 
        mark_categories.id,
        table1.programofferid,
        table1.coursecodeid,
        table1.markcategoryid,
        table1.distribution_mark,
        @row_number:=CASE
            WHEN IFNULL(table1.passtypeid,0)=0 THEN mark_categories.id ELSE  table1.passtypeid
        END AS passtypeid
        FROM  mark_categories
        LEFT JOIN (SELECT * FROM `mark_distribution`
        WHERE mark_distribution.programofferid=? AND coursecodeid=?  ORDER BY mark_distribution.coursecodeid) AS table1
        ON mark_categories.id=table1.markcategoryid ORDER by mark_categories.id";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
        return collect($qResult);
    }
}
