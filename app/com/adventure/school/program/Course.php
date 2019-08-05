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
}
