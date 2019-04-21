<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\ChildExam;

class ChildExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childExamCrete(Request $request){
        $instituteName=Institute::getInstituteName();
        $aProgramOffer=new ProgramOffer();
        $aChildExam=new ChildExam();
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
                'markinpercentage'=>'required'
            ]);
            $sessionid=$request->sessionid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $masterexamid=$request->masterexamid;
            $examnameid=$request->examnameid;
            $markinpercentage=$request->markinpercentage;
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $master_exam_id=$aChildExam->getMasterExamOnPOAndExamNameId($programofferid,$masterexamid);
            $obj=new ChildExam();
        }
        $aList=ChildExam::getAllChild();
        $programList=$aChildExam->getProgramsOnSession(0);
        $groupList=$aChildExam->getGroupsOnSession(0);
        $mediumList=$aChildExam->getMediumsOnSession(0);
        $shiftList=$aChildExam->getShiftsOnSession(0);
        $masterExamNameList=ChildExam::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $bean=null;
        $dataList=[
            'instituteName'=>$instituteName,
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'pList'=>$pList,
            'result'=>$aList,
            'editObj'=>$bean
        ];
        return view('admin.exam.childexam.childexamcreate',$dataList);
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
        }elseif($option=="shift"){
            if($methodid==1){
                $this->getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid);
            }
        }
    }
    private function getGroupsOnSessionAndProgram($programid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getGroupsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndProgram($programid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getMediumsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndProgram($programid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getShiftsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
        $aChildExam=new ChildExam();
        $result=$aChildExam->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
        $aChildExam=new ChildExam();
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $result=$aChildExam->getExamNameOnProgramOffer($programofferid,1);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
