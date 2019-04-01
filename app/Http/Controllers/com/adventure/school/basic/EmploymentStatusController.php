<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EmploymentStatus;
class EmploymentStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employmentstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employmentstatus');
    	$aList=EmploymentStatus::all();
    	return view('admin.basic.employmentstatus.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employmentstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employmentstatus');
        if($pList[2]->id==2){
            return view('admin.basic.employmentstatus.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:employmentstatus|max:255',
    	]);
     	$name=$request->name;
     	$aEmploymentStatus=new EmploymentStatus();
     	$aEmploymentStatus->name=$name;
     	$status=$aEmploymentStatus->save();
     	if($status){
     		$msg="Employment Status Created Successfully";
		  }else{
		    $msg="Employment Status not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employmentstatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employmentstatus');
    	$aEmploymentStatus=EmploymentStatus::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.employmentstatus.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aEmploymentStatus]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:employmentstatus|max:255',
    	]);
    	$name=$request->name;
     	$aEmploymentStatus=EmploymentStatus::findOrfail($id);
     	$aEmploymentStatus->name=$name;
     	$status=$aEmploymentStatus->update();
     	if($status){
     		$msg="Employment Status Updated Successfully";
		  }else{
		    $msg="Employment Status not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
