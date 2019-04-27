<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\basic\Division;
use App\com\adventure\school\menu\Menu;
class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('district');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('district');
        $aDistrict=new District();
        $aList=$aDistrict->getAllDistrict();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.district.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('district');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('district');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $divisionList=Division::all();
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'divisionList'=>$divisionList
        ];
        return view('admin.basic.district.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:districts|max:255',
        'divisionid' => 'required',
    	]);
     	$name=$request->name;
     	$divisionid=$request->divisionid;
     	$aDistrict=new District();
     	$aDistrict->name=$name;
     	$aDistrict->divisionid=$divisionid;
     	$status=$aDistrict->save();
     	if($status){
     		$msg="Districts Created Successfully";
		  }else{
		    $msg="Districts not Created";
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
    	$aDistrict=District::findOrfail($id);
        if($pList[3]->id!=3){
        	return redirect('error');
        }
        $divisionList=Division::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'divisionList'=>$divisionList,
            'bean'=>$aDistrict
        ];
        return view('admin.basic.district.edit',$dataList); 
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
     		$msg="Dstrict Updated Successfully";
		  }else{
		    $msg="District not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
