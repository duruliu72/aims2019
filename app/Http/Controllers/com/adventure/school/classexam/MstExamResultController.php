<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\classexam\MstExamResult;
use App\com\adventure\school\classexam\MstExamResult1;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\program\GradePoint;
class MstExamResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mstexamresult(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
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
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
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
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstexamresult',$dataList);
    }
    public function mstSingleResult($programofferid,$examnameid,$studentid){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $student=$aMstExamResult->getSingleResult($programofferid,$examnameid,$studentid);
        // dd($student);
        $exam=$aExamName->getExamONID($examnameid);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter($programofferid);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'point_letters'=>$point_letters,
            'student'=>$student,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstsingleresult',$dataList);
    }
    // ================================
    public function mstSingleResult1($programofferid,$examnameid,$studentid){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMstExamResult=new MstExamResult();
        $aMstExamResult1=new MstExamResult1();
        $aExamName=new ExamName();
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $student=$aMstExamResult1->getSingleResult($programofferid,$examnameid,$studentid);
        // dd($student);
        $exam=$aExamName->getExamONID($examnameid);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointNLetter($programofferid);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'point_letters'=>$point_letters,
            'student'=>$student,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstsingleresult1',$dataList);
    }
    public function mstexamresult1(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam =new MasterExam();
        $aMstExamResult=new MstExamResult();
        $aMstExamResult1=new MstExamResult1();

        $aExamName=new ExamName();
        $programofferinfo=null;
        $exam_result=null;
        $exam_result_copy=null;
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
            $exam_result_copy=$aMstExamResult1->getMstExamResult($programofferid,$examnameid);
            // dd($exam_result);
            //  dd($exam_result_copy);
            // dd($exam_result_copy->where("applicantid",19100003));
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
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
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
            "exam_result_copy"=>$exam_result_copy,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstexamresult_copy',$dataList);
    }
}
