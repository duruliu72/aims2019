<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\exam\ChildExamCourse;
use App\com\adventure\school\exam\ChildExam;

class ChildExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childExamCrete(Request $request){
        $aProgramOffer=new ProgramOffer();
        $aChildExam=new ChildExam();
        $aMasterExam=new MasterExam();
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        if($request->isMethod('post')){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'masterexamid'=>'required',
                'examnameid'=>'required|',
                'cxm_in_percentage'=>'required'
            ]);
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $masterexamid=$request->masterexamid;
            $examnameid=$request->examnameid;
            $courseofferidList=$request->courseofferid;
            $marksList=$request->marks;
            $cxm_in_percentage=$request->cxm_in_percentage;
            if($request->btn=="save_btn"){
                $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
                $obj=new ChildExam();
                $master_exam_id=$obj->getMasterExamOnPOAndExamNameId($programofferid,$masterexamid);
                $obj->master_exam_id=$master_exam_id;
                $obj->examnameid=$examnameid;
                $obj->cxm_in_percentage=$cxm_in_percentage;
                $isTrue=$obj->hasItem($master_exam_id,$examnameid);
                if(!$isTrue){
                    $obj->save();
                    $last_id=$obj->getLastid();
                    foreach($courseofferidList as $courseofferid){
                        $aChildExamCourse=new ChildExamCourse();
                        $aChildExamCourse->child_exam_id=$last_id;
                        $aChildExamCourse->courseofferid=$courseofferid;
                        $aChildExamCourse->marks=$marksList[$courseofferid];
                        $aChildExamCourse->save();
                    }
                    $msg="Exam Created Successfully";
                    return redirect()->back()->with('msg',$msg);
                }else{
                    $msg="You aready created this exam";
                    return redirect()->back()->with('msg',$msg);
                }
            }
            if($request->btn=="update_btn"){
                $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
                $obj=ChildExam::findOrfail($request->hiddenid);
                $master_exam_id=$obj->getMasterExamOnPOAndExamNameId($programofferid,$masterexamid);
                $obj->master_exam_id=$master_exam_id;
                $obj->examnameid=$examnameid;
                $obj->cxm_in_percentage=$cxm_in_percentage;
                $isTrue=$obj->hasItem($master_exam_id,$examnameid);
                if(($master_exam_id==$obj->master_exam_id&&$examnameid==$obj->examnameid)||!$isTrue){
                    $obj->Update();
                    $msg="Updated this exam";
                }else{
                    $msg="You aready created this exam";
                }
                return redirect()->back()->with('msg',$msg);
            }
        }
        $aList=ChildExam::getAllChild();
        $masterExamNameList=ChildExam::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $bean=null;
        $courseofferList=null;
        if($request->id!=null){
            ChildExam::findOrfail($request->id);
            $bean=ChildExam::getChildExam($request->id);
            $programofferid=ChildExam::getProgramofferidOnChildExamId($request->id);
            $aChildExamCourse=new ChildExamCourse();
            $courseofferList=$aChildExamCourse->getAllCoursesOnChildExam($request->id);
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'courseofferList'=>$courseofferList,
            'pList'=>$pList,
            'result'=>$aList,
            'editBean'=>$bean
        ];
        return view('admin.exam.childexam.childexamcreate',$dataList);
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
