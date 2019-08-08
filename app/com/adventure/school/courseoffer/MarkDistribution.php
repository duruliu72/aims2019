<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;

class MarkDistribution extends Model
{
    protected $table='mark_distribution';
    protected $fillable = ['programofferid','courseid','markcategoryid','mark_in_percentage','cat_hld_mark','percentage_mark','mark_group_id','status'];
    public function isThereMarkCategory($programofferid,$courseid,$markcategoryid){
        $sql="SELECT * FROM `mark_distribution` WHERE programofferid=? AND courseid=? AND markcategoryid=?";
        $qResult=\DB::select($sql,[$programofferid,$courseid,$markcategoryid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    //=================================
    public function getMarkDistributionOnProgramOffer($programofferid){
        $sql="SELECT * FROM `mark_distribution`
        WHERE mark_distribution.programofferid=? ORDER BY mark_distribution.courseid";
        $qResult=\DB::select($sql,[$programofferid]);
        return collect($qResult);
    }

    public function getCourseCategoryOnCourse($programofferid,$coursecodeid){
        $sql="SELECT 
        mark_categories.id,
        table1.programofferid,
        table1.courseid,
        table1.markcategoryid,
        table1.mark_in_percentage,
        table1.cat_hld_mark,
        table1.percentage_mark,
        @row_number:=CASE
            WHEN IFNULL(table1.	mark_group_id,0)=0 THEN mark_categories.id ELSE  table1.mark_group_id
        END AS 	mark_group_id
        FROM  mark_categories
        LEFT JOIN (SELECT * FROM `mark_distribution`
        WHERE mark_distribution.programofferid=? AND courseid=?  ORDER BY mark_distribution.courseid) AS table1
        ON mark_categories.id=table1.markcategoryid ORDER by mark_categories.id";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
        return collect($qResult);
    }
    public function checkMarkDistribution($programofferid,$coursecodeid){
        $sql="SELECT * FROM `mark_distribution`
        WHERE programofferid=? && courseid=?";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getMarkCategory($programofferid,$courseid){
        $sql="SELECT mark_categories.*,
        t1.categorymarks,
        t1.cat_hld_mark
        FROM `mark_categories`
                INNER JOIN (SELECT mark_distribution.* ,
        courseoffer.coursemark,
        FORMAT((courseoffer.coursemark*mark_distribution.mark_in_percentage)/100,0) as categorymarks
        FROM `mark_distribution`
        INNER JOIN courseoffer ON mark_distribution.programofferid=courseoffer.programofferid &&
        mark_distribution.courseid=courseoffer.courseid
        WHERE mark_distribution.programofferid=? && mark_distribution.courseid=?) as t1
                ON mark_categories.id=t1.markcategoryid";
        $qResult=\DB::select($sql,[$programofferid,$courseid]);
        return collect($qResult);
    }
    //=========================================
   
}