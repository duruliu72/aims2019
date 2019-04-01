<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Division;
use App\com\adventure\school\menu\Menu;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('division');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('division');
    	$aList=Division::all();
    	return view('admin.basic.division.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('division');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('division');
        if($pList[2]->id==2){
            return view('admin.basic.division.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:divisions|max:255',
    	]);
     	$name=$request->name;
     	$aDivision=new Division();
     	$aDivision->name=$name;
     	$status=$aDivision->save();
     	if($status){
     		$msg="Divison Created Successfully";
		  }else{
		    $msg="Divison not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('division');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('division');
    	$aDivision=Division::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.division.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aDivision]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:divisions|max:255',
    	]);
    	$name=$request->name;
     	$aDivision=Division::findOrfail($id);
     	$aDivision->name=$name;
     	$status=$aDivision->update();
     	if($status){
     		$msg="Division Updated Successfully";
		  }else{
		    $msg="Division not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
