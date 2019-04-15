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
class AdmissionResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function resultDisplay(Request $request){
    	$msg="";
    	$yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
    	$aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionresults');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aAdmission=new Admission();
        $aAdmissionResult=new AdmissionResult();
        $result=$aAdmissionResult->getMeritList(10);
        $pList=$aMenu->getPermissionOnMenu('admissionresults');
        $applicantResults=null;
        $programinfo=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
        	$aAdmissionResult=new AdmissionResult();
        	$aVAdmissionSubject=new VAdmissionSubject();
        	$programid=$request->programid;
	        $groupid=$request->groupid;
	        $mediumid=$request->mediumid;
	        $shiftid=$request->shiftid;
        	$programofferid=$aVAdmissionSubject->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        	$programinfo=$aVAdmissionSubject->getAdmissioninfo($programofferid);
        	$applicantResults=$aAdmissionResult->getAdmissionApplicantsCommon($programofferid);
        }
        $aApplicant=new Applicant();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$aApplicant->getProgramsOnSession($sessionid),
            'groupList'=>$aApplicant->getGroupsOnSession($sessionid),
            'mediumList'=>$aApplicant->getMediumsOnSession($sessionid),
            'shiftList'=>$aApplicant->getShiftsOnSession($sessionid),
            'programinfo'=>$programinfo,
            'results'=>$applicantResults,
            'msg'=>$msg
        ];
    	return view('admin.admissionsettings.admissionresult.index1',$dataList);
    }
}
