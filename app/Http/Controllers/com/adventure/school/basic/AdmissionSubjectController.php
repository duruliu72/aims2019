<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\AdmissionSubject;
use App\com\adventure\school\menu\Menu;
class AdmissionSubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionsubject');
        $aList=AdmissionSubject::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.admissionsubject.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionsubject');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.basic.admissionsubject.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:admission_subjects|max:255',
    	]);
     	$name=$request->name;
     	$aAdmissionSubject=new AdmissionSubject();
     	$aAdmissionSubject->name=$name;
     	$status=$aAdmissionSubject->save();
     	if($status){
     		$msg="Admission Subject Created Successfully";
		  }else{
		    $msg="Admission Subject not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionsubject');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionsubject');
        $aAdmissionSubject=AdmissionSubject::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
        'institute'=>Institute::getInstituteName(),
        'sidebarMenu'=>$sidebarMenu,
        'bean'=>$aAdmissionSubject
        ];
        return view('admin.basic.admissionsubject.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:admission_subjects|max:255',
    	]);
    	$name=$request->name;
     	$aAdmissionSubject=AdmissionSubject::findOrfail($id);
     	$aAdmissionSubject->name=$name;
     	$status=$aAdmissionSubject->update();
     	if($status){
     		$msg="Admission Subject Updated Successfully";
		  }else{
		    $msg="Admission Subject not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
