<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\exam\ChildExam_Copy;

class ChildExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childExamCreate(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        // ======================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam=new MasterExam();
        $programoffer=null;
        if($request->isMethod('post')&& $request->btn_save=="btn_save"){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'mst_examnameid' => 'required|',
                'child_examnameid' => 'required|',
                'hld_marks' => 'required|',
            ]);
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            $hld_marks=$request->hld_marks;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            //Check Master Exam has been Created or Not on Programoffer
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $hasMasterExam=$aMasterExam->hasItem($programofferid,$mst_examnameid);
            if(!$hasMasterExam){
                $msg="This Master Exam is not exits";
                return redirect()->back()->with('msg',$msg);
            }
            $aChildExam=new ChildExam_Copy();
            $aChildExam->programofferid=$programofferid;
            $aChildExam->mst_examnameid=$mst_examnameid;
            $aChildExam->child_examnameid=$child_examnameid;
            $aChildExam->child_examnameid=$child_examnameid;
            $aChildExam->hld_marks=$hld_marks;
            $check_child_no=$aChildExam->checkChildExam($programofferid,$mst_examnameid,$child_examnameid);
            if(!$check_child_no){
                $status=$aChildExam->save();
                if($status){
                    $msg="Created successfully";
                }else{
                    $msg="not Created";
                }
            }else{
                $msg="This Child Exam already Exits";
            }
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $masterExamNameList=ExamName::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $aChildExam=new ChildExam_Copy();
        $child_exam_list=$aChildExam->getChildExams();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'child_exam_list'=>$child_exam_list,
            "msg"=>$msg,
        ];
        return view('admin.exam.childexam.childexamcreate',$dataList);
    }
    public function childExamEdit(Request $request,$id){
        $bean=ChildExam_Copy::findOrfail($id);
        // dd($bean);
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        // ======================
        $aProgramOffer=new ProgramOffer();
        $programoffer=$aProgramOffer->getProgramOffer($bean->programofferid);
        $bean->sessionid=$programoffer->sessionid;
        $bean->programid=$programoffer->programid;
        $bean->groupid=$programoffer->groupid;
        $bean->mediumid=$programoffer->mediumid;
        $bean->shiftid=$programoffer->shiftid;
        $aMasterExam=new MasterExam();
        $programoffer=null;
        if($request->isMethod('post')&& $request->btn_update=="btn_update"){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'mst_examnameid' => 'required|',
                'child_examnameid' => 'required|',
                'hld_marks' => 'required|',
            ]);
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            $hld_marks=$request->hld_marks;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            //Check Master Exam has been Created or Not on Programoffer
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $hasMasterExam=$aMasterExam->hasItem($programofferid,$mst_examnameid);
            if(!$hasMasterExam){
                $msg="This Master Exam is not exits";
                return redirect()->back()->with('msg',$msg);
            }
            $aChildExam=ChildExam_Copy::findOrfail($id);
            $aChildExam->programofferid=$programofferid;
            $aChildExam->mst_examnameid=$mst_examnameid;
            $aChildExam->child_examnameid=$child_examnameid;
            $aChildExam->child_examnameid=$child_examnameid;
            $aChildExam->hld_marks=$hld_marks;
            $childExamObj=$aChildExam->getChildExam($programofferid,$mst_examnameid,$child_examnameid);
            $check_child_Exam=$aChildExam->checkChildExam($programofferid,$mst_examnameid,$child_examnameid);
            if($check_child_Exam==false){
                $status=$aChildExam->update();
                if($status){
                    $msg="Update successfully";
                }
            }else{
                if($childExamObj->id==$id){
                    $status=$aChildExam->update();
                    if($status){
                        $msg="Update successfully";
                    }
                }else{
                    $msg="This Child Exam already Exits";
                }
                
            }
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $masterExamNameList=ExamName::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $aChildExam=new ChildExam_Copy();
        $child_exam_list=$aChildExam->getChildExams();
        // dd($bean);
        // dd($programList);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'child_exam_list'=>$child_exam_list,
            'bean'=>$bean,
            "msg"=>$msg,
        ];
        return view('admin.exam.childexam.childexamedit',$dataList);
    }
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
                $this->getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid);
            }elseif($methodid==2){
                $this->getAllCourses($programid,$groupid,$mediumid,$shiftid);
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
        }elseif($option=="child_examname"){
            if($methodid==1){
                $this->getAllO(0,$programid,0,$mediumid,$shiftid,"groups",'groupid');
            }
        }
    }
    private function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
        $aMasterExam=new MasterExam();
        $result=$aMasterExam->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllCourses($programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $aChildExamCourse=new ChildExamCourse();
        $result=$aChildExamCourse->getAllCourses($programofferid);
        $output="";
        $sino=0;
        foreach($result as $x){
            $sino++;
            $output.="<tr>";
            $output.="<td>".$sino."<input type='hidden' name='courseofferid[$x->id]' value=".$x->id."></td>";
            $output.="<td>".$x->courseName."</td>";
            $output.="<td>".$x->courseCode."</td>";
            $output.="<td ><input  class=form-control' type='text' name='marks[$x->id]' value='10'></td>";
            $output.="</tr>";
        }
        echo  $output;
    }
    
    private function getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
        $aExamName=new ExamName();
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $result=$aExamName->getExamNameOnProgramOffer($programofferid,1);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
