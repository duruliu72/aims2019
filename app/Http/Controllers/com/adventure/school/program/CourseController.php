<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\Course;
use App\com\adventure\school\menu\Menu;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
    	$aList=Course::all();
    	return view('admin.programsettings.course.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
        if($pList[2]->id==2){
            return view('admin.programsettings.course.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:courses|max:255',
    	]);
     	$name=$request->name;
     	$aCourse=new Course();
     	$aCourse->name=$name;
     	$status=$aCourse->save();
     	if($status){
     		$msg="Course Created Successfully";
		  }else{
		    $msg="Course not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
    	$aCourse=Course::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.programsettings.course.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aCourse]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:courses|max:255',
    	]);
    	$name=$request->name;
     	$aCourse=Course::findOrfail($id);
     	$aCourse->name=$name;
     	$status=$aCourse->update();
     	if($status){
     		$msg="Course Updated Successfully";
		  }else{
		    $msg="Course not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
