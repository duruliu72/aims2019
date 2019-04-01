<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EducationDegree;
class EducationDegreeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationdegree');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationdegree');
    	$aList=EducationDegree::all();
    	return view('admin.basic.educationdegree.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationdegree');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationdegree');
        if($pList[2]->id==2){
            return view('admin.basic.educationdegree.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:education_degree|max:255',
    	]);
     	$name=$request->name;
     	$aEducationDegree=new EducationDegree();
     	$aEducationDegree->name=$name;
     	$status=$aEducationDegree->save();
     	if($status){
     		$msg="Education Quality Created Successfully";
		  }else{
		    $msg="Education Quality not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('educationdegree');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('educationdegree');
    	$aEducationDegree=EducationDegree::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.educationdegree.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aEducationDegree]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:education_degree|max:255',
    	]);
    	$name=$request->name;
     	$aEducationDegree=EducationDegree::findOrfail($id);
     	$aEducationDegree->name=$name;
     	$status=$aEducationDegree->update();
     	if($status){
     		$msg="Education Degree Updated Successfully";
		  }else{
		    $msg="Education Degree not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
