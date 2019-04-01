<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\VProgramGroup;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\menu\Menu;
class VProgramGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('vprogramgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('vprogramgroup');
    	$obj=new VProgramGroup();
    	$aList=$obj->getAllGroupsOnProgram();
    	return view('admin.programsettings.programgroup.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    	
    }
    public function create(){
       $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('vprogramgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('vprogramgroup');
        if($pList[2]->id==2){
        	$programList=Program::all();
        	$groupList=Group::all();
            return view('admin.programsettings.programgroup.create',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList]);
        }else{
            return redirect('error');
        }
    }
    public function store(Request $request){
     	$aVProgramGroup=new VProgramGroup();
        $programid=$request->programid;
        $groupid=$request->groupid;
        $hasSame=$aVProgramGroup->checkValue($programid,$groupid);
        $aVProgramGroup->programid=$programid;
        $aVProgramGroup->groupid=$groupid;
        if($hasSame){
            $msg="This item has aready";
            return redirect()->back()->with('msg',$msg);
        }
     	$status=$aVProgramGroup->save();
     	if($status){
     		$msg="Created Successfully";
		  }else{
		    $msg="not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('vprogramgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('vprogramgroup');
    	$aVProgramGroup=VProgramGroup::findOrfail($id);
        if($pList[3]->id==3){
        	$programList=Program::all();
        	$groupList=Group::all();
           return view('admin.programsettings.programgroup.edit',['sidebarMenu'=>$sidebarMenu,'programList'=>$programList,'groupList'=>$groupList,'bean'=>$aVProgramGroup]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$aVProgramGroup=VProgramGroup::findOrfail($id);
    	$programid=$request->programid;
        $groupid=$request->groupid;
        $hasSame=$aVProgramGroup->checkValue($programid,$groupid);
        $aVProgramGroup->programid=$programid;
        $aVProgramGroup->groupid=$groupid;
        if($hasSame){
            $msg="This item has aready";
            return redirect()->back()->with('msg',$msg);
        }
     	$status=$aVProgramGroup->update();
     	if($status){
     		$msg="Updated Successfully";
		  }else{
		    $msg="not Update";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
