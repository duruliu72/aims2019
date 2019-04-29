<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\menu\Menu;
class ProgramControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
        $aList=Program::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.program.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.program.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programs|max:255',
    	]);
     	$name=$request->name;
     	$aProgram=new Program();
     	$aProgram->name=$name;
     	$status=$aProgram->save();
     	if($status){
     		$msg="Program Created Successfully";
		  }else{
		    $msg="Program not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
    	$aProgram=Program::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aProgram
        ];
        return view('admin.programsettings.program.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:programs|max:255',
    	]);
    	$name=$request->name;
     	$aProgram=Program::findOrfail($id);
     	$aProgram->name=$name;
     	$status=$aProgram->update();
     	if($status){
     		$msg="Program Updated Successfully";
		  }else{
		    $msg="Program not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
