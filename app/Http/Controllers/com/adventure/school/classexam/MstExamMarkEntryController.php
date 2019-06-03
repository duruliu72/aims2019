<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

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
class MstExamMarkEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function marksentry(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////
        $msg="";
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $programofferinfo=null;
        $sectionList=null;
        $aProgramOffer=new ProgramOffer();
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            //    Check Section offer Created or Not
            $aSectionOffer=new SectionOffer();
            $checkSectionoffer=$aSectionOffer->hasSectionAssign($programofferid);
            if(!$checkSectionoffer){
                $msg="Section not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            //    Check Course offer Created or Not
            $aCourseOffer=new CourseOffer();
            $checkCourseOffer=$aCourseOffer->hasCourseAssign($programofferid);
            if(!$checkCourseOffer){
                $msg="Course not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            //    Check Teacher Assign or Not

            //    Check Student 
        }       
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markentryform',$dataList);
    }
}
