<?php

namespace App\com\adventure\school\classexam;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\GradePoint;

class MstExamResult extends Model
{
    public function getMstExamResult($programofferid,$examnameid){
        $students=$this->getStudents($programofferid,$examnameid);
        dd($students);
        return $students;
    }

    public function getStudents($programofferid,$examnameid){
        $sql="select 
        students.*,
        IFNULL(mxm.studentid,0) AS studentid
        from(SELECT 
        students.*,
        applicants.firstName,
        applicants.middleName,
        applicants.lastName,
        applicants.picture,
        applicants.signature
        FROM `students`
        INNER JOIN applicants ON students.applicantid=applicants.applicantid
        WHERE programofferid=?) AS students
        LEFT JOIN (SELECT programofferid, studentid FROM `mst_exam_marks`
        WHERE programofferid=? && examnameid=? GROUP BY studentid) AS mxm
        ON students.id=mxm.studentid";
        $qResult=\DB::select($sql,[$programofferid,$programofferid,$examnameid]);
        $result=collect($qResult);
        return $result;
    }
    public function getMarkOnCategory(){
        $sql="";
    }
}
