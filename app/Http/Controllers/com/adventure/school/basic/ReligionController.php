<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Religion;
use App\com\adventure\school\menu\Menu;
class ReligionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('religion');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('religion');
    	$aList=Religion::all();
    	return view('admin.basic.religion.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('religion');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('religion');
        if($pList[2]->id==2){
            return view('admin.basic.religion.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:religions|max:255',
    	]);
     	$name=$request->name;
     	$aReligion=new Religion();
     	$aReligion->name=$name;
     	$status=$aReligion->save();
     	if($status){
     		$msg="Religion Created Successfully";
		  }else{
		    $msg="Religion not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('religion');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('religion');
    	$aReligion=Religion::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.religion.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aReligion]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:religions|max:255',
    	]);
    	$name=$request->name;
     	$aReligion=Religion::findOrfail($id);
     	$aReligion->name=$name;
     	$status=$aReligion->update();
     	if($status){
     		$msg="Religion Updated Successfully";
		  }else{
		    $msg="Religion not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
