<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Quota;
use App\com\adventure\school\menu\Menu;
class QuotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('quota');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('quota');
    	$quotaList=Quota::all();
    	return view('admin.basic.quota.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$quotaList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('quota');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('quota');
        if($pList[2]->id==2){
            return view('admin.basic.quota.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:quotas|max:255',
    	]);
     	$name=$request->name;
     	$aQuota=new Quota();
     	$aQuota->name=$name;
     	$status=$aQuota->save();
     	if($status){
     		$msg="Quota Created Successfully";
		  }else{
		    $msg="Quota not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('quota');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('quota');
        if($pList[3]->id==3){
            $aQuota=Quota::findOrfail($id);
            return view('admin.basic.quota.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aQuota]);
        }else{
            return redirect('error');
        }
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:quotas|max:255',
    	]);
    	$name=$request->name;
     	$aQuota=Quota::findOrfail($id);
     	$aQuota->name=$name;
     	$status=$aQuota->update();
     	if($status){
     		$msg="Quota Updated Successfully";
		  }else{
		    $msg="Quota not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
