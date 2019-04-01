<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\program\MarkCategory;
use App\com\adventure\school\menu\Menu;
class MarkCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('markcategory');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('markcategory');
        $aList=MarkCategory::all();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.markcategory.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('markcategory');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('markcategory');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.programsettings.markcategory.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:mark_categories|max:255',
    	]);
     	$name=$request->name;
     	$aMarkCategory=new MarkCategory();
     	$aMarkCategory->name=$name;
     	$status=$aMarkCategory->save();
     	if($status){
     		$msg="Mark Category Successfully";
		  }else{
		    $msg="Mark Category not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('markcategory');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('markcategory');
    	$aMarkCategory=MarkCategory::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
       }
       $dataList=[
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$aMarkCategory
        ];
        return view('admin.programsettings.markcategory.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:mark_categories|max:255',
    	]);
    	$name=$request->name;
     	$aMarkCategory=MarkCategory::findOrfail($id);
     	$aMarkCategory->name=$name;
     	$status=$aMarkCategory->update();
     	if($status){
     		$msg="Mark Category Updated Successfully";
		  }else{
		    $msg="Mark Category not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
