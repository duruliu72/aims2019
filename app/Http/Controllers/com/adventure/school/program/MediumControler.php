<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\menu\Menu;
class MediumControler extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('medium');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('medium');
        $aList=Medium::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.medium.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('medium');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('medium');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.medium.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:mediums|max:255',
    	]);
     	$name=$request->name;
     	$aMedium=new Medium();
     	$aMedium->name=$name;
     	$status=$aMedium->save();
     	if($status){
     		$msg="Medium Created Successfully";
		  }else{
		    $msg="Medium not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('medium');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('medium');
    	$aMedium=Medium::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
       }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aMedium
        ];
        return view('admin.programsettings.medium.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:mediums|max:255',
    	]);
    	$name=$request->name;
     	$aMedium=Medium::findOrfail($id);
     	$aMedium->name=$name;
     	$status=$aMedium->update();
     	if($status){
     		$msg="Medium Updated Successfully";
		  }else{
		    $msg="Medium not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}