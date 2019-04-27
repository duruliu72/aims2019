<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\LocalGov;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\menu\Menu;
class LocalGovController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('localgov');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('localgov');
        $aLocalGov=new LocalGov();
        $aList=$aLocalGov->getAllLocalGov();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.localgov.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('localgov');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('localgov');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $thanaList=Thana::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'thanaList'=>$thanaList,
        ];
        return view('admin.basic.localgov.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:localgovs|max:255',
        'thanaid' => 'required',
    	]);
     	$name=$request->name;
     	$thanaid=$request->thanaid;
     	$aLocalGov=new LocalGov();
     	$aLocalGov->name=$name;
     	$aLocalGov->thanaid=$thanaid;
     	$status=$aLocalGov->save();
     	if($status){
     		$msg="Union Created Successfully";
		  }else{
		    $msg="Union Office not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('localgov');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('localgov');
    	$aLocalGov=LocalGov::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $thanaList=Thana::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'thanaList'=>$thanaList,
            'bean'=>$aLocalGov
        ];
        return view('admin.basic.localgov.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:localgovs|max:255',
        'thanaid' => 'required',
    	]);
    	$name=$request->name;
    	$thanaid=$request->thanaid;
     	$aLocalGov=LocalGov::findOrfail($id);
     	$aLocalGov->name=$name;
     	$aLocalGov->thanaid=$thanaid;
     	$status=$aLocalGov->update();
     	if($status){
     		$msg="Union Updated Successfully";
		  }else{
		    $msg="Union not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
