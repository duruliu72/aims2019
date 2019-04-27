<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
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
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.employeetype.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeetypes');
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
        return view('admin.basic.employeetype.create',$dataList);
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
        if($pList[3]->id!=3){
            return redirect('error');
       }
       $dataList=[
        'institute'=>Institute::getInstituteName(),
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$aEmployeeType
    ];
       return view('admin.basic.employeetype.edit',$dataList);  
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
