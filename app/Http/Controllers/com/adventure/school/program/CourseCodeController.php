<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Course;
use App\com\adventure\school\program\CourseCode;
class CourseCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursecode');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursecode');
        $aCourseCode=new CourseCode();
        $aList=$aCourseCode->getAllCourse();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.coursecode.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursecode');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursecode');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $courseList=Course::all();
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'courseList'=>$courseList
        ];
        return view('admin.programsettings.coursecode.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:course_codes|max:255',
        'courseid' => 'required',
    	]);
     	$name=$request->name;
     	$courseid=$request->courseid;
     	$aCourseCode=new CourseCode();
     	$aCourseCode->name=$name;
     	$aCourseCode->courseid=$courseid;
     	$status=$aCourseCode->save();
     	if($status){
     		$msg="Course Code Created Successfully";
		  }else{
		    $msg="Course Code not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('coursecode');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('coursecode');
    	$aCourseCode=CourseCode::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $courseList=Course::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aCourseCode,
            'courseList'=>$courseList
        ];
        return view('admin.programsettings.coursecode.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:course_codes|max:255',
        'courseid' => 'required',
    	]);
     	$aCourseCode=CourseCode::findOrfail($id);
     	$aCourseCode->name=$request->name;
     	$aCourseCode->courseid=$request->courseid;
     	$status=$aCourseCode->update();
     	if($status){
     		$msg="Course Code Updated Successfully";
		  }else{
		    $msg="Course Code not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
