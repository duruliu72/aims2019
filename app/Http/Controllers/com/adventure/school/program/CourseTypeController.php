<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\CourseType;
use App\com\adventure\school\menu\Menu;
class CourseTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursetype');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursetype');
    	$aList=CourseType::all();
    	return view('admin.programsettings.coursetype.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursetype');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursetype');
        if($pList[2]->id==2){
            return view('admin.programsettings.coursetype.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:course_type|max:255',
    	]);
     	$name=$request->name;
     	$aCourseType=new CourseType();
     	$aCourseType->name=$name;
     	$status=$aCourseType->save();
     	if($status){
     		$msg="Course Type Created Successfully";
		  }else{
		    $msg="Course Type not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursetype');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursetype');
    	$aCourseType=CourseType::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.coursetype.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aCourseType]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:course_type|max:255',
    	]);
    	$name=$request->name;
     	$aCourseType=CourseType::findOrfail($id);
     	$aCourseType->name=$name;
     	$status=$aCourseType->update();
     	if($status){
     		$msg="Course Type Updated Successfully";
		  }else{
		    $msg="Course Type not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
