<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\academic\Student;

class MstExamMarks extends Model
{
    protected $table='mst_exam_marks';
    protected $fillable = ['programofferid','sectionid','teacherid','studentid','examnameid','examtypeid','coursecodeid','markcategoryid','marks','status'];
    public function getStudentsOnClsNSec($programofferid,$sectionid,$coursecodeid,$examnameid,$join){
        $sql="SELECT 
        std.*,
        IFNULL(rmem.studentid,0) AS studentid,
        IFNULL(rmem.coursecodeid,0) AS coursecodeid,
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
        mem.teacherid,
        mem.studentid,
        mem.coursecodeid,
        mem.examnameid,
        mem.examtypeid
        FROM `mst_exam_marks` AS mem
        WHERE programofferid=? && sectionid=? && coursecodeid=? && examnameid=?
        GROUP BY studentid) as rmem ON std.programofferid=rmem.programofferid && std.sectionid=rmem.sectionid && std.id=rmem.studentid";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$programofferid,$sectionid,$coursecodeid,$examnameid]);
        $students=collect($qResult);
        foreach($students as $std){
            $std->markList=$this->getCatMarks($std->programofferid,$std->sectionid,$std->coursecodeid,$std->examnameid,$std->studentid);
        }
        return $students;
    }
    public function getCatMarks($programofferid,$sectionid,$coursecodeid,$examnameid,$studentid){
        $sql="SELECT
        t1.markcategoryid AS markcatid,
        t2.*
        FROM(SELECT * FROM `mark_distribution`
        WHERE programofferid=? && coursecodeid=?) AS t1
        LEFT JOIN (SELECT * FROM `mst_exam_marks`
                WHERE programofferid=? && sectionid=? && coursecodeid=? && examnameid=? && studentid=?) AS t2
                ON t1.programofferid=t2.programofferid && t1.coursecodeid=t2.coursecodeid && t1.markcategoryid=t2.markcategoryid";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid,$programofferid,$sectionid,$coursecodeid,$examnameid,$studentid]);
        $catsMarks=collect($qResult);
        return $catsMarks;
    }
    public function checkEntry($programofferid,$coursecodeid,$studentid,$markcategoryid){
        $sql="SELECT
        mstem.*
        FROM `mst_exam_marks` AS mstem
        WHERE programofferid=? && coursecodeid=? && studentid=? && markcategoryid=?";
        $qResult=\DB::select($sql,[$programofferid,$coursecodeid,$studentid,$markcategoryid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}
