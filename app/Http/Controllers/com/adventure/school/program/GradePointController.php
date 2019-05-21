<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\GradePoint;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\GradeLetter;
use App\com\adventure\school\program\Session;
class GradePointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createGratePoint(Request $request){
        $msg="";
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gradepoint');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aProgramOffer=new ProgramOffer();
        $programofferinfo=null;
        $gradeList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->save_btn=='save_btn'){
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            if($request->programofferid!=null){
                $programofferid=$request->programofferid;
            }
            if(isset($request->checkbox) && $request->checkbox!=null && $request->save_btn=='save_btn'){
                $checkboxList=$request->checkbox;
                $gradeletteridList=$request->gradeletterid;
                $from_markList=$request->from_mark;
                $to_markList=$request->to_mark;
                $gradepointList=$request->gradepoint;
                foreach ($checkboxList as $key => $value) {
                    $gradeletterid=$gradeletteridList[$key];
                    $from_mark=$from_markList[$key];
                    $to_mark=$to_markList[$key];
                    $gradepoint=$gradepointList[$key];
                    if($from_mark!=null&&$to_mark!=null&&$gradepoint!=null){
                        $gradePointObj=new GradePoint();
                        $gradePointObj->programofferid=$programofferid;
                        $gradePointObj->gradeletterid=$gradeletterid;
                        $gradePointObj->from_mark=$from_mark;
                        $gradePointObj->to_mark=$to_mark;
                        $gradePointObj->gradepoint=$gradepoint;
                        if(!$gradePointObj->checkValue($programofferid,$gradeletterid)){
                            $gradePointObj->save();
                        }
                    }
                }
                $msg="Grate Point Save Successfuly";
            }elseif($request->checkbox==null&&$request->save_btn=='save_btn'){
                $msg="Select  Course";
            }
            $programofferinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $gradePointObj=new GradePoint();
            $gradeList=$gradePointObj->getGradeLetter($programofferid);
        }
        // sessionid,programid,groupid,mediumid,shiftid,tableName and $compaireid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'programofferinfo'=>$programofferinfo,
            'gradeList'=>$gradeList,
            'msg'=>$msg
        ];
        return view('admin.programsettings.gradepoint.create',$dataList);
    }
    public function editGratePoint(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gradepoint');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aProgramOffer=new ProgramOffer();
        $programofferinfo=null;
        $gradeList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->edit_btn=='edit_btn'){
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
            if($request->programofferid!=null){
                $programofferid=$request->programofferid;
            }
            if(isset($request->checkbox) && $request->checkbox!=null && $request->edit_btn=='edit_btn'){
                $checkboxList=$request->checkbox;
                $gradeletteridList=$request->gradeletterid;
                $from_markList=$request->from_mark;
                $to_markList=$request->to_mark;
                $gradepointList=$request->gradepoint;
                foreach ($checkboxList as $key => $value) {
                    $gradeletterid=$gradeletteridList[$key];
                    $from_mark=$from_markList[$key];
                    $to_mark=$to_markList[$key];
                    $gradepoint=$gradepointList[$key];
                    if($from_mark!=null&&$to_mark!=null&&$gradepoint!=null){
                        $gradePointObj=new GradePoint();
                        if($gradePointObj->checkValue($programofferid,$gradeletterid)){
                            \DB::table('grade_point')
                                ->where('programofferid',$programofferid)
                                ->where('gradeletterid',$gradeletterid)
                                ->update([
                                    'from_mark' => $from_mark,
                                    'to_mark'=>$to_mark,
                                    'gradepoint' => $gradepoint,
                                ]);
                        }
                    }
                }
                $msg="Grate Point Update Successfuly";
            }elseif($request->checkbox==null&&$request->save_btn=='edit_btn'){
                $msg="Select  Course";
            }
            $programofferinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $gradePointObj=new GradePoint();
            $gradeList=$gradePointObj->getEditedGradeLetter($programofferid);
        }
        // sessionid,programid,groupid,mediumid,shiftid,tableName and $compaireid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'programofferinfo'=>$programofferinfo,
            'gradeList'=>$gradeList,
            'msg'=>$msg
        ];
        return view('admin.programsettings.gradepoint.edit',$dataList);
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
            // if($methodid==1){
            //     $this->getMediumsOnSessionAndPrograAndGroup($programid,$groupid);
            // }elseif($methodid==2){
            //     $this->getShiftsOnSessionAndPrograAndGroup($programid,$groupid);
            // }
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

//  private function getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
//     $aProgramOffer=new ProgramOffer();
//     $result=$aProgramOffer->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
//      $output="<option value=''>SELECT</option>";
//      foreach($result as $x){
//         $output.="<option value='$x->id'>$x->name</option>";
//      }
//      echo  $output;
//  }
}
