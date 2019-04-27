<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\BloodGroup;
use App\com\adventure\school\menu\Menu;
class BloodGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('bloodgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('bloodgroup');
    	$aList=BloodGroup::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
        return view('admin.basic.bloodgroup.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('bloodgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('bloodgroup');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.basic.bloodgroup.create',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'name' => 'required|unique:blood_groups|max:255',
    	]);

     	$name=$request->name;
     	$aBloodGroup=new BloodGroup();
     	$aBloodGroup->name=$name;
     	$status=$aBloodGroup->save();
     	if($status){
     		$msg="Blood Group Created Successfully";
		  }else{
		    $msg="Blood Group not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('bloodgroup');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('bloodgroup');
         if($pList[3]->id!=3){
            return redirect('error');
         }
         $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aBloodGroup
        ];
        $aBloodGroup=BloodGroup::findOrfail($id);
        return view('admin.basic.bloodgroup.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:blood_groups|max:255',
    	]);
    	$name=$request->name;
     	$aBloodGroup=BloodGroup::findOrfail($id);
     	$aBloodGroup->name=$name;
     	$status=$aBloodGroup->update();
     	if($status){
     		$msg="Blood Group Updated Successfully";
		  }else{
		    $msg="Blood Group not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
