<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionMarkEntry;
use App\com\adventure\school\admission\AdmissionResult;
class AdmissionMarkEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function markEntry(Request $request){
        $msg="";
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
        $aAdmissionMarkEntry=new AdmissionMarkEntry();
        $result=null;
        if($request->isMethod('post')&&$request->result_btn=='result_btn'){
            $result=$aAdmissionMarkEntry->getResultForMarkEntry(0,$programid,$groupid,$mediumid,$shiftid);
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $admission_programid=$request->programofferid;
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
                    if($isTrue==true && $aAdmissionMarkEntry->checkAplicant($key)==false){
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
            $result=$aAdmissionMarkEntry->getResult($admission_programid);
        }
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
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
            'result'=>$result,
            'msg'=>$msg
        ];
        return view('admin.admissionsettings.admissionmarkentry.index',$dataList);
    }
    public function markEdit(Request $request){
        $msg="";
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
        $aAdmissionMarkEntry=new AdmissionMarkEntry();
        $result=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $result=$aAdmissionMarkEntry->getResultForMarkEntry(0,$programid,$groupid,$mediumid,$shiftid);
        }
        if($request->isMethod('post')&&$request->update_btn=='update_btn'){
            $admission_programid=$request->programofferid;
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
            $result=$aAdmissionMarkEntry->getResult($admission_programid);
        }
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
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
            'result'=>$result,
            'msg'=>$msg
        ];
        return view('admin.admissionsettings.admissionmarkentry.edit',$dataList);
    }
}
