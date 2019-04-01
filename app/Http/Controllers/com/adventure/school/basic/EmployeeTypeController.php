<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EmployeeType;
class EmployeeTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeetypes');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeetypes');
    	$aList=EmployeeType::all();
    	return view('admin.basic.employeetype.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeetypes');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeetypes');
        if($pList[2]->id==2){
            return view('admin.basic.employeetype.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:employeetypes|max:255',
    	]);
     	$name=$request->name;
     	$aEmployeeType=new EmployeeType();
     	$aEmployeeType->name=$name;
     	$status=$aEmployeeType->save();
     	if($status){
     		$msg="Employee Type Created Successfully";
		  }else{
		    $msg="Employee Type Status not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeetypes');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeetypes');
    	$aEmployeeType=EmployeeType::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.employeetype.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aEmployeeType]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:employeetypes|max:255',
    	]);
    	$name=$request->name;
     	$aEmployeeType=EmployeeType::findOrfail($id);
     	$aEmployeeType->name=$name;
     	$status=$aEmployeeType->update();
     	if($status){
     		$msg="Employee Type Updated Successfully";
		  }else{
		    $msg="Employee Type not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
