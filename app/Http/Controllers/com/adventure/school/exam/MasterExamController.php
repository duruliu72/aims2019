<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\menu\Menu;
class MasterExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function masterExamCrete(Request $request){
        $instituteName=Institute::getInstituteName();
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('masterexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('masterexam');
        if($request->isMethod('post')){
            
        }
        $aList=MasterExam::all();
        $aProgramOffer=new ProgramOffer();
        $programList=$aProgramOffer->getProgramsOnSession(0);
        $groupList=$aProgramOffer->getGroupsOnSession(0);
        $mediumList=$aProgramOffer->getMediumsOnSession(0);
        $shiftList=$aProgramOffer->getShiftsOnSession(0);
        $masterExamNameList=ExamName::getExamName(1);
        $dataList=[
            'instituteName'=>$instituteName,
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'masterExamNameList'=>$masterExamNameList,
            'pList'=>$pList,
            'result'=>$aList
        ];
        return view('admin.exam.masterexam.masterexamcreate',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('masterexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('masterexam');
        $dataList=[
            'sidebarMenu'=>$sidebarMenu
        ];
        if($pList[2]->id!=2){
            return redirect('error'); 
        }
    	return view('admin.exam.masterexam.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:master_exam|max:255',
    	]);
     	$name=$request->name;
     	$obj=new MasterExam();
     	$obj->name=$name;
     	$status=$obj->save();
     	if($status){
     		$msg="Msater Exam Created Successfully";
		  }else{
		    $msg="Master Exam not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('masterexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('masterexam');
    	$obj=MasterExam::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$obj
        ];
       return view('admin.exam.masterexam.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:master_exam|max:255',
    	]);
    	$name=$request->name;
     	$obj=MasterExam::findOrfail($id);
     	$obj->name=$name;
     	$status=$obj->update();
     	if($status){
     		$msg="Master Exam Updated Successfully";
		  }else{
		    $msg="Master Exam not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
