<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\MasterExam;
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
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam =new MasterExam();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $programofferinfo=null;
        $exam_result=null;
        $exam=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $programid=$request->programid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $groupid=$request->groupid;
            $examnameid=$request->examnameid;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$examnameid);
            if(!$checkMasterExam){
                $msg="Plese SetUp Master Exam";
                return redirect()->back()->with('msg',$msg);
            }
            $exam_result=$aMstExamResult->getMstExamResult($programofferid,$examnameid);
            // dd($exam_result);
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            // dd($programofferinfo);
            $exam=$aExamName->getExamONID($examnameid);
            //  dd($exam);
        }
        
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $examNameList=$aExamName->getExamName(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'examNameList'=>$examNameList,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'exam_result'=>$exam_result,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstexamresult',$dataList);
    }
    public function mstSingleResult($programofferid,$examnameid,$studentid){
        $aMstExamResult=new MstExamResult();
        $student=$aMstExamResult->getSingleResult($programofferid,$examnameid,$studentid);
        dd($student);
    }
}
