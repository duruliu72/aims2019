<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\menu\Menu;
class PLabelControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createLabel(Request $request){
        // die("Die Here");
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        if($request->isMethod('post')&&$request->btn_save=='btn_save'){
            $validatedData = $request->validate([
                'courseCode' => 'required|unique:courses|max:255',
                'programlavelid'=>'required',
                ]);
                 $courseName=$request->courseName;
                 $courseCode=$request->courseCode;
                 $programlavelid=$request->programlavelid;
                 $aCourse=new PLevel();
                 $aCourse->courseName=$courseName;
                 $aCourse->courseCode=$courseCode;
                 $aCourse->programlavelid=$programlavelid;
                 $status=$aCourse->save();
                 if($status){
                     $msg="Course Created Successfully";
                  }else{
                    $msg="Course not Created";
                }
                return redirect()->back()->with('msg',$msg);
        }
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            $validatedData = $request->validate([
                'programlavelid'=>'required',
            ]);
            $id=$request->id;
            // dd($id);
            $aCourse=Course::findOrfail($id);
            $aCourse->courseName=$request->courseName;
            $aCourse->courseCode=$request->courseCode;
            $aCourse->programlavelid=$request->programlavelid;
            $status=$aCourse->update();
            if($status){
                $msg="Course Updated Successfully";
            }else{
                $msg="Course not Updated";
            }
            return redirect()->back()->with('msg',$msg);
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
        $plavelList=PLevel::all();
        $bean=null;
        $id=$request->id;
        if($id!=null){
            // if($pList[3]->id!=3){
            //     return redirect('error');
            // }
            $bean=Course::findOrfail($id);
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'plevelList'=>$plavelList,
            'bean'=>$bean
        ];
    	return view('admin.programsettings.label.program_label',$dataList);
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        $aList=PLevel::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.level.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.level.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programlevels|max:255',
    	]);
     	$name=$request->name;
     	$aProgramLevel=new PLevel();
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->save();
     	if($status){
     		$msg="Level Created Successfully";
		  }else{
		    $msg="Level not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
    	$aProgramLevel=PLevel::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aProgramLevel
        ];
        return view('admin.programsettings.level.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$name=$request->name;
     	$aProgramLevel=PLevel::findOrfail($id);
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->update();
     	if($status){
     		$msg="Level Updated Successfully";
		  }else{
		    $msg="Level not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
