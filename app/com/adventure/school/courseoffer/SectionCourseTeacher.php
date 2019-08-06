<?php

namespace App\com\adventure\school\courseoffer;

use Illuminate\Database\Eloquent\Model;

class SectionCourseTeacher extends Model
{
    protected $table='section_course_teachers';
    protected $fillable = ['programofferid','sectionid','courseid','teacherid','status'];
}
