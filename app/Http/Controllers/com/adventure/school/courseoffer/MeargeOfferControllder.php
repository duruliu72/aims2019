<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $courseCodeList=$aMeargeOffer->getCourseCodes($sessionid);
        $meargeList=Mearge::all();
        $aList=$aMeargeOffer->meargeDetails();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList,
            'programList'=>$aMeargeOffer->getProgramsOnSession($sessionid),
            'groupList'=>$aMeargeOffer->getGroupsOnSession($sessionid),
            'mediumList'=>$aMeargeOffer->getMediumsOnSession($sessionid),
            'shiftList'=>$aMeargeOffer->getShiftsOnSession($sessionid),
            'courseCodeList'=>$courseCodeList,
            'meargeList'=>$meargeList,
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
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
     	$shiftid=$request->shiftid;     	
        $firstsubjectcodeid=$request->firstsubjectcodeid;
        $secondsubjectcodeid=$request->secondsubjectcodeid;
        $meargeid=$request->meargeid;
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $status=$this->doTransaction($programofferid,$firstsubjectcodeid,$secondsubjectcodeid,$meargeid);
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
    private function doTransaction($programofferid,$firstsubjectcodeid,$secondsubjectcodeid,$meargeid){
        try{
            \DB::transaction(function () use($programofferid,$firstsubjectcodeid,$secondsubjectcodeid,$meargeid){
                \DB::table('courseoffer')
                ->where('programofferid', $programofferid)
                ->where('coursecodeid', $firstsubjectcodeid)
                ->update(['meargeid' => $meargeid]);
                \DB::table('courseoffer')
                ->where('programofferid', $programofferid)
                ->where('coursecodeid', $secondsubjectcodeid)
                ->update(['meargeid' => $meargeid]);
            });
            return true;
        }catch( \PDOException $e ){
            return false;
        }catch( \Exception $e ){
            return false;
        }
    }
    
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
                $this->getGroupsOnSessionAndProgram($programid);
            }elseif($methodid==2){
                $this->getMediumsOnSessionAndProgram($programid);
            }elseif($methodid==3){
                $this->getShiftsOnSessionAndProgram($programid);
            }
        }elseif($option=="group"){
            if($methodid==1){
                $this->getMediumsOnSessionAndPrograAndGroup($programid,$groupid);
            }elseif($methodid==2){
                $this->getShiftsOnSessionAndPrograAndGroup($programid,$groupid);
            }
        }elseif($option=="medium"){
            if($methodid==1){
                $this->getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid);
            }
        }elseif($option=="shift"){
            if($methodid==1){
                $this->getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid);
            }elseif($methodid==2){
                $this->getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid);
            }
        }
    }
    private function getGroupsOnSessionAndProgram($programid){
       $aMeargeOffer=new MeargeOffer();
       $result=$aMeargeOffer->getGroupsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndProgram($programid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getMediumsOnSessionAndProgram(0,$programid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndProgram($programid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getShiftsOnSessionAndProgram(0,$programid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
        $aMeargeOffer=new MeargeOffer();
        $result=$aMeargeOffer->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
}
// $sessionid,$programid,$groupid,$mediumid,$shiftid
