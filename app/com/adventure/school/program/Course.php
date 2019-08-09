<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";
    protected $fillable = ['name','courseName','courseCode','programlabelid','status'];
    public function getCourses(){
        $sql="SELECT 
        courses.*,
        pl.name AS programLabel
        FROM `courses`
        INNER JOIN plabels AS pl ON courses.programlabelid=pl.id";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
		return $result;
    }
    public function getCourse($id){
        $sql="SELECT * FROM `courses`
        WHERE id=?";
   		$qResult=\DB::select($sql,[$id]);
		$course=collect($qResult)->first();
		return $course;
    }
    public function getCourseOnProgramoffer($programlabelid,$programofferid,$join){
        $sql="SELECT c_table.*,
        co_table.courseid,
        co_table.coursemark
        FROM(SELECT * FROM `courses`
        WHERE programlabelid=?) AS c_table
        ".$join." JOIN (SELECT * FROM `courseoffer`
        WHERE programofferid=?) AS co_table ON c_table.id=co_table.courseid";
        $qResult=\DB::select($sql,[$programlabelid,$programofferid]);
        $result=collect($qResult);
		return $result;
    }
}
