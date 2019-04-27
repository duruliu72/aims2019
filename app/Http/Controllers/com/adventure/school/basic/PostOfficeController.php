<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\PostOffice;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\menu\Menu;
class PostOfficeController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('postoffice');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('postoffice');
        $aPostOffice=new PostOffice();
        $aList=$aPostOffice->getAllPostOffice();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.postoffice.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('postoffice');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('postoffice');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $thanaList=Thana::all();
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'thanaList'=>$thanaList,
        ];
        return view('admin.basic.postoffice.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:postoffices|max:255',
        'thanaid' => 'required',
    	]);
     	$name=$request->name;
     	$thanaid=$request->thanaid;
     	$aPostOffice=new PostOffice();
     	$aPostOffice->name=$name;
     	$aPostOffice->thanaid=$thanaid;
     	$status=$aPostOffice->save();
     	if($status){
     		$msg="Post Office Created Successfully";
		  }else{
		    $msg="Post Office not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('postoffice');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('postoffice');
    	$aPostOffice=PostOffice::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $thanaList=Thana::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'thanaList'=>$thanaList,
            'bean'=>$aPostOffice
        ];
        return view('admin.basic.postoffice.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:postoffices|max:255',
        'thanaid' => 'required',
    	]);
    	$name=$request->name;
    	$divisionid=$request->divisionid;
     	$aPostOffice=PostOffice::findOrfail($id);
     	$aPostOffice->name=$name;
     	$aPostOffice->thanaid=$thanaid;
     	$status=$aPostOffice->update();
     	if($status){
     		$msg="Post Office Updated Successfully";
		  }else{
		    $msg="Post Office not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
