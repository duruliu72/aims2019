<?php

namespace App\com\adventure\school\admission;

use Illuminate\Database\Eloquent\Model;

class AppStartEnd extends Model
{
    protected $table="app_start_end";
    protected $fillable = ['sessionid','app_startDate','app_endDate','examStartDate','exam_status','status'];
    public static function getAll(){
        $sql="SELECT 
        t1.*,
        sessions.name AS sessionName
        FROM `app_start_end` AS t1
        INNER JOIN sessions ON t1.sessionid=sessions.id";
        $qresult=\DB::select($sql);
        $result=collect($qresult);
        return $result;
    }
}
