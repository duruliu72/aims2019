<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\Session;
class SectionOffer extends Model
{
    protected $table='sectionoffer';
    protected $fillable = ['programofferid','sectionid','section_std_num','section_teacher','status'];

    public function isAssignSectionToProgramOffer($programofferid){
        $sql="SELECT * FROM `sectionoffer` WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        if(collect($qResult)->count()>0){
            return true;
        }
        return false;
    }
    public function getSectionOffers(){
        $sql="SELECT
        so.programofferid AS id,
        CONCAT(sessions.name,'--',programs.name,'--',groups.name,'--',mediums.name,'--',shifts.name) AS className,
        GROUP_CONCAT(CONCAT(sections.name,'(',so.section_student,')') SEPARATOR ', ') AS sectiondetails,
        GROUP_CONCAT(so.sectionid SEPARATOR ', ') AS sectionids,
        GROUP_CONCAT(so.section_student SEPARATOR ', ') AS section_students
        FROM (SELECT * FROM sectionoffer ORDER BY sectionoffer.sectionid DESC) AS so
        INNER JOIN sections ON so.sectionid=sections.id
        INNER JOIN programoffers ON so.programofferid=programoffers.id
        INNER JOIN sessions ON programoffers.sessionid=sessions.id
        INNER JOIN programs ON programoffers.programid=programs.id
        INNER JOIN groups ON programoffers.groupid=groups.id
        INNER JOIN mediums ON programoffers.mediumid=mediums.id
        INNER JOIN shifts ON programoffers.shiftid=shifts.id
        GROUP BY so.programofferid";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
		return $result;
    }
    public function getSectionOfferOnPO($programofferid){
        $sql="select sections.*,
        table1.programofferid,
        IFNULL(table1.sectionid,0) AS sectionid,
        table1.section_student FROM sections
        LEFT JOIN (SELECT sections.*,
                sectionoffer.programofferid,
                IFNULL(sectionoffer.sectionid,0) AS sectionid,
                sectionoffer.section_student
                FROM `sections`
                LEFT JOIN sectionoffer ON sectionoffer.sectionid=sections.id
                WHERE sectionoffer.programofferid =? OR sectionoffer.programofferid IS NULL ORDER BY sections.id) AS table1
                ON sections.id=table1.id";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
		return $result;
    }
    public function getSectionsOnPO($programofferid){
        $sql="SELECT 
        sections.*
        FROM `sections`
        INNER JOIN sectionoffer ON sectionoffer.sectionid=sections.id
        WHERE sectionoffer.programofferid =? ORDER BY sections.id";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
		return $result;
    }
    public function hasSectionAssign($programofferid){
        $sql="SELECT * FROM `sectionoffer` WHERE programofferid=?";
        $qResult=\DB::select($sql,[$programofferid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }    
}
