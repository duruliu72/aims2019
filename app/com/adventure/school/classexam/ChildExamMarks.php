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
    public function getStudents($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid){
        $sql="SELECT students.*,
        cxm.studentid,
        cxm.obt_marks,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        genders.name AS genderName,
        blood_groups.name AS bloodgroupName,
        religions.name AS religionName,
        nationalities.name AS nationalityName,
        quotas.name AS quotaName   
        FROM `students`
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        LEFT JOIN genders ON applicants.genderid=genders.id
        LEFT JOIN blood_groups ON applicants.bloodgroupid=blood_groups.id
        LEFT JOIN religions ON applicants.religionid=religions.id
        LEFT JOIN nationalities ON applicants.nationalityid=nationalities.id
        LEFT JOIN quotas ON applicants.`quotaid`=quotas.id
        LEFT JOIN child_exam_marks AS cxm ON cxm.programofferid=students.programofferid && cxm.sectionid=students.sectionid && cxm.studentid=students.id
        WHERE cxm.programofferid=? && cxm.sectionid=? && cxm.mst_examnameid=? && cxm.child_examnameid=? && cxm.coursecodeid=?";
        $qResult=\DB::select($sql,[$programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid]);
        $result=collect($qResult);
        $sql="SELECT table1.*,
        table2.studentid,
        table2.obt_marks
        FROM(SELECT * FROM `students` 
        WHERE programofferid=2 && sectionid=1) AS table1
        INNER JOIN(SELECT * FROM `child_exam_marks`
        WHERE programofferid=2 && sectionid=1 && mst_examnameid=1 && child_examnameid=2 && coursecodeid=1) AS table2
        ON table1.programofferid=table2.programofferid && table1.sectionid=table2.sectionid && table1.id=table2.studentid";
        return $result;
    }
}