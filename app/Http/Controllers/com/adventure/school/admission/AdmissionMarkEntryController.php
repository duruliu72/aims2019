<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\admission\Admission;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionResult;
use App\com\adventure\school\admission\VAdmissionSubject;
class AdmissionMarkEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function markEntry(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionmarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aAdmission=new Admission();
        $aVAdmissionSubject=new VAdmissionSubject();
        $aApplicant=new Applicant();
        $programinfo=null;
        $subjectinfo=null;
        $applicants=null;
        if($request->isMethod('post')&&$request->result_btn=='result_btn'){
            $programofferid=$aVAdmissionSubject->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
            $programinfo=$aVAdmissionSubject->getAdmissioninfo($programofferid);
            $subjectinfo=$aVAdmissionSubject->getAdmitCardSubject($programofferid);
            $applicants=$aApplicant->getApplicantsForMarkEntry($programofferid);
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $programofferid=$request->programofferid;
            $programinfo=$aVAdmissionSubject->getAdmissioninfo($programofferid);
            $subjectinfo=$aVAdmissionSubject->getAdmitCardSubject($programofferid);
            $checkLst=$request->checkbox;
            if($checkLst!=null){
                foreach ($checkLst as $key=>$value){
                    $markList=$request->marks[$key];
                    $subjectidList=$request->subjectid[$key];
                    $length=count($markList);
                    // check all field are fill or not for each applicant
                    $isTrue=true;
                    for($i=0;$i<$length;$i++){
                        if($markList[$i]==""){
                             $isTrue=false;
                        }
                    }
                    if($isTrue==true && $aApplicant->checkAplicant($key)==false){
                        foreach ($markList as $k=>$x) {
                            if ($x!="") {
                                $aAdmissionResult=new AdmissionResult();
                                $aAdmissionResult->applicantid=$key;
                                $aAdmissionResult->subjectid=$subjectidList[$k];
                                $aAdmissionResult->marks=$x;
                                $aAdmissionResult->save();
                            }
                        }
                    }
                }
                $msg="Your input item save Successfully";
            }
            $applicants=$aApplicant->getApplicantsForMarkEntry($programofferid);
        }
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$aAdmission->getAllProgram($sessionid),
            'groupList'=>array(),
            'mediumList'=>$aAdmission->getAllMedium($sessionid),
            'shiftList'=>$aAdmission->getAllShift($sessionid),
            'programinfo'=>$programinfo,
            'subjectinfo'=>$subjectinfo,
            'applicants'=>$applicants,
            'msg'=>$msg
        ];
        return view('admin.admissionsettings.admissionmarkentry.index',$dataList);
    }
    public function markEdit(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionmarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aAdmission=new Admission();
        $aVAdmissionSubject=new VAdmissionSubject();
        $aApplicant=new Applicant();
        $programinfo=null;
        $subjectinfo=null;
        $applicantsmarks=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $programofferid=$aVAdmissionSubject->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
            $programinfo=$aVAdmissionSubject->getAdmissioninfo($programofferid);
            $subjectinfo=$aVAdmissionSubject->getAdmitCardSubject($programofferid);
            $applicantsmarks=$aApplicant->getApplicantsForMarkEdit($programofferid);
            // dd($applicantsmarks);
        }
        if($request->isMethod('post')&&$request->update_btn=='update_btn'){
            $programofferid=$request->programofferid;
            $programinfo=$aVAdmissionSubject->getAdmissioninfo($programofferid);
            $subjectinfo=$aVAdmissionSubject->getAdmitCardSubject($programofferid);
            $checkLst=$request->checkbox;
            if($checkLst!=null){
                foreach ($checkLst as $key=>$value){
                    // dd($checkLst);
                    $markList=$request->marks[$key];
                    // dd($markList);
                    $subjectidList=$request->subjectid[$key];
                    // dd($subjectidList);
                    $length=count($markList);
                    // check all field are fill or not for each applicant
                    $isTrue=true;
                    for($i=0;$i<$length;$i++){
                        if($markList[$i]==""){
                             $isTrue=false;
                        }
                    }
                    if($isTrue==true){
                        foreach ($markList as $k=>$x) {
                            if ($x!="") {
                                \DB::table('admissionresult')
                                ->where('applicantid', $key)
                                ->where('subjectid', $subjectidList[$k])
                                ->update(['marks' => $x]);
                            }
                        }
                    }
                }
                $msg="Your input item update Successfully";
            }
            $applicantsmarks=$aApplicant->getApplicantsForMarkEdit($programofferid);
        }
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$aAdmission->getAllProgram($sessionid),
            'groupList'=>array(),
            'mediumList'=>$aAdmission->getAllMedium($sessionid),
            'shiftList'=>$aAdmission->getAllShift($sessionid),
            'programinfo'=>$programinfo,
            'subjectinfo'=>$subjectinfo,
            'applicantsmarks'=>$applicantsmarks,
            'msg'=>$msg
        ];
        return view('admin.admissionsettings.admissionmarkentry.edit',$dataList);
    }
     // For Ajax Call
    public function getValue(Request $request){
        $option=$request->option;
        $idvalue=$request->idvalue;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        if($option=="program"){
            if($methodid==1){
                $this->getGroup($idvalue);
            }elseif($methodid==2){
                $this->getMedium($idvalue);
            }elseif($methodid==3){
                $this->getShift($idvalue);
            }
        }elseif($option=="group"){
            if($methodid==1){
                $this->getMediumWithProgram($programid,$idvalue);
            }elseif($methodid==2){
                $this->getShiftWithProgram($programid,$idvalue);
            }
        }elseif($option=="medium"){
            if($methodid==1){
                $this->getShiftWithProgramAndGroup($programid,$groupid,$idvalue);
            }
        }
    }
    private function getGroup($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getGroup(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMedium($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getMedium(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShift($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShift(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumWithProgram($programid,$groupid){
        $aAdmission=new Admission();
        $result=$aAdmission->getMediumWithProgram(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgram($programid,$groupid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShiftWithProgram(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgramAndGroup($programid,$groupid,$mediumid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShiftWithProgramAndGroup(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
