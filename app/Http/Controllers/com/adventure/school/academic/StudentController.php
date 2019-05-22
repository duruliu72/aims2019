<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionResult;
use App\com\adventure\school\program\CourseType;
use App\com\adventure\school\academic\Student;
use App\com\adventure\school\academic\StudentCourse;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allStudentReg(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('students');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $result=null;
        $sectionList=null;
        $courseList=null;
        $courseTypeList=null;
        $aProgramOffer=new ProgramOffer();
        if($request->isMethod('post')){
            $aCourseOffer=new CourseOffer();
            $aSectionOffer=new SectionOffer();
            if($request->search_btn=='search_btn'){
                $programid=$request->programid;
                $groupid=$request->groupid;
                $mediumid=$request->mediumid;
                $shiftid=$request->shiftid;
                $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
                $isCourseAssgn=$aCourseOffer->hasCourseAssign($programofferid);
                if($isCourseAssgn==false){
                    $msg="First Assign Course Offer to Class";
                    return redirect()->back()->with('msg',$msg);
                }
                $isSectionAssign=$aSectionOffer->hasSectionAssign($programofferid);
                if($isSectionAssign==false){
                    $msg="First Assign Section Offer to Class";
                    return redirect()->back()->with('msg',$msg);
                }   
            }
            if($request->save_btn=='save_btn'){
                $programofferid=$request->programofferid;
                $aStudent=new Student();
                $aStudentCourse= new StudentCourse();
                $applicantcheckLst=$request->applicantcheck;
                $coursecheckList=$request->coursecheck;
                $sectionid=$request->sectionid;
                $classrollList=$request->classroll;
                $coursetypeidList=$request->coursetypeid;
                if($applicantcheckLst==null || $coursecheckList==null){
                   
                }
                foreach ($applicantcheckLst as $applicantid => $value) {
                    $aStudent=new Student();
                    $registerOrNot=$aStudent->checkRegisterOrNot($programofferid,$applicantid);
                    if(!$registerOrNot){
                        $aStudent->programofferid=$programofferid;
                        $aStudent->sectionid=$sectionid;
                        $studentregid=$aStudent->generateStudentRegID($programofferid);
                        $aStudent->studentregid=$studentregid;
                        $aStudent->classroll=$classrollList[$applicantid];
                        $aStudent->studenttype=1;
                        \DB::table('applicants')
                        ->where('programofferid', $programofferid)
                        ->where('applicantid', $applicantid)
                        ->update(['studentregid' => $studentregid]);
                        $aStudent->save();
                        $studentid=$aStudent->getLastID();
                        foreach ($coursecheckList as $coursecodeid => $value) {
                            $aStudentCourse= new StudentCourse();
                            $aStudentCourse->studentid=$studentid;
                            $aStudentCourse->coursecodeid=$coursecodeid;
                            $aStudentCourse->coursetypeid=$coursetypeidList[$coursecodeid];
                            $aStudentCourse->save();
                        }
                    }
                }
                
            }
            $aAdmissionResult=new AdmissionResult();
            $courseTypeList=CourseType::all();
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $result=$aAdmissionResult->getAdmissionApplicants($programofferid);
            // dd($result);
            $courseList=$aCourseOffer->getStudentCoursesOnProgramOffer($programofferid);
        }
 
        $aApplicant=new Applicant();
        // sessionid,programid,groupid,mediumid,shiftid,tableName and $compaireid
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
            'courseTypeList'=>$courseTypeList,
            'result'=>$result,
            'courseList'=>$courseList,
            'msg'=>$msg
        ];
        return view('admin.academic.student.index',$dataList);
    }
    public function create1(Request $request){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('student');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $msg="";
        $aObj=null;
        $courseList=null;
        $courseTypeList=null;
        $sectionList=null;
        $aApplicant=new Applicant();
        $aAdmissionResult=new AdmissionResult();
        $applicantid=$request->applicantid;
        if($request->isMethod('post')&&$request->save=='student_save'){
            $programofferid=$request->programofferid;
            $applicantid=$request->applicantid;
            $sectionid=$request->sectionid;
            $classroll=$request->classroll;
            $coursetypeidList=$request->coursetypeid;
            $checkboxList=$request->checkbox;
            if($checkboxList!=null){
                $aStudent=new Student();
                $aStudent->programofferid=$programofferid;
                $aStudent->sectionid=$sectionid;
                $aStudent->classroll=$classroll;
                $registerOrNot=$aStudent->checkRegisterOrNot($programofferid,$applicantid);
                if(!$registerOrNot){
                    $studentregid=$aStudent->generateStudentRegID($programofferid);
                    // will be generate
                    $aStudent->studentregid=$studentregid;
                    $aStudent->studenttype=1;
                    $aStudent->save();
                    $studentid=$aStudent->getLastID();
                    foreach ($checkboxList as $key => $value) {
                       $aStudentCourse= new StudentCourse();
                       $aStudentCourse->studentid=$studentid;
                       $aStudentCourse->coursecodeid=$key;
                       $aStudentCourse->coursetypeid=$coursetypeidList[$key];
                       $aStudentCourse->save();
                    }
                }else{
                    $msg="Applicant Already Registered";
                }
            }
        }
        $applicant=$aApplicant->getApplicantx($applicantid);
        $aObj=$aAdmissionResult->getMeritPosition($applicant->programofferid,$applicantid);
        if($aObj==null) {
            $msg="Wrong Appicant Id";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aProgramOffer=new ProgramOffer();
        $programofferinfo=$aProgramOffer->getProgramofferDetails($applicant->programofferid);
        $aCourseOffer=new CourseOffer();
        $aSectionOffer=new SectionOffer();
        $courseList=$aCourseOffer->getStudentCourses($applicantid,$aObj->programofferid);
        $sectionList=$aSectionOffer->getSectionsOnPO($aObj->programofferid);
        $courseTypeList=CourseType::all();

        $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'courseList'=>$courseList,
                'courseTypeList'=>$courseTypeList,
                'sectionList'=>$sectionList,
                'programofferinfo'=>$programofferinfo,
                'bean'=>$aObj,
                'msg'=>$msg
        ];
        return view('admin.academic.student.create',$dataList);
    }
    public function goback(){
        return $this->applicantSearch();
    }
    public function applicantSearch(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('student');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.academic.student.search',$dataList);
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
    $aProgramOffer=new ProgramOffer();
    $result=$aProgramOffer->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
}
