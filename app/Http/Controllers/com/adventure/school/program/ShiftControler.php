<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\menu\Menu;
class ShiftControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('shift');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('shift');
        $aList=Shift::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.shift.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('shift');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('shift');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.shift.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:shifts|max:255',
    	]);
     	$name=$request->name;
        $startTime=$request->startTime;
        $endTime=$request->endTime;
     	$aShift=new Shift();
     	$aShift->name=$name;
        $aShift->startTime=date("H:i", strtotime($startTime));
        $aShift->endTime=date("H:i", strtotime($endTime));
        $hasItem=\DB::table('shifts')
        ->select('shifts.*')
        ->where('name',$aShift->name)
        ->where('startTime',$aShift->startTime)
        ->where('endTime',$aShift->startTime)
        ->exists();
        if(!$hasItem){
            $status=$aShift->save();
            if($status){
                $msg="Shift Created Successfully";
              }else{
                $msg="Shift not Created";
            }
        }else{
            $msg="This Shift Already Exist";
        }
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('shift');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('shift');
    	$aShift=Shift::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aShift
        ];
        return view('admin.programsettings.shift.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|max:100',
    	]);
    	$name=$request->name;
     	$aShift=Shift::findOrfail($id);
     	$aShift->name=$name;
        $startTime=date("H:i", strtotime($aShift->startTime));
        $endTime=date("H:i", strtotime($aShift->endTime));
     	$hasItem=\DB::table('shifts')
        ->select('shifts.*')
        ->where('name',$aShift->name)
        ->where('startTime',$aShift->startTime)
        ->where('endTime',$aShift->startTime)
        ->exists();
        if(!$hasItem){
            $status=$aShift->update();
            if($status){
                $msg="Shift Updated Successfully";
              }else{
                $msg="Shift not Updated";
            }
        }else{
            $msg="This Shift Already Exist";
        }
        return redirect()->back()->with('msg',$msg);
    }
}

