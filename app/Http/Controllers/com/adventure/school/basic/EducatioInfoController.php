<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EducationInfo;
class EducatioInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationquality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationquality');
    	$aList=EducationQuality::all();
    	return view('admin.basic.educationquality.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationquality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationquality');
        if($pList[2]->id==2){
            return view('admin.basic.educationquality.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:education_qualities|max:255',
    	]);
     	$name=$request->name;
     	$aEducationQuality=new EducationQuality();
     	$aEducationQuality->name=$name;
     	$status=$aEducationQuality->save();
     	if($status){
     		$msg="Education Quality Created Successfully";
		  }else{
		    $msg="Education Quality not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationquality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationquality');
    	$aEducationQuality=EducationQuality::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.educationquality.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aEducationQuality]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:education_qualities|max:255',
    	]);
    	$name=$request->name;
     	$aEducationQuality=EducationQuality::findOrfail($id);
     	$aEducationQuality->name=$name;
     	$status=$aEducationQuality->update();
     	if($status){
     		$msg="Education Quality Updated Successfully";
		  }else{
		    $msg="Education Quality not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
