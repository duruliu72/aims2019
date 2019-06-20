<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\classexam\MstExamResult;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\courseoffer\CourseOffer;
class MstExamResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mstexamresult(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        /////////////
        // $aCourseOffer=new CourseOffer();
        // $courseList=$aCourseOffer->getOfferedCourses(1);
        $aMstExamResult=new MstExamResult();
        $exam_result=$aMstExamResult->getMstExamResult(1,1);
        $aProgramOffer=new ProgramOffer();
        $programofferinfo=$aProgramOffer->getProgramOffer(1);
        // dd($exam_result);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $aExamName=new ExamName();
        $examNameList=$aExamName->getExamName(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'examNameList'=>$examNameList,
            'programofferinfo'=>$programofferinfo,
            'exam_result'=>$exam_result,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstexamresult',$dataList);
    }
}
