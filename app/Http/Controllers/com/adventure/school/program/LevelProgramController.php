<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\LevelProgram;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\menu\Menu;
class LevelProgramController extends Controller
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
    	$obj=new LevelProgram();
        $aList=$obj->getLevelPrograms();
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
     	$aLevelProgram=new LevelProgram();
        $programlevelid=$request->programlevelid;
        $programid=$request->programid;
        $hasSame=$aLevelProgram->checkValue($programid);
        if($hasSame){
            $msg="This Program has aready Assign To Another Level";
            return redirect()->back()->with('msg',$msg);
        }
        $aLevelProgram->programlevelid=$programlevelid;
        $aLevelProgram->programid= $programid;
     	$status=$aLevelProgram->save();
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
        $aLevelProgram=LevelProgram::findOrfail($id);
        $levelList=PLevel::all();
        $programList=Program::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'levelList'=>$levelList,
            'programList'=>$programList,
            'bean'=>$aLevelProgram
        ];
        return view('admin.programsettings.levelprogram.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$aLevelProgram=LevelProgram::findOrfail($id);
    	$programlevelid=$request->programlevelid;
        $programid=$request->programid;
        $hasSame=$aLevelProgram->checkValueforUpdate($programlevelid,$programid);
        if($hasSame){
            $msg="This Program has aready Assign";
            return redirect()->back()->with('msg',$msg);
        }
        $aLevelProgram->programlevelid=$programlevelid;
        $aLevelProgram->programid= $programid;
     	$status=$aLevelProgram->update();
     	if($status){
     		$msg="Updated Successfully";
		  }else{
		    $msg="not Update";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
