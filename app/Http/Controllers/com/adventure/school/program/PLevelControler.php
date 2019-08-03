<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\menu\Menu;
class PLevelControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        $aList=PLevel::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.level.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.level.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programlevels|max:255',
    	]);
     	$name=$request->name;
     	$aProgramLevel=new PLevel();
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->save();
     	if($status){
     		$msg="Level Created Successfully";
		  }else{
		    $msg="Level not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
    	$aProgramLevel=PLevel::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aProgramLevel
        ];
        return view('admin.programsettings.level.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$name=$request->name;
     	$aProgramLevel=PLevel::findOrfail($id);
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->update();
     	if($status){
     		$msg="Level Updated Successfully";
		  }else{
		    $msg="Level not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
