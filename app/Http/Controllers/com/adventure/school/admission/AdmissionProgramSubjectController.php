<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionProgramSubject;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\basic\AdmissionSubject;
use App\com\adventure\school\menu\Menu;
class AdmissionProgramSubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogramsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogramsubject');
        $obj=new AdmissionProgramSubject();
        $aList=$obj->getAllAdmission();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.admissionsettings.admissionprogramsubject.index',$dataList);
    }
    public function create(){
    	// $date = date('Y/m/d H:i:s');
    	$yearName = date('Y');
    	$aSession=new Session();
    	$sessionid=$aSession->getSessionId($yearName);
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogramsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogramsubject');
        if($pList[2]->id==2){
            $aAdmissionProgram=new AdmissionProgram();
            // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
            $programList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"programs",'programid');
            $mediumList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
            $shiftList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
            $groupList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
            $dataList=[
                'institute'=>Institute::getInstituteName(),
                'sidebarMenu'=>$sidebarMenu,
                'programList'=>$programList,
                'groupList'=>$groupList,
                'mediumList'=>$mediumList,
                'shiftList'=>$shiftList,
                'admissionSubList'=>AdmissionSubject::all()
            ];
            return view('admin.admissionsettings.admissionprogramsubject.create',$dataList);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
    	]);
     	$yearName = date('Y');
    	$aSession=new Session();
    	$sessionid=$aSession->getSessionId($yearName);
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $data=$request->data;
        $aAdmissionProgram=new AdmissionProgram();
        $admission_programid=$aAdmissionProgram->getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // Check Program Offer is assign or not
        $aAdmissionProgramSubject=new AdmissionProgramSubject();
        $isExist=$aAdmissionProgramSubject->CheckAssignAdmissionSubject($admission_programid);
        if($isExist){
            $msg="Admission Subject Already Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $status=\DB::transaction(function()use($data,$admission_programid){
            $count=0;
            foreach ($data as $key => $x) {
                if($x!=null){
                    $obj=new AdmissionProgramSubject();
                    $obj->admission_programid=$admission_programid;
                    $obj->subjectid=$key;
                    $obj->marks=$x;
                    $obj->save();
                    $count++;
                }
            }
            return ($count>0)?true:false;
        });
     	if($status){
     		$msg="Admission Subject Assign Successfully";
		  }else{
		    $msg="Admission Subject not Assign";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionprogramsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionprogramsubject');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aAdmissionProgram=AdmissionProgram::findOrfail($id);
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $obj=new AdmissionProgramSubject();
        $bean=$obj->getAllAdmissionProgram($id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
            'bean'=>$bean,
            'admissionSubList'=>$obj->getProgramSubjects($aAdmissionProgram->id),
        ];
        return view('admin.admissionsettings.admissionprogramsubject.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
        ]);
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $data=$request->data;
        \DB::table('admission_program_subjects')->where('admission_programid', '=', $id)->delete();
        $aAdmissionProgram=AdmissionProgram::findOrfail($id);
       
        $admission_programid=$aAdmissionProgram->getAdmissionProgramID($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // Check Program Offer is assign or not
        $obj=new AdmissionProgramSubject();
        $isExist=$obj->CheckAssignAdmissionSubject($admission_programid);
        if($isExist){
            $msg="Admission Subject Already Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $status=\DB::transaction(function()use($data,$admission_programid){
            foreach ($data as $key => $x) {
                if($x!=null){
                    $aVAdmissionSubject=new AdmissionProgramSubject();
                    $aVAdmissionSubject->admission_programid=$admission_programid;
                    $aVAdmissionSubject->subjectid=$key;
                    $aVAdmissionSubject->marks=$x;
                    $aVAdmissionSubject->save();
                }
            }
            return true;
        });
        if($status){
            $msg="Admission Subject update Successfully";
          }else{
            $msg="Admission Subject not update";
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
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}



