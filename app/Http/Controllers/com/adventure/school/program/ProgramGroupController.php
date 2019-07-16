<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramGroup;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\menu\Menu;
class ProgramGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programgroup');
    	$obj=new ProgramGroup();
        $aList=$obj->getGroupsOnProgram();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.programgroup.index',$dataList);
    }
    public function create(){
       $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programgroup');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $programList=Program::all();
        $groupList=Group::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList
        ];
        return view('admin.programsettings.programgroup.create',$dataList);
    }
    public function store(Request $request){
     	$aVProgramGroup=new ProgramGroup();
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
        $hasMenu=$aMenu->hasMenu('programgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programgroup');
    	$aVProgramGroup=ProgramGroup::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
       }
        $programList=Program::all();
        $groupList=Group::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'bean'=>$aVProgramGroup
        ];
        return view('admin.programsettings.programgroup.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$aVProgramGroup=ProgramGroup::findOrfail($id);
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
