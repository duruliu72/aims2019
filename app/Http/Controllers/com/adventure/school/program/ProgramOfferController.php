<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\menu\Menu;

class ProgramOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
        $aProgramOffer=new ProgramOffer();
    	$aList=$aProgramOffer->getAllProgramOffer();
    	return view('admin.programsettings.programoffer.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
        if($pList[2]->id==2){
        	$sessionList=Session::all();
        	$aProgramOffer=new ProgramOffer();
        	$programList=$aProgramOffer->getProgramOnLevel();
        	$groupList=array();
        	$mediumList=Medium::all();
            $shiftList=Shift::all();
            $aEmployee=new Employee();
            $employeeList=$aEmployee->getEmployees();
            $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'sessionList'=>$sessionList,
                'programList'=>$programList,
                'groupList'=>$groupList,
                'mediumList'=>$mediumList,
                'shiftList'=>$shiftList,
                'employeeList'=>$employeeList,
            ];
            return view('admin.programsettings.programoffer.create',$dataList);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'sessionid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
    	]);
     	$sessionid=$request->sessionid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        $seat=$request->seat;
     	// Check Here Is programoffer is Created
     	$aProgramOffer=new ProgramOffer();
     	$hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
     	if($hasSame){
            $msg="This Program Offer has Already Created";
            return redirect()->back()->with('msg',$msg);
        }
     	$aProgramOffer->sessionid=$sessionid;
     	$aProgramOffer->programid=$programid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        $cordinator=$request->cordinator;
        $aProgramOffer->seat=$seat;
     	$status=$aProgramOffer->save();
     	if($status){
     		$msg="Program Offer Created Successfully";
		  }else{
		    $msg="Program Offer not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
    	$aProgramOffer=ProgramOffer::findOrfail($id);
        if($pList[3]->id==3){
           	$sessionList=Session::all();
        	$programList=$aProgramOffer->getProgramOnLevel();
        	$groupList=$aProgramOffer->getGroupOnProgramByID($aProgramOffer->programid);
        	$mediumList=Medium::all();
            $shiftList=Shift::all();
            $aEmployee=new Employee();
            $employeeList=$aEmployee->getEmployees();
            $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'sessionList'=>$sessionList,
                'programList'=>$programList,
                'groupList'=>$groupList,
                'mediumList'=>$mediumList,
                'shiftList'=>$shiftList,
                'employeeList'=>$employeeList,
                'bean'=>$aProgramOffer
            ];
            return view('admin.programsettings.programoffer.edit',$dataList);
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'sessionid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
    	]);
     	$sessionid=$request->sessionid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        $seat=$request->seat;
     	// dd($shiftid);
     	// Check Here programoffer is Exist not
        $aProgramOffer=ProgramOffer::findOrfail($id);
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        if($programofferid!=$id){
            $hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
            if($hasSame){
                $msg="This Program Offer has Already Exits";
                return redirect()->back()->with('msg',$msg);
            }
        }
     	$aProgramOffer->sessionid=$sessionid;
     	$aProgramOffer->programid=$programid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        $cordinator=$request->cordinator;
        $aProgramOffer->seat=$seat;
     	$status=$aProgramOffer->update();
     	if($status){
     		$msg="Program Updated Successfully";
		  }else{
		    $msg="Program not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
