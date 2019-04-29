<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
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
        $hasMenu=$aMenu->hasMenu('levelprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('levelprogram');
    	$obj=new VLevelProgram();
        $aList=$obj->getAllGroupsOnProgram();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.levelprogram.index',$dataList);
    	
    }
    public function create(){
       $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('levelprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('levelprogram');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $levelList=PLevel::all();
        $programList=Program::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'levelList'=>$levelList,
            'programList'=>$programList
        ];
        return view('admin.programsettings.levelprogram.create',$dataList);
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
        $hasMenu=$aMenu->hasMenu('levelprogram');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('levelprogram');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aVLevelProgram=VLevelProgram::findOrfail($id);
        $levelList=PLevel::all();
        $programList=Program::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'levelList'=>$levelList,
            'programList'=>$programList,
            'bean'=>$aVLevelProgram
        ];
        return view('admin.programsettings.levelprogram.edit',$dataList); 
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
