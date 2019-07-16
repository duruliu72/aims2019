<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\exam\ChildExam;
use App\com\adventure\school\classexam\ChildExamResult;
use App\com\adventure\school\classexam\MstExamResult;

class ChildExamResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childExamResults(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
         // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam=new MasterExam();
        $aChildExam=new ChildExam();
        $aMstExamResult=new MstExamResult();
        $aChildExamResult=new ChildExamResult();
        $programofferinfo=null;
        $child_result=null;
        $programofferid=0;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'groupid' => 'required|',
                'mst_examnameid'=>'required|',
                'child_examnameid'=>'required|'
            ]);
            $programid=$request->programid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $groupid=$request->groupid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            //   Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            // Check Master Exam Create Or Not
            $checkMaterExam=$aMasterExam->hasItem($programofferid,$mst_examnameid);
            if(!$checkMaterExam){
                $msg="Maser Exam is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Child Exam Create Or Not
            $checkChildExam=$aChildExam->checkChildExam($programofferid,$mst_examnameid,$child_examnameid);
            if(!$checkChildExam){
                $msg="Child Exam is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $child_result=$aChildExamResult->getChildExamResult($programofferid,$mst_examnameid,$child_examnameid);
        }
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $masterExamNameList=ExamName::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'programofferinfo'=>$programofferinfo,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'child_result'=>$child_result,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.child_exam_result.child_results',$dataList);
    }
    // public function childExamResult(){
    //     return view('admin.classexam.child_exam_result.child_result',$dataList);
    // }
    // For Ajax Call ===============
    //    ================================================================
    public function getValue(Request $request){
        $option=$request->option;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        if($option=="program"){
            if($methodid==1){
                $this->getAllOnIDS(0,$programid,0,0,0,"mediums",'mediumid');
            }elseif($methodid==2){
                $this->getAllOnIDS(0,$programid,0,0,0,"shifts",'shiftid');
            }elseif($methodid==3){
                $this->getAllOnIDS(0,$programid,0,0,0,"groups",'groupid');
            }
        }elseif($option=="group"){
            if($methodid==1){
                $this->getMasterExam(0,$programid,$groupid,$mediumid,$shiftid);
            }elseif($methodid==2){
                $this->getChildExam(0,$programid,$groupid,$mediumid,$shiftid);
            }
        }elseif($option=="medium"){
            if($methodid==1){
                $this->getAllOnIDS(0,$programid,0,$mediumid,0,"shifts",'shiftid');
            }elseif($methodid==2){
                $this->getAllOnIDS(0,$programid,0,$mediumid,0,"groups",'groupid');
            }
        }elseif($option=="shift"){
            if($methodid==1){
                $this->getAllOnIDS(0,$programid,0,$mediumid,$shiftid,"groups",'groupid');
            }
        }
    }
    private function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMasterExam($sessionid,$programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $aMasterExam=new MasterExam();
        $masterExamNameList=$aMasterExam->getMasterExamOnPO($programofferid);
        $output="<option value=''>SELECT</option>";
        foreach($masterExamNameList as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getChildExam($sessionid,$programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $aChildExam=new ChildExam();
        $childExamNameList=$aChildExam->getChildExamOnPO($programofferid);
        $output="<option value=''>SELECT</option>";
        foreach($childExamNameList as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
