<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EmployeeStatus;

class EmployeeStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeestatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeestatus');
        $aList=EmployeeStatus::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.employeestatus.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeestatus');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeetypes');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.basic.employeestatus.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:employeestatus|max:255',
    	]);
     	$name=$request->name;
     	$aEmployeeStatus=new EmployeeStatus();
     	$aEmployeeStatus->name=$name;
     	$status=$aEmployeeStatus->save();
     	if($status){
     		$msg="Employee Status Created Successfully";
		  }else{
		    $msg="Employee Status  not Created";
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
    	$aEmployeeStatus=EmployeeStatus::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
       }
       $dataList=[
        'institute'=>Institute::getInstituteName(),
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$aEmployeeStatus
        ];
        return view('admin.basic.employeestatus.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:employeestatus|max:255',
    	]);
    	$name=$request->name;
     	$aEmployeeStatus=EmployeeStatus::findOrfail($id);
     	$aEmployeeStatus->name=$name;
     	$status=$aEmployeeStatus->update();
     	if($status){
     		$msg="Employee Status Updated Successfully";
		  }else{
		    $msg="Employee Status not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
