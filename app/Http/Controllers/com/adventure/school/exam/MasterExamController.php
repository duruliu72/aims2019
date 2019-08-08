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
                'sessionid' => 'required',
                'programlabelid' => 'required',
                'programid' => 'required',
                'mediumid' => 'required',
                'shiftid' => 'required',
                'groupid' => 'required',
                'examnameid'=>'required|',
                'exhld_in_percentage'=>'required',
                // 'cxm_in_percentage'=>'required'
            ]);
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $examnameid=$request->examnameid;
            $exhld_in_percentage=$request->exhld_in_percentage;
            $cxm_in_percentage=0;
            if($request->result_with_child!=null){
                $cxm_in_percentage=$request->cxm_in_percentage;
            }
            $result_with_child=$request->result_with_child;
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if($request->btn=="save_btn"){
                if($programofferid==0){
                    $msg="This Program Offer has not creared yet";
                    return redirect()->back()->with('msg',$msg);
                }
                $obj=new MasterExam();
                $obj->programofferid=$programofferid;
                $obj->examnameid=$examnameid;
                $obj->exhld_in_percentage=$exhld_in_percentage;
                $obj->mxm_in_percentage=100;
                $obj->cxm_in_percentage=$cxm_in_percentage;
                $obj->result_with_child=$result_with_child;
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
                $obj->exhld_in_percentage=$exhld_in_percentage;
                $obj->cxm_in_percentage=$cxm_in_percentage;
                $obj->result_with_child=$result_with_child;
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
        // die("Die");
        $aList=MasterExam::getAllMaster();
        // sessionid ,programlabelid,programid,groupid,mediumid,shiftid,tableName and $compaireid
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $masterExamNameList=ExamName::getExamName(1);
        $bean=null;
        if($request->id!=null){
            $editObj=MasterExam::findOrfail($request->id);
            $bean=MasterExam::getMasterExamId($request->id);
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
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
}
