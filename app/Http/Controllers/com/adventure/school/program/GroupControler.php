<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\menu\Menu;
class GroupControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('group');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('group');
    	$aList=Group::all();
    	return view('admin.programsettings.group.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('group');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('group');
        if($pList[2]->id==2){
            return view('admin.programsettings.group.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:groups|max:255',
    	]);
     	$name=$request->name;
     	$aGroup=new Group();
     	$aGroup->name=$name;
     	$status=$aGroup->save();
     	if($status){
     		$msg="Group Created Successfully";
		  }else{
		    $msg="Group not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('group');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('group');
    	$aGroup=Group::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.group.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGroup]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:groups|max:255',
    	]);
    	$name=$request->name;
     	$aGroup=Group::findOrfail($id);
     	$aGroup->name=$name;
     	$status=$aGroup->update();
     	if($status){
     		$msg="Group Updated Successfully";
		  }else{
		    $msg="Group not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
