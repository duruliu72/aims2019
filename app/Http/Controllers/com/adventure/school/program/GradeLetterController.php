<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\GradeLetter;
use App\com\adventure\school\menu\Menu;
class GradeLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gradeletter');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gradeletter');
    	$aList=GradeLetter::all();
    	return view('admin.programsettings.gradeletter.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gradeletter');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gradeletter');
        if($pList[2]->id!=2){
            return redirect('error');
            
        }
        return view('admin.programsettings.gradeletter.create',['sidebarMenu'=>$sidebarMenu]);
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:grade_letter|max:255',
    	]);
     	$name=$request->name;
     	$gradeLetterObj=new GradeLetter();
     	$gradeLetterObj->name=$name;
     	$status=$gradeLetterObj->save();
     	if($status){
     		$msg="Grade Letter Created Successfully";
		  }else{
		    $msg="Grade Letter not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gradeletter');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gradeletter');
    	$gradeLetterObj=GradeLetter::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
           
       }
       return view('admin.programsettings.gradeletter.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$gradeLetterObj]); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:grade_letter|max:255',
    	]);
    	$name=$request->name;
     	$gradeLetterObj=GradeLetter::findOrfail($id);
     	$gradeLetterObj->name=$name;
     	$status=$gradeLetterObj->update();
     	if($status){
     		$msg="Grade Letter Updated Successfully";
		  }else{
		    $msg="Grade Letter not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
