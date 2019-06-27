<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\courseoffer\Mearge;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\MeargeOffer;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\menu\Menu;

class MeargeOfferControllder extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('meargeoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('meargeoffer');
        $aMeargeOffer=new MeargeOffer();
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aMeargeOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMeargeOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMeargeOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMeargeOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $courseCodeList=$aMeargeOffer->getCourseCodes($sessionid);
        $aList=$aMeargeOffer->meargeDetails();
        // dd($aList);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
            'result'=>$aList,
            'courseCodeList'=>$courseCodeList,
            'msg'=>$msg
        ];
    	return view('admin.courseoffer.meargeoffer.index',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
        ]);
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
     	$shiftid=$request->shiftid;     	
        $firstsubjectcodeid=$request->firstsubjectcodeid;
        $secondsubjectcodeid=$request->secondsubjectcodeid;
        // $meargeid=$request->meargeid;
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $status=$this->doTransaction($programofferid,$firstsubjectcodeid,$secondsubjectcodeid);
     	if($status){
     		$msg="Mearging Successfully";
		  }else{
		    $msg="not Mearging";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function destroy(Request $request)
    {
        $programofferid=$request->programofferid;
        $coursecodeidList=explode(',',$request->meargeCourseCodeid);
        foreach($coursecodeidList as $coursecodeid){
            \DB::table('courseoffer')
                ->where('programofferid', $programofferid)
                ->where('coursecodeid', (int)$coursecodeid)
                ->update(['meargeid' => 0]);
        }
        $msg="Mearging Deleted";
        return redirect()->back()->with('msg',$msg);
    }
    private function doTransaction($programofferid,$firstsubjectcodeid,$secondsubjectcodeid){
        try{
            \DB::transaction(function () use($programofferid,$firstsubjectcodeid,$secondsubjectcodeid){
                \DB::table('courseoffer')
                ->where('programofferid', $programofferid)
                ->where('coursecodeid', $firstsubjectcodeid)
                ->update(['meargeid' => $firstsubjectcodeid]);
                \DB::table('courseoffer')
                ->where('programofferid', $programofferid)
                ->where('coursecodeid', $secondsubjectcodeid)
                ->update(['meargeid' => $firstsubjectcodeid]);
            });
            return true;
        }catch( \PDOException $e ){
            return false;
        }catch( \Exception $e ){
            return false;
        }
    }
     // For Ajax Call ===============
   //    ================================================================
   public function getValue(Request $request){
    $option=$request->option;
    $methodid=$request->methodid;
    $programid=$request->programid;
    $groupid=$request->groupid;
    $mediumid=$request->mediumid;
    $shiftid=$request->shiftid;
    if($option=="program"){
        if($methodid==1){
            $this->getAllOnIDS(0,$programid,0,0,0,"mediums",'mediumid');
        }elseif($methodid==2){
            $this->getAllOnIDS(0,$programid,0,0,0,"shifts",'shiftid');
        }elseif($methodid==3){
            $this->getAllOnIDS(0,$programid,0,0,0,"groups",'groupid');
        }
    }elseif($option=="group"){
        if($methodid==1){
            $this->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
        }elseif($methodid==2){
            $this->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
        }
    }elseif($option=="medium"){
        if($methodid==1){
            $this->getAllOnIDS(0,$programid,0,$mediumid,0,"shifts",'shiftid');
        }elseif($methodid==2){
            $this->getAllOnIDS(0,$programid,0,$mediumid,0,"groups",'groupid');
        }
    }elseif($option=="shift"){
        if($methodid==1){
            $this->getAllOnIDS(0,$programid,0,$mediumid,$shiftid,"groups",'groupid');
        }
    }
}
private function getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
    $aMeargeOffer=new MeargeOffer();
    $result=$aMeargeOffer->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
    private function getCourseCodesOnProgramOffer($sessionid,$programid,$groupid,$mediumid,$shiftid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getCourseCodesOnProgramOffer($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
