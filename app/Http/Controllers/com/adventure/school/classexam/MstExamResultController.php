<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\courseoffer\CourseOffer;
class MstExamResultController extends Controller
{
    public function mstexamresult(Request $request){
        $aCourseOffer=new CourseOffer();
        $courseList=$aCourseOffer->getOfferedCourses(1);
        dd($courseList);
    }
}
