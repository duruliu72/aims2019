<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\menu\Menu;
class ExamNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('examname');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('examname');
        $aList=ExamName::getAll();
        $dataList=['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList];
        return view('admin.exam.examname.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('examname');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('examname');
        $dataList=[
            'sidebarMenu'=>$sidebarMenu
        ];
        if($pList[2]->id!=2){
            return redirect('error'); 
        }
    	return view('admin.exam.examname.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:exam_name|max:255',
        'examtypeid'=>'required'
    	]);
        $name=$request->name;
        $examtypeid=$request->examtypeid;
     	$obj=new ExamName();
        $obj->name=$name;
        $obj->examtypeid=$examtypeid;
     	$status=$obj->save();
     	if($status){
     		$msg="Exam Created Successfully";
		  }else{
		    $msg="Exam not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('examname');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('examname');
    	$obj=ExamName::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$obj
        ];
       return view('admin.exam.examname.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|max:255',
        'examtypeid'=>'required'
    	]);
        $name=$request->name;
        $examtypeid=$request->examtypeid;
     	$obj=ExamName::findOrfail($id);
        $obj->name=$name;
        $obj->examtypeid=$examtypeid;
     	$status=$obj->update();
     	if($status){
     		$msg="Exam Updated Successfully";
		  }else{
		    $msg="Exam not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
