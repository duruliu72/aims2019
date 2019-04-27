<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\menu\Menu;
class MasterExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function masterExamCrete(Request $request){
        $instituteName=Institute::getInstituteName();
        $aProgramOffer=new ProgramOffer();
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('masterexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('masterexam');
        if($request->isMethod('post')){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'examnameid'=>'required|',
                'markinpercentage'=>'required'
            ]);
            $sessionid=$request->sessionid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $examnameid=$request->examnameid;
            $markinpercentage=$request->markinpercentage;
            $with_child=$request->with_child;
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            if($request->btn=="save_btn"){
                if($programofferid==0){
                    $msg="This Program Offer has not creared yet";
                    return redirect()->back()->with('msg',$msg);
                }
                $obj=new MasterExam();
                $obj->programofferid=$programofferid;
                $obj->examnameid=$examnameid;
                $obj->exhld_mark_in_percentage=$markinpercentage;
                $obj->mxm_in_percentage=100;
                $obj->with_child=$with_child;
                $isTrue=$obj->hasItem($programofferid,$examnameid);
                if(!$isTrue){
                    $obj->save();
                }else{
                    $msg="You aready created this exam";
                    return redirect()->back()->with('msg',$msg);
                }
            }elseif($request->btn=="update_btn"){
                $obj=MasterExam::findOrfail($request->id1);
                $obj->programofferid=$programofferid;
                $obj->examnameid=$examnameid;
                $obj->exhld_mark_in_percentage=$markinpercentage;
                $obj->with_child=$with_child;
                $isTrue=$obj->hasItem($programofferid,$examnameid);
                if(($obj->programofferid==$programofferid&&$obj->examnameid==$examnameid)||!$isTrue){
                    $obj->Update();
                    $msg="Updated this exam";
                }else{
                    $msg="You aready created this exam";
                }
                return redirect()->back()->with('msg',$msg);
            }
        }
        $aList=MasterExam::getAllMaster();
        $programList=$aProgramOffer->getProgramsOnSession(0);
        $groupList=$aProgramOffer->getGroupsOnSession(0);
        $mediumList=$aProgramOffer->getMediumsOnSession(0);
        $shiftList=$aProgramOffer->getShiftsOnSession(0);
        $masterExamNameList=ExamName::getExamName(1);
        $bean=null;
        if($request->id!=null){
            $editObj=MasterExam::findOrfail($request->id);
            $bean=MasterExam::getMasterExamId($request->id);
        }
        $dataList=[
            'instituteName'=>$instituteName,
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'masterExamNameList'=>$masterExamNameList,
            'pList'=>$pList,
            'result'=>$aList,
            'editObj'=>$bean,
        ];
        return view('admin.exam.masterexam.masterexamcreate',$dataList);
    }
     // For Ajax Call ===============
     public function getValue(Request $request){
        $option=$request->option;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        if($option=="program"){
            if($methodid==1){
                $this->getGroupsOnSessionAndProgram($programid);
            }elseif($methodid==2){
                $this->getMediumsOnSessionAndProgram($programid);
            }elseif($methodid==3){
                $this->getShiftsOnSessionAndProgram($programid);
            }
        }elseif($option=="group"){
            if($methodid==1){
                $this->getMediumsOnSessionAndPrograAndGroup($programid,$groupid);
            }elseif($methodid==2){
                $this->getShiftsOnSessionAndPrograAndGroup($programid,$groupid);
            }
        }elseif($option=="medium"){
            if($methodid==1){
                $this->getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid);
            }
        }
    }
    private function getGroupsOnSessionAndProgram($programid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getGroupsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndProgram($programid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getMediumsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndProgram($programid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getShiftsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
