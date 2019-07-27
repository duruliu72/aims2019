<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
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
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $markCategoryList=MarkCategory::all();
      
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->save_btn=='save_btn'){
            if($request->search_btn=='search_btn'){
                $validatedData = $request->validate([
                    'programid' => 'required|',
                    'groupid' => 'required|',
                    'mediumid' => 'required|',
                    'shiftid' => 'required|',
                    ]);
                $isTrue=$aCourseOffer->hasCourseAssign($programofferid);
                if($isTrue==false){
                    $msg="Please course asssign first";
                    return redirect()->back()->with('msg',$msg);
                }
                
            }
            if($request->save_btn=='save_btn'){
                $programofferid=$request->programofferid;
                $checkboxList=$request->checkbox;
                $distribution_markList=$request->mark_in_percentage;
                $cat_hld_mark_List=$request->cat_hld_mark;
                $percentage_mark_List=$request->percentage_mark;
                $mark_group_idList=$request->mark_group_id;
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
                            $aMarkDistribution->mark_in_percentage=$distribution_markList[$key][$catid->id];
                            $cat_hld_mark=$cat_hld_mark_List[$key][$catid->id];
                            $percentage_mark=$percentage_mark_List[$key][$catid->id];
                            $aMarkDistribution->mark_group_id=$mark_group_idList[$key][$catid->id];
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
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $courseCodeList=$aCourseOffer->getCourseCodesOnProgramOffer($programofferid);
            // dd($courseCodeList);
            $aMarkDistribution=new MarkDistribution();
            $markdistributionList=$aMarkDistribution->getMarkDistributionOnProgramOffer($programofferid);
            // dd($selectedlist);
            $selectedlist=array();
            foreach ($courseCodeList as $course) {
                $selectedlist[$course->id]=$aMarkDistribution->getCourseCategoryOnCourse($programofferid,$course->id);
            }
        }
        // dd($selectedlist);
        $aList=[];
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[         
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
            'result'=>$aList,
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
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $markCategoryList=MarkCategory::all();
        
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->update_btn=='update_btn'){
            if($request->search_btn=='search_btn'){
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
                $distribution_markList=$request->mark_in_percentage;
                $cat_hld_mark_List=$request->cat_hld_mark;
                $percentage_mark_List=$request->percentage_mark;
                $mark_group_idList=$request->mark_group_id;
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
                            $mark_in_percentage=$distribution_markList[$key][$catid->id];
                            $cat_hld_mark=$cat_hld_mark_List[$key][$catid->id];
                            $percentage_mark=$percentage_mark_List[$key][$catid->id];
                            $mark_group_id=$mark_group_idList[$key][$catid->id];                            
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
                                            'mark_in_percentage' => $mark_in_percentage,
                                            'cat_hld_mark' => $cat_hld_mark,
                                            'percentage_mark' => $percentage_mark,
                                            'mark_group_id'=>$mark_group_id
                                        ]);
                                    }else{
                                        // not save
                                    }
                                    
                                }else{
                                    if($totalPercentage[$key]==100){
                                        $aMarkDistribution->programofferid=$programofferid;
                                        $aMarkDistribution->coursecodeid=$coursecodeid;
                                        $aMarkDistribution->markcategoryid=$markcategoryid;
                                        $aMarkDistribution->mark_in_percentage=$mark_in_percentage;
                                        $aMarkDistribution->cat_hld_mark=$cat_hld_mark;
                                        $aMarkDistribution->percentage_mark=$percentage_mark;
                                        $aMarkDistribution->mark_group_id=$mark_group_id;
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
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $courseCodeList=$aCourseOffer->getCourseCodesOnProgramOffer($programofferid);
            $aMarkDistribution=new MarkDistribution();
            $markdistributionList=$aMarkDistribution->getMarkDistributionOnProgramOffer($programofferid);
            $selectedlist=array();
            foreach ($courseCodeList as $course) {
                $selectedlist[$course->id]=$aMarkDistribution->getCourseCategoryOnCourse($programofferid,$course->id);
            }
        }
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
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
            // if($methodid==1){
            //     $this->getMediumsOnSessionAndPrograAndGroup($programid,$groupid);
            // }elseif($methodid==2){
            //     $this->getShiftsOnSessionAndPrograAndGroup($programid,$groupid);
            // }
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
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}