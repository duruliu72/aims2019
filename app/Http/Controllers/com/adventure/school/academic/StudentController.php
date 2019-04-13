<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('student');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $programinfo=null;
        $applicantsinfo=null;
        $sectionList=null;
        $courseList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $aAdmissionResult=new AdmissionResult();
            $aProgramOffer=new ProgramOffer();
            $aCourseOffer=new CourseOffer();
        	$programid=$request->programid;
	        $groupid=$request->groupid;
	        $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
            $programinfo=$aProgramOffer->getProgramOfferinfo($programofferid);
            $aSectionOffer=new SectionOffer();
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $applicantsinfo=$aAdmissionResult->getAdmissionApplicants($programofferid);
            $courseList=$aCourseOffer->getStudentCoursesOnProgramOffer($programofferid);
        }
        $msg="";
        $aApplicant=new Applicant();
        $courseTypeList=CourseType::all();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$aApplicant->getProgramsOnSession($sessionid),
            'groupList'=>$aApplicant->getGroupsOnSession($sessionid),
            'mediumList'=>$aApplicant->getMediumsOnSession($sessionid),
            'shiftList'=>$aApplicant->getShiftsOnSession($sessionid),
            'sectionList'=>$sectionList,
            'courseTypeList'=>$courseTypeList,
            'programinfo'=>$programinfo,
            'applicantsinfo'=>$applicantsinfo,
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
                    \DB::table('applicants')
                    ->where('programofferid', $programofferid)
                    ->where('applicantid', $applicantid)
                    ->update(['studentregid' => $studentregid]);
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
        $aObj=$aAdmissionResult->getApplicantinfo($applicantid);
        if($aObj==null) {
            $msg="Wrong Appicant Id";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
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
        }
    }
    private function getGroupsOnSessionAndProgram($programid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getGroupsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndProgram($programid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getMediumsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndProgram($programid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getShiftsOnSessionAndProgram(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumsOnSessionAndPrograAndGroup($programid,$groupid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getMediumsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroup($programid,$groupid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getShiftsOnSessionAndPrograAndGroup(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftsOnSessionAndPrograAndGroupAndMedium($programid,$groupid,$mediumid){
        $aApplicant=new Applicant();
        $result=$aApplicant->getShiftsOnSessionAndPrograAndGroupAndMedium(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
