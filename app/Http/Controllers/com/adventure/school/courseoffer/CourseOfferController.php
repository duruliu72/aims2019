<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
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
        $programofferinfo=null;
        $courseList=null;
        $sectionList=null;
        $sectionOfferList=null;
        $sectionTeacherList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn' || $request->save_btn=='save_btn'){
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            if($request->programofferid!=null){
                $programofferid=$request->programofferid;
            }
            $aCourseCode=new CourseCode();
            if(isset($request->checkbox) && $request->checkbox!=null && $request->save_btn=='save_btn'){
                $checkboxList=$request->checkbox;
                $coursecodeidList=$request->coursecodeid;
                $coursemarksList=$request->coursemarks;
                $isSaveCourseOffer=false;
                foreach($coursecodeidList as $courseitem){
                    $coursecodeid=(int)$courseitem;
                    $aCourseOffer=new CourseOffer();
                    $aCourseOffer->programofferid=$programofferid;
                    $aCourseOffer->coursecodeid=$coursecodeid;
                    $aCourseOffer->coursemark=$coursemarksList[$coursecodeid];
                   if($aCourseOffer->coursemark!=null){
                        if($aCourseOffer->isSameCourse($programofferid,$coursecodeid)==false){
                            $aCourseOffer->save();
                            $isSaveCourseOffer=false;
                        }
                        $isSaveCourseOffer=true;
                    }
                }
                if($isSaveCourseOffer){
                    $msg="Item save Successfully";
                }elseif($aCourseOffer->coursemark==null){
                    $msg="Plesase input Course marks";
                }else{
                    $msg="Item not save";
                }
                
            }
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $courseList=$aCourseCode->getAllCourseOnProgramOffer($programofferid);
        }
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $teacherList=Employee::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'teacherList'=>$teacherList,
            'programofferinfo'=>$programofferinfo,
            'courseList'=>$courseList,
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.index',$dataList);
    }
   
}
