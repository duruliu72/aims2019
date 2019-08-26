<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionResult;
use App\com\adventure\school\program\CourseType;
use App\com\adventure\school\academic\Student;
use App\com\adventure\school\academic\StudentRegistration;
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
                $applicantcheckLst=$request->applicantcheck;
                $coursecheckList=$request->coursecheck;
                $sectionid=$request->sectionid;
                $classrollList=$request->classroll;
                $coursetypeidList=$request->coursetypeid;
                foreach ($applicantcheckLst as $applicantid => $value) {
                    $aStudent=new Student();
                    $isTrue=$aStudent->checkStudent($programofferid,$applicantid);
                    if($isTrue==false){
                        $aStudent->programofferid=$programofferid;
                        $aStudent->sectionid=$sectionid;
                        $aStudent->applicantid=$applicantid;
                        $aStudent->classroll=$classrollList[$applicantid];
                        $aStudent->fromclass=0;
                        $aStudent->fromsection=0;
                        $aStudent->studenttype=1;
                        $aStudent->currentclass=1;
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
            $aStudentRegistration=new StudentRegistration();
            $courseTypeList=CourseType::all();
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $result=$aStudentRegistration->getApplcantsForRegistration($programofferid);
            $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
        }
        // dd($courseList);
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'courseTypeList'=>$courseTypeList,
            'courseList'=>$courseList,
            'result'=>$result,
            'msg'=>$msg
        ];
        return view('admin.academic.student.index',$dataList);
    }
    public function editStudentsSubjects(Request $request){
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
                $applicantcheckLst=$request->applicantcheck;
                $coursecheckList=$request->coursecheck;
                $sectionid=$request->sectionid;
                $classrollList=$request->classroll;
                $coursetypeidList=$request->coursetypeid;
                foreach ($applicantcheckLst as $applicantid => $value) {
                    $aStudent=new Student();
                    $isTrue=$aStudent->checkStudent($programofferid,$applicantid);
                    if($isTrue==false){
                        $aStudent->programofferid=$programofferid;
                        $aStudent->sectionid=$sectionid;
                        $aStudent->applicantid=$applicantid;
                        $aStudent->classroll=$classrollList[$applicantid];
                        $aStudent->fromclass=0;
                        $aStudent->fromsection=0;
                        $aStudent->studenttype=1;
                        $aStudent->currentclass=1;
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
            $aStudentRegistration=new StudentRegistration();
            $courseTypeList=CourseType::all();
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $result=$aStudentRegistration->getApplcantsForRegistration($programofferid);
            $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
        }
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
            'courseList'=>$courseList,
            'result'=>$result,
            'msg'=>$msg
        ];
        return view('admin.academic.student.index',$dataList);
    }
    public function studentReg(Request $request){
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
                $aStudent->applicantid=$applicantid;
                $aStudent->classroll=$classroll;
                $aStudent->fromclass=0;
                $aStudent->fromsection=0;
                $aStudent->studenttype=1;
                $aStudent->currentclass=1;
                $registerOrNot=$aStudent->checkStudent($programofferid,$applicantid);
                if(!$registerOrNot){
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
        $applicant=$aApplicant->getApplicant($applicantid);
        if($applicant==null) {
            $msg="Wrong Appicant Id";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aObj=$aAdmissionResult->getAdmissionResult($applicantid);
        // dd($aObj);
        $aStudentRegistration=new StudentRegistration();
        $dd=$aStudentRegistration->getApplcantForRegistration($applicantid);
        // dd($dd);
        $aCourseOffer=new CourseOffer();
        $aSectionOffer=new SectionOffer();
        $courseList=$aCourseOffer->getCoursesOnProgramOffer($aObj['programofferinfo']->id);
        $sectionList=$aSectionOffer->getSectionsOnPO($aObj['programofferinfo']->id);
        $courseTypeList=CourseType::all();
        $dataList=[
                'institute'=>Institute::getInstituteName(),
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
    public function allStudents(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('students');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////////////////
        $aProgramOffer=new ProgramOffer();
        $aStudent=new Student();
        $programofferid=0;
        $programofferinfo=null;
        $students=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $validatedData = $request->validate([
                'sessionid' => 'required',
                'programlabelid' => 'required',
                'programid' => 'required',
                'mediumid' => 'required',
                'shiftid' => 'required',
                'groupid' => 'required',
            ]);
            $request->flash();
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            // Check Program Offer Created Or Not
            $checkProgramOffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramOffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // check sectionOffer
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $students=$aStudent->getStudentsOnProgramofferID($programofferid);
            // dd($students);
        }
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'programofferinfo'=>$programofferinfo,
            'students'=>$students,
            'msg'=>$msg
        ];
        return view('admin.academic.studentList.studentlist',$dataList);
    }
 // For Ajax Call ===============
    //    ================================================================
    public function getValue(Request $request){
        $option=$request->option;
        $methodid=$request->methodid;
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $sectionid=$request->sectionid;
        $mstexamnameid=$request->mstexamnameid;
        if($option=="session"){
            //session plabel program group medium shift
            if($methodid==1){
                $this->getAllOnIDS($sessionid,0,0,0,0,0,"plabels",'programlabelid');
            }elseif($methodid==2){
                $this->getAllOnIDS($sessionid,0,0,0,0,0,"programs",'programid');
            }elseif($methodid==3){
                $this->getAllOnIDS($sessionid,0,0,0,0,0,"groups",'groupid');
            }elseif($methodid==4){
                $this->getAllOnIDS($sessionid,0,0,0,0,0,"mediums",'mediumid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,0,0,0,0,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSections($sessionid,0,0,0,0,0);
            }
        }else if($option=="programlabel"){
            if($methodid==2){
                $this->getAllOnIDS($sessionid,$programlabelid,0,0,0,0,"programs",'programid');
            }elseif($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,0,0,0,0,"groups",'groupid');
            }elseif($methodid==4){
                $this->getAllOnIDS($sessionid,$programlabelid,0,0,0,0,"mediums",'mediumid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,0,0,0,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSections($sessionid,$programlabelid,0,0,0,0);
            }
        }else if($option=="program"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"groups",'groupid');
            }elseif($methodid==4){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"mediums",'mediumid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSections($sessionid,$programlabelid,$programid,0,0,0);
            }
        }elseif($option=="group"){
            if($methodid==6){
                $this->getSections($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            }
        }else if($option=="medium"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"groups",'groupid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSections($sessionid,$programlabelid,$programid,0,$mediumid,0);
            }
        }else if($option=="shift"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid,"groups",'groupid');
            }elseif($methodid==6){
                $this->getSections($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid);
            }
        }
    }
    private function getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getSections($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
        $aSectionOffer=new SectionOffer();
        $result=$aSectionOffer->getSectionsOnPO($programofferid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
