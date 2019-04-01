<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Gender;
use App\com\adventure\school\menu\Menu;
class GenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gender');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gender');
    	$genderList=Gender::all();
    	return view('admin.basic.gender.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$genderList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gender');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gender');
        if($pList[2]->id==2){
            return view('admin.basic.gender.create',['sidebarMenu'=>$sidebarMenu]); 
       }else{
            return redirect('error');
       }
    	
    }
    public function store(Request $request){
    	$msg="";
    	$name=$request->name;
    	if($name==""){
    	   $msg="Name must not Empty";
    	   return redirect()->back()->with('msg',$msg);
    	}
        $hasItem=\DB::table('genders')
	    ->select('genders.*')
	    ->where('name',$name)
	    ->exists();
	    if(!$hasItem){
	    	$aGender=new Gender();
        	$aGender->name=$name;
      		$status=$aGender->save();
      		if($status){
     			$msg="Gender Created Successfully";
		     	}else{
		     		$msg="Gender not Created";
		     	}
		    }else{
		    	$msg="This item already assign";
		    }
		return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('gender');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('gender');
        if($pList[3]->id==3){
            $aGender=Gender::findOrfail($id);
            return view('admin.basic.gender.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aGender]);
        }else{
            return redirect('error');
        }
    	
    }
    public function update(Request $request, $id){
        $aGender=Gender::findOrfail($id);
        $msg="";
        $name=$request->name;
        if($name==""){
           $msg="Name must not Empty";
           return redirect()->back()->with('msg',$msg);
        }
        $hasItem=\DB::table('genders')
        ->select('genders.*')
        ->where('name',$name)
        ->exists();
        if(!$hasItem){
            $aGender->name=$request->name;
            $status=$aGender->update();
            if($status){
                $msg="Gender Update Successfully";
                }else{
                    $msg="Gender not Updated";
                }
            }else{
                $msg="This item already exit";
            }
        return redirect()->back()->with('msg',$msg);
    }
}
