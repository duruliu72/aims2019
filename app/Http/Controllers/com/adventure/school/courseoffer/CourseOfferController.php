<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\CourseCode;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\courseoffer\Mearge;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\courseoffer\SectionTeacher;
class CourseOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function courseofferCreate(Request $request){
        $msg="";
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('courseoffercreate');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $aEmployee=new Employee();
        $aSectionOffer=new SectionOffer();
        $programofferinfo=null;
        $employeeList=null;
        $meargeList=null;
        $courseList=null;
        $sectionList=null;
        $sectionOfferList=null;
        $sectionTeacherList=null;
        $list=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->save_btn=='save_btn'){
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
            if($request->programofferid!=null){
                $programofferid=$request->programofferid;
            }
            $aCourseCode=new CourseCode();
            $aSectionTeacher=new SectionTeacher();
            $employeeList=$aEmployee->getEmployees();
            if(isset($request->checkbox) && $request->checkbox!=null && $request->save_btn=='save_btn'){
                $checkboxList=$request->checkbox;
                $coursecodeidList=$request->coursecodeid;
                $sectionidList=$request->sectionid;
                $coursemarksList=$request->coursemarks;
                $employeeidList=$request->employeeid;
                $isSaveCourseOffer=false;
                $isSameEmployee=false; 
                foreach($coursecodeidList as $courseitem){
                    $coursecodeid=(int)$courseitem;
                    $aCourseOffer=new CourseOffer();
                    $aCourseOffer->programofferid=$programofferid;
                    $aCourseOffer->coursecodeid=$coursecodeid;
                    $aCourseOffer->coursemark=$coursemarksList[$coursecodeid];
                    $isSectionTeacherSave=false;
                    $isSectionTeacherSelect=false;
                    foreach($sectionidList as $sectionitem){
                        $sectionid=(int)$sectionitem;
                        if($employeeidList[$coursecodeid][$sectionid]!=null){
                            $isSectionTeacherSelect=true;
                        }else{
                            $isSectionTeacherSelect=false;
                        }
                    }
                    foreach($sectionidList as $sectionitem){
                        $sectionid=(int)$sectionitem;
                        if($isSectionTeacherSelect==true&& $aCourseOffer->coursemark!=null&&$employeeidList[$coursecodeid][1]!=null && $employeeidList[$coursecodeid][$sectionid]!=null){
                            $employeeid=(int)$employeeidList[$coursecodeid][$sectionid];
                            // Save Here SectionTeacher
                            $aSectionTeacher=new SectionTeacher();
                            $aSectionTeacher->programofferid=$programofferid;
                            $aSectionTeacher->sectionid=$sectionid;
                            $aSectionTeacher->coursecodeid=$coursecodeid;
                            $aSectionTeacher->employeeid=$employeeid;
                            if($aSectionTeacher->isSameEmployee($programofferid,$sectionid,$coursecodeid,$employeeid)==false&&$isSectionTeacherSelect==true){
                                $aSectionTeacher->save();
                                $isSectionTeacherSave=true;
                                $isSameEmployee=false;
                            }else{
                                $isSameEmployee=true;  
                            }
                        }
                    }
                   if($aCourseOffer->coursemark!=null&& $isSectionTeacherSave){
                        if($aCourseOffer->isSameCourse($programofferid,$coursecodeid)==false){
                            $aCourseOffer->save();
                            $isSaveCourseOffer=false;
                        }
                        $isSaveCourseOffer=true;
                    }
                }

                if($isSaveCourseOffer){
                    $msg="Item save Successfully";
                }elseif($isSameEmployee){
                    $msg="You Select Same Employee";
                }elseif($aCourseOffer->coursemark==null){
                    $msg="Plesase input Course marks";
                }elseif($isSectionTeacherSelect==false){
                    $msg="Plesase select Section Teacher";
                }else{
                    $msg="Item not save";
                }
                
            }elseif($request->checkbox==null&&$request->save_btn=='save_btn'){
                $msg="Select  Course";
            }
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $programofferinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $courseList=$aCourseCode->getAllCourseOnProgramOffer($programofferid);
            $sectionTeacherList=$aSectionTeacher->getSectionTeacher($programofferid);
        }
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$aSectionOffer->getProgramsOnSession($sessionid),
            'groupList'=>$aSectionOffer->getGroupsOnSession($sessionid),
            'mediumList'=>$aSectionOffer->getMediumsOnSession($sessionid),
            'shiftList'=>$aSectionOffer->getShiftsOnSession($sessionid),
            'programofferinfo'=>$programofferinfo,
            'employeeList'=>$employeeList,
            'courseList'=>$courseList,
            'sectionList'=>$sectionList,
            // 'sectionOfferList'=>$sectionOfferList,
            'sectionTeacherList'=>$sectionTeacherList,
            'list'=>$list,
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.index',$dataList);
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
   $aSectionOffer=new SectionOffer();
   $result=$aSectionOffer->getGroupsOnSessionAndProgram(0,$programid);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
       $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
private function getMediumsOnSessionAndProgram($programid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getMediumsOnSessionAndProgram(0,$programid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
 private function getShiftsOnSessionAndProgram($programid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getShiftsOnSessionAndProgram(0,$programid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
 private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
 private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
 private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
 private function getCourseCodesOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
    $aSectionOffer=new SectionOffer();
    $result=$aSectionOffer->getCourseCodesOnProgramOffer(0,$programid,$groupid,$mediumid,$shiftid);
     $output="<option value=''>SELECT</option>";
     foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
     }
     echo  $output;
 }
}
