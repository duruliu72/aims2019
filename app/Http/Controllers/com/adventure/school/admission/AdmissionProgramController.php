<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\menu\Menu;

class AdmissionProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogram');
        $aAdmissionProgram=new AdmissionProgram();
        $aList=$aAdmissionProgram->getAllAdmissionProgram();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.admissionsettings.admissionprogram.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogram');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $aProgramOffer=new ProgramOffer();
        // sessionid,programid,groupid,mediumid,shiftid and tableName
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
            'shiftList'=>$shiftList
        ];
        return view('admin.admissionsettings.admissionprogram.create',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'programid' => 'required',
        'groupid' => 'required',
        'mediumid' => 'required',
        'shiftid' => 'required',
        'required_gpa' => 'required',
        'exam_marks' => 'required',
    	]);
     	$yearName = date('Y');
    	$aSession=new Session();
    	$sessionid=$aSession->getSessionId($yearName);
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $required_gpa=$request->required_gpa;
        $exam_marks=$request->exam_marks;
        $exam_date=$request->exam_date;
        $exam_time=$request->exam_time;
     	// Check Here  programoffer is Created or not
     	$aProgramOffer=new ProgramOffer();
     	$hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
     	if($hasSame==false){
            $msg="This Program Offer is not Created Yet";
            return redirect()->back()->with('msg',$msg);
        }
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $aAdmissionProgram=new AdmissionProgram();
        $hasAddProgram=$aAdmissionProgram->checkValue($programofferid);
        if($hasAddProgram){
            $msg="This Admission Program  has Already Created";
            return redirect()->back()->with('msg',$msg);
        }
     	$aAdmissionProgram->programofferid=$programofferid;
        $aAdmissionProgram->required_gpa=$required_gpa;
        $aAdmissionProgram->exam_marks=$exam_marks;
        $aAdmissionProgram->exam_date=date("Y-m-d", strtotime($exam_date));
        $aAdmissionProgram->exam_time=date("H:i", strtotime($exam_time));
     	$status=$aAdmissionProgram->save();
     	if($status){
     		$msg="Admission Program Created Successfully";
		  }else{
		    $msg="Admission Program not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogram');
    	$aAdmissionProgram=AdmissionProgram::findOrfail($id);
        $obj=$aAdmissionProgram->getAdmissionProgram($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        
        $aProgramOffer=new ProgramOffer();
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
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
            'bean'=>$obj
        ];
        return view('admin.admissionsettings.admissionprogram.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'programid' => 'required',
        'groupid' => 'required',
        'mediumid' => 'required',
        'shiftid' => 'required',
        'required_gpa' => 'required',
        'exam_marks' => 'required',
        ]);
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
     	$shiftid=$request->shiftid;
        $required_gpa=$request->required_gpa;
        $exam_marks=$request->exam_marks;
        $exam_date=$request->exam_date;
        $exam_time=$request->exam_time;
        // Check Here  programoffer is Created or not
        $aProgramOffer=new ProgramOffer();
        $hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
        if($hasSame==false){
            $msg="This Program Offer is not Created Yet";
            return redirect()->back()->with('msg',$msg);
        }
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $aAdmissionProgram=AdmissionProgram::findOrfail($id);
        if($id==$programofferid){
            $aAdmissionProgram->programofferid=$programofferid;
            $aAdmissionProgram->required_gpa=$required_gpa;
            $aAdmissionProgram->exam_marks=$exam_marks;
            $aAdmissionProgram->exam_date=date("Y-m-d", strtotime($exam_date));
            $aAdmissionProgram->exam_time=date("H:i", strtotime($exam_time));
        }else{
            $hasAddProgram=$aAdmissionProgram->checkValue($programofferid);
            if($hasAddProgram){
                $msg="This Admission Program  has Already Exists";
                return redirect()->back()->with('msg',$msg);
            }
        }
        $aAdmissionProgram->programofferid=$programofferid;
        $aAdmissionProgram->required_gpa=$required_gpa;
        $aAdmissionProgram->exam_marks=$exam_marks;
        $aAdmissionProgram->exam_date=date("Y-m-d", strtotime($exam_date));
        $aAdmissionProgram->exam_time=date("H:i", strtotime($exam_time));
        $status=$aAdmissionProgram->update();
        if($status){
            $msg="Admission Program Updated Successfully";
          }else{
            $msg="Admission Program not Updated";
        }
        return redirect()->back()->with('msg',$msg);
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
