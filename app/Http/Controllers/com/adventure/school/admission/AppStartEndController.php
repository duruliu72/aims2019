<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\admission\AppStartEnd;

class AppStartEndController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('startend');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('startend');
        $aList=AppStartEnd::getAll();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.admissionsettings.appstartend.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('startend');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('startend');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $sessionList=Session::all();
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList
        ];
        return view('admin.admissionsettings.appstartend.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'sessionid' => 'required',
        'app_startDate' => 'required',
        'app_endDate' => 'required',
    	]);
        $sessionid=$request->sessionid;
        $app_startDate=$request->app_startDate;
        $app_endDate=$request->app_endDate;
        $examStartDate=$request->examStartDate;
     	$aAppStartEnd=new AppStartEnd();
     	$aAppStartEnd->sessionid=$sessionid;
        $aAppStartEnd->app_startDate=date("Y-m-d",strtotime($app_startDate));
        $aAppStartEnd->app_endDate=date("Y-m-d",strtotime($app_endDate));
        if($examStartDate!=""){
            $aAppStartEnd->examStartDate=date("Y-m-d",strtotime($examStartDate));
        }
     	$status=$aAppStartEnd->save();
     	if($status){
     		$msg="Created Successfully";
		  }else{
		    $msg="not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('startend');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('startend');
        if($pList[3]->id!=3){
        	return redirect('error');
        }
        $aAppStartEnd=AppStartEnd::findOrfail($id);
        $sessionList=Session::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            'bean'=>$aAppStartEnd
        ];
        return view('admin.admissionsettings.appstartend.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
            'sessionid' => 'required',
            'app_startDate' => 'required',
            'app_endDate' => 'required',
        ]);
    	$sessionid=$request->sessionid;
        $app_startDate=$request->app_startDate;
        $app_endDate=$request->app_endDate;
        $examStartDate=$request->examStartDate;
        $aAppStartEnd=AppStartEnd::findOrfail($id);
        $aAppStartEnd->sessionid=$sessionid;
        $aAppStartEnd->app_startDate=date("Y-m-d",strtotime($app_startDate));
        $aAppStartEnd->app_endDate=date("Y-m-d",strtotime($app_endDate));
        if($examStartDate!=""){
            $aAppStartEnd->examStartDate=date("Y-m-d",strtotime($examStartDate));
        }
     	$status=$aAppStartEnd->update();
     	if($status){
     		$msg="Updated Successfully";
		  }else{
		    $msg="not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
