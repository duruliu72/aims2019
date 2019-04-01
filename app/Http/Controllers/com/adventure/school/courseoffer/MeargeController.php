<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\courseoffer\Mearge;
class MeargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mearges');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('mearges');
    	$aList=Mearge::all();
    	return view('admin.courseoffer.mearge.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mearges');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('mearges');
        if($pList[2]->id==2){
            return view('admin.courseoffer.mearge.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:mearges|max:255',
    	]);
     	$name=$request->name;
     	$aMearge=new Mearge();
     	$aMearge->name=$name;
     	$status=$aMearge->save();
     	if($status){
     		$msg="Mearge Created Successfully";
		  }else{
		    $msg="Mearge not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mearges');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('mearges');
    	$aMearge=Mearge::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.courseoffer.mearge.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMearge]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:mearges|max:255',
    	]);
    	$name=$request->name;
     	$aMearge=Mearge::findOrfail($id);
     	$aMearge->name=$name;
     	$status=$aMearge->update();
     	if($status){
     		$msg="Mearge Updated Successfully";
		  }else{
		    $msg="Mearge not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
