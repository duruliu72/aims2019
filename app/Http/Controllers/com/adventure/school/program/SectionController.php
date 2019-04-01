<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\menu\Menu;
class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sections');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sections');
    	$aList=Section::all();
    	return view('admin.programsettings.section.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sections');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sections');
        if($pList[2]->id==2){
            return view('admin.programsettings.section.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:sections|max:255',
    	]);
     	$name=$request->name;
     	$aSection=new Section();
     	$aSection->name=$name;
     	$status=$aSection->save();
     	if($status){
     		$msg="Section Created Successfully";
		  }else{
		    $msg="Section not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sections');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sections');
    	$aSection=Section::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.section.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aSection]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:sections|max:255',
    	]);
    	$name=$request->name;
     	$aSection=Section::findOrfail($id);
     	$aSection->name=$name;
     	$status=$aSection->update();
     	if($status){
     		$msg="Section Updated Successfully";
		  }else{
		    $msg="Section not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
