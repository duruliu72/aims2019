<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\menu\Menu;
class ThanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('thana');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('thana');
        $aThana=new Thana();
        $aList=$aThana->getAllThana();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.thana.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('thana');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('thana');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $districtList=District::all();
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'districtList'=>$districtList
        ];
        return view('admin.basic.thana.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:thanas|max:255',
        'districtid' => 'required',
    	]);
     	$name=$request->name;
     	$districtid=$request->districtid;
     	$aThana=new Thana();
     	$aThana->name=$name;
     	$aThana->districtid=$districtid;
     	$status=$aThana->save();
     	if($status){
     		$msg="Thana Created Successfully";
		  }else{
		    $msg="Thana not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('district');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('district');
    	$aThana=Thana::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $districtList=District::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'districtList'=>$districtList,
            'bean'=>$aThana
        ];
        return view('admin.basic.thana.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:districts|max:255',
        'divisionid' => 'required',
    	]);
    	$name=$request->name;
    	$divisionid=$request->divisionid;
     	$aDistrict=District::findOrfail($id);
     	$aDistrict->name=$name;
     	$aDistrict->divisionid=$divisionid;
     	$status=$aDistrict->update();
     	if($status){
     		$msg="Thana Updated Successfully";
		  }else{
		    $msg="Thana not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
