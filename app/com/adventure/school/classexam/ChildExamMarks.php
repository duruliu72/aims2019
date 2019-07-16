<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;

class ChildExamMarks extends Model
{
    protected $table='child_exam_marks';
    protected $fillable = ['programofferid','sectionid','mst_examnameid','child_examnameid','studentid','coursecodeid','obt_marks','status'];
    public function checkMarkEntry($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$studentid,$coursecodeid){
        $sql="SELECT * FROM child_exam_marks
        WHERE programofferid=? && sectionid=? && mst_examnameid=? && child_examnameid=? && studentid=? && coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$mst_examnameid,$child_examnameid,$studentid,$coursecodeid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
    public function getStudents($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid,$join="LEFT"){
        $sql="SELECT table1.*,
        table2.studentid,
        table2.obt_marks,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        genders.name AS genderName,
        blood_groups.name AS bloodgroupName,
        religions.name AS religionName,
        nationalities.name AS nationalityName,
        quotas.name AS quotaName   
        FROM(SELECT * FROM `students` 
        WHERE programofferid=? && sectionid=?) AS table1
        ".$join." JOIN(SELECT * FROM `child_exam_marks`
        WHERE programofferid=? && sectionid=? && mst_examnameid=? && child_examnameid=? && coursecodeid=?) AS table2
        ON table1.programofferid=table2.programofferid && table1.sectionid=table2.sectionid && table1.id=table2.studentid
        INNER JOIN applicants ON table1.applicantid=applicants.applicantid
        LEFT JOIN genders ON applicants.genderid=genders.id
        LEFT JOIN blood_groups ON applicants.bloodgroupid=blood_groups.id
        LEFT JOIN religions ON applicants.religionid=religions.id
        LEFT JOIN nationalities ON applicants.nationalityid=nationalities.id
        LEFT JOIN quotas ON applicants.`quotaid`=quotas.id";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid]);
        $result=collect($qResult);
        return $result;
    }
}