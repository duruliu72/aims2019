<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\menu\Menu;
class PLevelControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
    	$aList=PLevel::all();
    	return view('admin.programsettings.level.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        if($pList[2]->id==2){
            return view('admin.programsettings.level.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programlevels|max:255',
    	]);
     	$name=$request->name;
     	$aProgramLevel=new PLevel();
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->save();
     	if($status){
     		$msg="Level Created Successfully";
		  }else{
		    $msg="Level not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
    	$aProgramLevel=PLevel::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.level.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aProgramLevel]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:programlevels|max:255',
    	]);
    	$name=$request->name;
     	$aProgramLevel=PLevel::findOrfail($id);
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->update();
     	if($status){
     		$msg="Level Updated Successfully";
		  }else{
		    $msg="Level not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
