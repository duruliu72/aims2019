<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\Nationality;
use App\com\adventure\school\menu\Menu;
class NationalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('nationality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('nationality');
        $quotaList=Nationality::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$quotaList
        ];
    	return view('admin.basic.nationality.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('nationality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('nationality');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.basic.nationality.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:nationalities|max:255',
    	]);
     	$name=$request->name;
     	$aNationality=new Nationality();
     	$aNationality->name=$name;
     	$status=$aNationality->save();
     	if($status){
     		$msg="Nationality Created Successfully";
		  }else{
		    $msg="Nationality not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('nationality');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('nationality');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aNationality=Nationality::findOrfail($id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aNationality
        ];
        return view('admin.basic.nationality.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:nationalities|max:255',
    	]);
    	$name=$request->name;
     	$aNationality=Nationality::findOrfail($id);
     	$aNationality->name=$name;
     	$status=$aNationality->update();
     	if($status){
     		$msg="Nationaity Updated Successfully";
		  }else{
		    $msg="Nationaity not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
