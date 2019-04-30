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
        $aVAdmissionSubject=new AdmissionProgramSubject();
        $aList=$aVAdmissionSubject->getAllAdmissionProgram();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.admissionsettings.vadmissionsubject.index',$dataList);
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
            $dataList=[
                'institute'=>Institute::getInstituteName(),
                'sidebarMenu'=>$sidebarMenu,
                'programList'=>$aAdmissionProgram->getAllProgram($sessionid),
                'groupList'=>array(),
                'mediumList'=>$aAdmissionProgram->getAllMedium($sessionid),
                'shiftList'=>$aAdmissionProgram->getAllShift($sessionid),
                'admissionSubList'=>AdmissionSubject::all()
            ];
            return view('admin.admissionsettings.vadmissionsubject.create',$dataList);
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
        $programofferid=$aAdmissionProgram->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // Check Program Offer is assign or not
        $aVAdmissionSubject=new VAdmissionSubject();
        $isExist=$aVAdmissionSubject->CheckAdmissionSubject($programofferid);
        if($isExist){
            $msg="Admission Subject Already Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $status=\DB::transaction(function()use($data,$programofferid){
            $count=0;
            foreach ($data as $key => $x) {
                if($x!=null){
                    $aVAdmissionSubject=new AdmissionProgramSubject();
                    $aVAdmissionSubject->programofferid=$programofferid;
                    $aVAdmissionSubject->subjectid=$key;
                    $aVAdmissionSubject->marks=$x;
                    $aVAdmissionSubject->save();
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
    	$aProgramOffer=ProgramOffer::findOrfail($id);
        if($pList[3]->id==3){
           	$aAdmissionProgram=new AdmissionProgram();
            $aVAdmissionSubject=new AdmissionProgramSubject();
            $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'sessionList'=>Session::all(),
                'programList'=>$aAdmissionProgram->getAllProgram($sessionid),
                'groupList'=>$aAdmissionProgram->getAllGroup($sessionid,$aProgramOffer->programid),
                'mediumList'=>$aAdmissionProgram->getAllMedium($sessionid),
                'shiftList'=>$aAdmissionProgram->getAllShift($sessionid),
                'bean'=>$aProgramOffer,
                'admissionSubList'=>$aVAdmissionSubject->getAdmissionSubject($aProgramOffer->id),
            ];
            return view('admin.admissionsettings.vadmissionsubject.edit',$dataList);
       }else{
            return redirect('error');
       }
        
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
        \DB::table('vadmission_subjects')->where('programofferid', '=', $id)->delete();
        $aAdmissionProgram=new AdmissionProgram();
        $programofferid=$aAdmissionProgram->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        // Check Program Offer is assign or not
        $aVAdmissionSubject=new VAdmissionSubject();
        $isExist=$aVAdmissionSubject->CheckAdmissionSubject($programofferid);
        if($isExist){
            $msg="Admission Subject Already Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $status=\DB::transaction(function()use($data,$programofferid){
            foreach ($data as $key => $x) {
                if($x!=null){
                    $aVAdmissionSubject=new AdmissionProgramSubject();
                    $aVAdmissionSubject->programofferid=$programofferid;
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
    public function getValue(Request $request){
        $option=$request->option;
        $idvalue=$request->idvalue;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        if($option=="admissionsubjectgroup"){
            if($methodid==1){
                $this->getGroup($idvalue);
            }elseif($methodid==2){
                $this->getMedium($idvalue);
            }elseif($methodid==3){
                $this->getShift($idvalue);
            }
        }elseif($option=="admissionsubjectmedium"){
            if($methodid==1){
                $this->getMediumWithProgram($programid,$idvalue);
            }elseif($methodid==2){
                $this->getShiftWithProgram($programid,$idvalue);
            }
        }elseif($option=="admissionsubjectshift"){
            if($methodid==1){
                $this->getShiftWithProgramAndGroup($programid,$groupid,$idvalue);
            }
        }
    }
    private function getGroup($programid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getAllGroup(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMedium($programid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getAllMediumOnProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShift($programid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getAllShiftOnProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumWithProgram($programid,$groupid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getFAllMedium(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgram($programid,$groupid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getFAllShiftOnMedium(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgramAndGroup($programid,$groupid,$mediumid){
        $aAdmissionProgram=new AdmissionProgram();
        $result=$aAdmissionProgram->getFAllShift(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}



