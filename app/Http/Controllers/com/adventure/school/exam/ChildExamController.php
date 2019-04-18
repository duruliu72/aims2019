<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\exam\ChildExam;
use App\com\adventure\school\menu\Menu;
class ChildExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        $aList=ChildExam::all();
        $dataList=['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList];
        return view('admin.exam.childexam.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        $dataList=[
            'sidebarMenu'=>$sidebarMenu
        ];
        if($pList[2]->id!=2){
            return redirect('error'); 
        }
    	return view('admin.exam.childexam.create',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'name' => 'required|unique:child_exam|max:255',
    	]);
     	$name=$request->name;
     	$obj=new ChildExam();
     	$obj->name=$name;
     	$status=$obj->save();
     	if($status){
     		$msg="Child Exam Created Successfully";
		  }else{
		    $msg="Child Exam not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
    	$obj=MasterExam::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$obj
        ];
       return view('admin.exam.childexam.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:child_exam|max:255',
    	]);
    	$name=$request->name;
     	$obj=ChildExam::findOrfail($id);
     	$obj->name=$name;
     	$status=$obj->update();
     	if($status){
     		$msg="Child Exam Updated Successfully";
		  }else{
		    $msg="Child Exam not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
