<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\MarkDistribution;
use App\com\adventure\school\program\MarkCategory;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\menu\Menu;

class MarkDistributionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createMarkdistribution(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('markdistribution');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('markdistribution');
        $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $programofferinfo=null;
        $courseCodeList=null;
        $markCategoryList=null;
        $markdistributionList=null;
        $selectedlist=null;
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $markCategoryList=MarkCategory::all();
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->save_btn=='save_btn'){
            if($request->save_btn=='search_btn'){
                $validatedData = $request->validate([
                    'programid' => 'required|',
                    'groupid' => 'required|',
                    'mediumid' => 'required|',
                    'shiftid' => 'required|',
                    ]);
            }
            if($request->save_btn=='save_btn'){
                $programofferid=$request->programofferid;
                $checkboxList=$request->checkbox;
                $distribution_markList=$request->distribution_mark;
                $passtypeidList=$request->passtypeid;
                if($checkboxList!=null){
                    $totalPercentage=array();
                    foreach($checkboxList as $key => $value){
                        $totalPercentage[$key]=0;
                        foreach($markCategoryList as $catid){
                            if($distribution_markList[$key][$catid->id]!=null){
                                $totalPercentage[$key]+=$distribution_markList[$key][$catid->id];
                            }
                        }
                    }
                    foreach($checkboxList as $key => $value){
                        foreach($markCategoryList as $catid){
                            $aMarkDistribution=new MarkDistribution();
                            $aMarkDistribution->programofferid=$programofferid;
                            $aMarkDistribution->coursecodeid=$key;
                            $aMarkDistribution->markcategoryid=$catid->id;
                            $aMarkDistribution->distribution_mark=$distribution_markList[$key][$catid->id];
                            $aMarkDistribution->passtypeid=$passtypeidList[$key][$catid->id];
                            $isSameCategory=$aMarkDistribution->isThereMarkCategory($programofferid,$key,$catid->id);
                            if($distribution_markList[$key][$catid->id]!=null&&!$isSameCategory&&$totalPercentage[$key]==100){
                                $aMarkDistribution->save();
                            }
                        }
                    }   
                }else{
                    $msg="Please select Course";
                }
                
            }
            $programofferinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $courseCodeList=$aCourseOffer->getCourseCodesOnProgramOffer($programofferid);
            $aMarkDistribution=new MarkDistribution();
            $markdistributionList=$aMarkDistribution->getMarkDistributionOnProgramOffer($programofferid);
            $selectedlist=array();
            foreach ($courseCodeList as $course) {
                $selectedlist[$course->id]=$aMarkDistribution->getCourseCategoryOnCourse($programofferid,$course->id);
            }
        }
        $aList=[];
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList,
            'programList'=>$aCourseOffer->getProgramsOnSession($sessionid),
            'groupList'=>$aCourseOffer->getGroupsOnSession($sessionid),
            'mediumList'=>$aCourseOffer->getMediumsOnSession($sessionid),
            'shiftList'=>$aCourseOffer->getShiftsOnSession($sessionid),
            'programofferinfo'=>$programofferinfo,
            'courseCodeList'=>$courseCodeList,
            'markCategoryList'=>$markCategoryList,
            'selectedlist'=>$selectedlist,
            'msg'=>$msg
        ];
    	return view('admin.courseoffer.markdistribution.create',$dataList);
    }
    public function editMarkdistribution(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('markdistribution');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('markdistribution');
        $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $programofferinfo=null;
        $courseCodeList=null;
        $markCategoryList=null;
        $markdistributionList=null;
        $selectedlist=null;
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $markCategoryList=MarkCategory::all();
        
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->update_btn=='update_btn'){
            if($request->save_btn=='search_btn'){
                $validatedData = $request->validate([
                    'programid' => 'required|',
                    'groupid' => 'required|',
                    'mediumid' => 'required|',
                    'shiftid' => 'required|',
                    ]);
            }
           
            if($request->update_btn=='update_btn'){
                $programofferid=$request->programofferid;
                $checkboxList=$request->checkbox;
                $distribution_markList=$request->distribution_mark;
                $passtypeidList=$request->passtypeid;
                if($checkboxList!=null){
                    $totalPercentage=array();
                    foreach($checkboxList as $key => $value){
                        $totalPercentage[$key]=0;
                        foreach($markCategoryList as $catid){
                            if($distribution_markList[$key][$catid->id]!=null){
                                $totalPercentage[$key]+=$distribution_markList[$key][$catid->id];
                            }
                        }
                    }
                    foreach($checkboxList as $key => $value){
                        foreach($markCategoryList as $catid){
                            $coursecodeid=$key;
                            $markcategoryid=$catid->id;
                            // Update only distribution_mark  and passtypeid
                            $distribution_mark=$distribution_markList[$key][$catid->id];
                            $passtypeid=$passtypeidList[$key][$catid->id];                            
                            if($distribution_markList[$key][$catid->id]!=null){
                                // Check Mark Category at  distribution_mark
                                $aMarkDistribution=new MarkDistribution();
                                $checkStatus=$aMarkDistribution->isThereMarkCategory($programofferid,$coursecodeid,$markcategoryid);
                                if($checkStatus){
                                    if($totalPercentage[$key]==100){
                                        \DB::table('mark_distribution')
                                        ->where('programofferid',$programofferid)
                                        ->where('coursecodeid',$coursecodeid)
                                        ->where('markcategoryid',$markcategoryid)
                                        ->update([
                                            'distribution_mark' => $distribution_mark,
                                            'passtypeid'=>$passtypeid
                                        ]);
                                    }else{
                                        // not save
                                    }
                                    
                                }else{
                                    if($totalPercentage[$key]==100){
                                        $aMarkDistribution->programofferid=$programofferid;
                                        $aMarkDistribution->coursecodeid=$coursecodeid;
                                        $aMarkDistribution->markcategoryid=$markcategoryid;
                                        $aMarkDistribution->distribution_mark=$distribution_mark;
                                        $aMarkDistribution->passtypeid=$passtypeid;
                                        $aMarkDistribution->save();
                                    }else{
                                        // not save
                                    }
                                }
                                
                            }else{
                                \DB::table('mark_distribution')
                                ->where('programofferid',$programofferid)
                                ->where('coursecodeid',$coursecodeid)
                                ->where('markcategoryid',$markcategoryid)
                                ->delete();
                            }
                        }
                        $msg="Update Successfully";
                    }
                }else{
                    $msg="Please select Course";
                }
                
            }
            $programofferinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $courseCodeList=$aCourseOffer->getCourseCodesOnProgramOffer($programofferid);
            $aMarkDistribution=new MarkDistribution();
            $markdistributionList=$aMarkDistribution->getMarkDistributionOnProgramOffer($programofferid);
            $selectedlist=array();
            foreach ($courseCodeList as $course) {
                $selectedlist[$course->id]=$aMarkDistribution->getCourseCategoryOnCourse($programofferid,$course->id);
            }
        }
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'programList'=>$aCourseOffer->getProgramsOnSession($sessionid),
            'groupList'=>$aCourseOffer->getGroupsOnSession($sessionid),
            'mediumList'=>$aCourseOffer->getMediumsOnSession($sessionid),
            'shiftList'=>$aCourseOffer->getShiftsOnSession($sessionid),
            'programofferinfo'=>$programofferinfo,
            'courseCodeList'=>$courseCodeList,
            'markCategoryList'=>$markCategoryList,
            'selectedlist'=>$selectedlist,
            'msg'=>$msg
        ];
    	return view('admin.courseoffer.markdistribution.edit',$dataList);
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
    // private function doTransaction($programofferid,$s){
    //     try{
    //         \DB::transaction(function () use($programofferid,$firstsubjectcodeid,$secondsubjectcodeid,$meargeid){
    //             \DB::table('courseoffer')
    //             ->where('programofferid', $programofferid)
    //             ->where('coursecodeid', $firstsubjectcodeid)
    //             ->update(['meargeid' => $meargeid]);
    //             \DB::table('courseoffer')
    //             ->where('programofferid', $programofferid)
    //             ->where('coursecodeid', $secondsubjectcodeid)
    //             ->update(['meargeid' => $meargeid]);
    //         });
    //         return true;
    //     }catch( \PDOException $e ){
    //         return false;
    //     }catch( \Exception $e ){
    //         return false;
    //     }
    // }
    
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
       $aCourseOffer=new CourseOffer();
       $result=$aCourseOffer->getGroupsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndProgram($programid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getMediumsOnSessionAndProgram(0,$programid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndProgram($programid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getShiftsOnSessionAndProgram(0,$programid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
     private function getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
         $output="<option value=''>SELECT</option>";
         foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
         }
         echo  $output;
     }
}