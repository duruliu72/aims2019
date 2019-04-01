<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\VLevelProgram;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\menu\Menu;
class VLevelProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('vlevelprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('vlevelprogram');
    	$obj=new VLevelProgram();
    	$aList=$obj->getAllGroupsOnProgram();
    	return view('admin.programsettings.levelprogram.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    	
    }
    public function create(){
       $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('vlevelprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('vlevelprogram');
        if($pList[2]->id==2){
        	$levelList=PLevel::all();
        	$programList=Program::all();
            return view('admin.programsettings.levelprogram.create',['sidebarMenu'=>$sidebarMenu,'levelList'=>$levelList,'programList'=>$programList]);
        }else{
            return redirect('error');
        }
    }
    public function store(Request $request){
     	$aVLevelProgram=new VLevelProgram();
        $programlevelid=$request->programlevelid;
        $programid=$request->programid;
        $hasSame=$aVLevelProgram->checkValue($programid);
        if($hasSame){
            $msg="This Program has aready Assign To Another Level";
            return redirect()->back()->with('msg',$msg);
        }
        $aVLevelProgram->programlevelid=$programlevelid;
        $aVLevelProgram->programid= $programid;
     	$status=$aVLevelProgram->save();
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
        if($pList[3]->id==3){
            $aVLevelProgram=VLevelProgram::findOrfail($id);
        	$levelList=PLevel::all();
            $programList=Program::all();
           return view('admin.programsettings.levelprogram.edit',['sidebarMenu'=>$sidebarMenu,'levelList'=>$levelList,'programList'=>$programList,'bean'=>$aVLevelProgram]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$aVLevelProgram=VLevelProgram::findOrfail($id);
    	$programlevelid=$request->programlevelid;
        $programid=$request->programid;
        $hasSame=$aVLevelProgram->checkValueforUpdate($programlevelid,$programid);
        if($hasSame){
            $msg="This Program has aready Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $aVLevelProgram->programlevelid=$programlevelid;
        $aVLevelProgram->programid= $programid;
     	$status=$aVLevelProgram->update();
     	if($status){
     		$msg="Updated Successfully";
		  }else{
		    $msg="not Update";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
