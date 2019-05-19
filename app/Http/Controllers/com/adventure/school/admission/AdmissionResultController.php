<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\AdmissionMarkEntry;
use App\com\adventure\school\admission\Admission;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionResult;
use App\com\adventure\school\admission\VAdmissionSubject;
class AdmissionResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function resultDisplay(Request $request){
        $msg="";
    	$aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionresults');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aAdmission=new Admission();
        $pList=$aMenu->getPermissionOnMenu('admissionresults');
        $applicantResults=null;
        $programinfo=null;
        $result=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
        	$aAdmissionResult=new AdmissionResult();
        	$programid=$request->programid;
	        $groupid=$request->groupid;
	        $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $result=$aAdmissionResult->getAdmissionResults(0,$programid,$groupid,$mediumid,$shiftid);
        }
        $aApplicant=new Applicant();
        $aAdmissionProgram=new AdmissionProgram();
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        // dd($result);
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
    	return view('admin.admissionsettings.admissionresult.index1',$dataList);
    }
}
