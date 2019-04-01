<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\Department;
class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('departments');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('departments');
    	$aList=Department::all();
    	return view('admin.basic.departments.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('departments');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('departments');
        if($pList[2]->id==2){
            return view('admin.basic.departments.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:departments|max:255',
    	]);
     	$name=$request->name;
     	$aDepartment=new Department();
     	$aDepartment->name=$name;
     	$status=$aDepartment->save();
     	if($status){
     		$msg="Department Created Successfully";
		  }else{
		    $msg="Department not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('departments');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('departments');
    	$aDepartment=Department::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.departments.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aDepartment]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:departments|max:255',
    	]);
    	$name=$request->name;
     	$aDepartment=Department::findOrfail($id);
     	$aDepartment->name=$name;
     	$status=$aDepartment->update();
     	if($status){
     		$msg="Department Updated Successfully";
		  }else{
		    $msg="Department not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
