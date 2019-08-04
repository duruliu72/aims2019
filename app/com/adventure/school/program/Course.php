<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";
    protected $fillable = ['name','courseName','courseCode','programlavelid','status'];
    public function getCourses(){
        $sql="SELECT 
        courses.*,
        pl.name AS programLabel
        FROM `courses`
        INNER JOIN programlevels AS pl ON courses.programlabelid=pl.id";
        $qResult=\DB::select($sql);
        $result=collect($qResult);
		return $result;
    }
}
