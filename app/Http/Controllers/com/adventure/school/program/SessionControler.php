<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\menu\Menu;
class SessionControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('session');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('session');
    	$aList=Session::all();
    	return view('admin.programsettings.session.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('session');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('session');
        if($pList[2]->id==2){
            return view('admin.programsettings.session.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:sessions|max:255',
    	]);
     	$name=$request->name;
     	$aSession=new Session();
     	$aSession->name=$name;
     	$status=$aSession->save();
     	if($status){
     		$msg="Session Created Successfully";
		  }else{
		    $msg="Session not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('session');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('session');
    	$aSession=Session::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.session.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aSession]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:sessions|max:255',
    	]);
    	$name=$request->name;
     	$aSession=Session::findOrfail($id);
     	$aSession->name=$name;
     	$status=$aSession->update();
     	if($status){
     		$msg="Session Updated Successfully";
		  }else{
		    $msg="Session not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
