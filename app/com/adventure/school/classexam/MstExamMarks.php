<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\academic\Student;

class MstExamMarks extends Model
{
    protected $table='mst_exam_marks';
    protected $fillable = ['programofferid','sectionid','examnameid','examtypeid','studentid','courseid','coursetypeid','markcategoryid','mark_group_id','marks','status'];
    //=============================
    public function getStudentsOnClsNSec($programofferid,$sectionid,$courseid,$examnameid,$join){
        $sql="SELECT 
        std.*,
        IFNULL(rmem.studentid,0) AS studentid,
        IFNULL(rmem.courseid,0) AS courseid,
        IFNULL(rmem.examnameid,0) AS examnameid
        from(SELECT students.*,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        genders.name AS genderName
        FROM `students`
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        LEFT JOIN genders ON applicants.genderid=genders.id
        WHERE programofferid=? && sectionid=?) AS std
        ".$join." JOIN(SELECT 
        mem.programofferid,
        mem.sectionid,
        mem.studentid,
        mem.courseid,
        mem.examnameid,
        mem.examtypeid
        FROM `mst_exam_marks` AS mem
        WHERE programofferid=? && sectionid=? && courseid=? && examnameid=?
        GROUP BY studentid) as rmem ON std.programofferid=rmem.programofferid && std.sectionid=rmem.sectionid && std.id=rmem.studentid";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$programofferid,$sectionid,$courseid,$examnameid]);
        $students=collect($qResult);
        foreach($students as $std){
            $std->markList=$this->getCatMarks($std->programofferid,$std->sectionid,$std->courseid,$std->examnameid,$std->studentid);
        }
        return $students;
    }
    public function getCatMarks($programofferid,$sectionid,$courseid,$examnameid,$studentid){
        $sql="SELECT
        t1.markcategoryid AS markcatid,
        t2.*
        FROM(SELECT * FROM `mark_distribution`
        WHERE programofferid=? && courseid=?) AS t1
        LEFT JOIN (SELECT * FROM `mst_exam_marks`
                WHERE programofferid=? && sectionid=? && courseid=? && examnameid=? && studentid=?) AS t2
                ON t1.programofferid=t2.programofferid && t1.courseid=t2.courseid && t1.markcategoryid=t2.markcategoryid";
        $qResult=\DB::select($sql,[$programofferid,$courseid,$programofferid,$sectionid,$courseid,$examnameid,$studentid]);
        $catsMarks=collect($qResult);
        return $catsMarks;
    }
    public function checkEntry($programofferid,$courseid,$studentid,$markcategoryid){
        $sql="SELECT
        mstem.*
        FROM `mst_exam_marks` AS mstem
        WHERE programofferid=? && courseid=? && studentid=? && markcategoryid=?";
        $qResult=\DB::select($sql,[$programofferid,$courseid,$studentid,$markcategoryid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    //===========================================
}
