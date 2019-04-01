<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\MaritalStatus;

class MaritalStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('maritalstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('maritalstatus');
    	$aList=MaritalStatus::all();
    	return view('admin.basic.maritalstatus.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('maritalstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('maritalstatus');
        if($pList[2]->id==2){
            return view('admin.basic.maritalstatus.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:maritalstatus|max:255',
    	]);
     	$name=$request->name;
     	$aMaritalStatus=new MaritalStatus();
     	$aMaritalStatus->name=$name;
     	$status=$aMaritalStatus->save();
     	if($status){
     		$msg="Marital Status Created Successfully";
		  }else{
		    $msg="Marital Status not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('maritalstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('maritalstatus');
    	$aMaritalStatus=MaritalStatus::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.maritalstatus.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMaritalStatus]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:maritalstatus|max:255',
    	]);
    	$name=$request->name;
     	$aMaritalStatus=MaritalStatus::findOrfail($id);
     	$aMaritalStatus->name=$name;
     	$status=$aMaritalStatus->update();
     	if($status){
     		$msg="Marital Status Updated Successfully";
		  }else{
		    $msg="Marital Status not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
