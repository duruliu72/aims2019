<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Course;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\program\MarkCategory;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\MarkDistribution;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\classexam\MstExamMarksEntry;
use App\com\adventure\school\classexam\MstExamMarks;
use App\com\adventure\school\academic\Student;
class MstExamMarkEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function marksentry(Request $request){
        // die("Die Here");
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $sectionid=$request->sectionid;
        $courseid=$request->courseid;
        // dd($courseid);
        $mstexamnameid=$request->mstexamnameid;
        $programofferinfo=null;
        $programofferid=null;
        $mark_catList=null;
        $studentList=null;
        $section=null;
        $course=null;
        $exam=null;
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $aCourseOffer=new CourseOffer();
        $markDistObj=new MarkDistribution();
        $aStudent=new Student();
        $aMasterExam =new MasterExam();
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
             //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            //    Check Section offer Created or Not
           
            $checkSectionoffer=$aSectionOffer->hasSectionAssign($programofferid);
            if(!$checkSectionoffer){
                $msg="Section not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            //    Check Course offer Created or Not
            $checkCourseOffer=$aCourseOffer->hasCourseAssign($programofferid);
            if(!$checkCourseOffer){
                $msg="Course not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            // Check mark Distributed or not
            $checkMarkDist=$markDistObj->checkMarkDistribution($programofferid,$courseid);
            if(!$checkMarkDist){
                $msg="This Course Mark is not distributed";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$mstexamnameid);
            if(!$checkMasterExam){
                $msg="Plese SetUp Master Exam";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Teacher Assign or Not
            
            //    Check Student 
            $checkStudensAdmit=$aStudent->checkStudentOnPO($programofferid);
            if(!$checkStudensAdmit){
                $msg="Student Not Admitted Yet";
                return redirect()->back()->with('msg',$msg);
            }
            
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $courseid=$request->courseid;
            $mstexamnameid=$request->mstexamnameid;
            $checkboxList=$request->checkbox;
            $marksList=$request->marks;
            if($checkboxList){
                foreach($checkboxList as $studentid=>$v){
                    $courseCatsMarks=$marksList[$studentid];
                    $isRowValFill=true;
                    foreach($courseCatsMarks as $markcatid=>$catMark){
                        if($catMark==null){
                            $isRowValFill=false;
                        }
                    }
                    if($isRowValFill==true){
                        foreach($courseCatsMarks as $markcatid=>$catMark){
                            $aMstExamMarks=new MstExamMarks();
                            $aMstExamMarks->programofferid=$programofferid;
                            $aMstExamMarks->sectionid=$sectionid;
                            $aMstExamMarks->studentid=$studentid;
                            $aMstExamMarks->courseid=$courseid;
                            $aMstExamMarks->examnameid=$mstexamnameid;
                            $aMstExamMarks->examtypeid=1;  
                            $aMstExamMarks->markcategoryid=$markcatid;
                            $aMstExamMarks->marks=$catMark;
                            $checkentry=$aMstExamMarks->checkEntry($programofferid,$courseid,$studentid,$markcatid);
                            if($checkentry==false){
                                $aMstExamMarks->save();
                            }
                        }
                    }
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        // dd($programofferinfo);
        $mark_catList=$markDistObj->getMarkCategory($programofferid,$courseid);
        // dd($mark_catList);
        $aSection=new Section();
        $section=$aSection->getSection($sectionid);
        $aCourse=new Course();
        $course=$aCourse->getCourse($courseid);
        // dd($course);
        // $courseCode=$aCourseCode->getCourse($coursecodeid);
        $aMstExamMarks=new MstExamMarks();
        $studentList=$aMstExamMarks->getStudentsOnClsNSec($programofferid,$sectionid,$courseid,$mstexamnameid,'LEFT');
        // dd($studentList);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        // $aCourseCode=new CourseCode();
        $courseList=$aCourse->getCourses();
        $aExamName=new ExamName();
        $exam=$aExamName->getExamONID($mstexamnameid);
        $examNameList=$aExamName->getExamName(1);
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
            'courseList'=>$courseList,
            'examNameList'=>$examNameList,
            'section'=>$section,
            'course'=>$course,
            'exam'=>$exam,
            'mark_catList'=>$mark_catList,
            'studentList'=>$studentList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markentryform',$dataList);
    }
  
    public function marksedit(Request $request){
        // die("Die Here");
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $sectionid=$request->sectionid;
        $courseid=$request->courseid;
        // dd($courseid);
        $mstexamnameid=$request->mstexamnameid;
        $programofferinfo=null;
        $programofferid=null;
        $mark_catList=null;
        $studentList=null;
        $section=null;
        $course=null;
        $exam=null;
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $aCourseOffer=new CourseOffer();
        $markDistObj=new MarkDistribution();
        $aStudent=new Student();
        $aMasterExam =new MasterExam();
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
             //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            //    Check Section offer Created or Not
           
            $checkSectionoffer=$aSectionOffer->hasSectionAssign($programofferid);
            if(!$checkSectionoffer){
                $msg="Section not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            //    Check Course offer Created or Not
            $checkCourseOffer=$aCourseOffer->hasCourseAssign($programofferid);
            if(!$checkCourseOffer){
                $msg="Course not Assign yet to Program offer";
                return redirect()->back()->with('msg',$msg);
            }
            // Check mark Distributed or not
            $checkMarkDist=$markDistObj->checkMarkDistribution($programofferid,$courseid);
            if(!$checkMarkDist){
                $msg="This Course Mark is not distributed";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$mstexamnameid);
            if(!$checkMasterExam){
                $msg="Plese SetUp Master Exam";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Teacher Assign or Not
            
            //    Check Student 
            $checkStudensAdmit=$aStudent->checkStudentOnPO($programofferid);
            if(!$checkStudensAdmit){
                $msg="Student Not Admitted Yet";
                return redirect()->back()->with('msg',$msg);
            }
            
        }
        if($request->isMethod('post')&&$request->update_btn=='update_btn'){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $courseid=$request->courseid;
            $mstexamnameid=$request->mstexamnameid;
            $checkboxList=$request->checkbox;
            $marksList=$request->marks;
            if($checkboxList){
                foreach($checkboxList as $studentid=>$v){
                    $courseCatsMarks=$marksList[$studentid];
                    $isRowValFill=true;
                    foreach($courseCatsMarks as $markcatid=>$catMark){
                        if($catMark==null){
                            $isRowValFill=false;
                        }
                    }
                    if($isRowValFill==true){
                        foreach($courseCatsMarks as $markcatid=>$catMark){
                            $aMstExamMarks=new MstExamMarks();
                            $programofferid=$programofferid;
                            $sectionid=$sectionid;
                            $studentid=$studentid;
                            $courseid=$courseid;
                            $examnameid=$mstexamnameid;
                            $examtypeid=1;  
                            $markcategoryid=$markcatid;
                            $marks=$catMark;
                            $checkentry=$aMstExamMarks->checkEntry($programofferid,$courseid,$studentid,$markcatid);
                            // dd($checkentry);
                            if($checkentry){
                                \DB::table('mst_exam_marks')
                                ->where('programofferid', $programofferid)
                                ->where('studentid', $studentid)
                                ->where('courseid', $courseid)
                                ->where('examnameid', $examnameid)
                                ->where('markcategoryid', $markcatid)
                                ->update(['marks' => $marks]);
                            }else{
                                // $aMstExamMarks=new MstExamMarks();
                                // $aMstExamMarks->programofferid=$programofferid;
                                // $aMstExamMarks->sectionid=$sectionid;
                                // $aMstExamMarks->studentid=$studentid;
                                // $aMstExamMarks->courseid=$courseid;
                                // $aMstExamMarks->examnameid=$mstexamnameid;
                                // $aMstExamMarks->examtypeid=1;  
                                // $aMstExamMarks->markcategoryid=$markcatid;
                                // $aMstExamMarks->marks=$catMark;
                                // $aMstExamMarks->save();
                            }
                        }
                    }
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        // dd($programofferinfo);
        $mark_catList=$markDistObj->getMarkCategory($programofferid,$courseid);
        // dd($mark_catList);
        $aSection=new Section();
        $section=$aSection->getSection($sectionid);
        $aCourse=new Course();
        $course=$aCourse->getCourse($courseid);
        // dd($course);
        // $courseCode=$aCourseCode->getCourse($coursecodeid);
        $aMstExamMarks=new MstExamMarks();
        $studentList=$aMstExamMarks->getStudentsOnClsNSec($programofferid,$sectionid,$courseid,$mstexamnameid,'LEFT');
        // dd($studentList);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aCourseOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        // $aCourseCode=new CourseCode();
        $courseList=$aCourse->getCourses();
        $aExamName=new ExamName();
        $exam=$aExamName->getExamONID($mstexamnameid);
        $examNameList=$aExamName->getExamName(1);
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
            'courseList'=>$courseList,
            'examNameList'=>$examNameList,
            'section'=>$section,
            'course'=>$course,
            'exam'=>$exam,
            'mark_catList'=>$mark_catList,
            'studentList'=>$studentList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markeditform',$dataList);
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
            }
        }else if($option=="program"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"groups",'groupid');
            }elseif($methodid==4){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"mediums",'mediumid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"shifts",'shiftid');
            }
        }else if($option=="group"){
            if($methodid==6){
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            }
        }else if($option=="medium"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"groups",'groupid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"shifts",'shiftid');
            }
        }else if($option=="shift"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid,"groups",'groupid');
            }
        }else if($option=="mstexam"){
            if($methodid==7){
                $this->getCoursesOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$sectionid,$mstexamnameid);
            }
        }else if($option=="mstexamedit"){
            if($methodid==8){
                $this->getEditCoursesOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$sectionid,$mstexamnameid);
            }
        }
    }
    private function getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid){
        // $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $result=$aCourseOffer->getAllOnIDS($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getSectionOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid){
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
    private function getCoursesOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$sectionid,$mstexamnameid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
        $aMstExamMarksEntry=new MstExamMarksEntry();
        $result=$aMstExamMarksEntry->getCourses($programofferid,$sectionid,$mstexamnameid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->courseName($x->courseCode)</option>";
        }
        echo  $output;
    }
    private function getEditCoursesOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid,$sectionid,$mstexamnameid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
        $aMstExamMarksEntry=new MstExamMarksEntry();
        $result=$aMstExamMarksEntry->getEditCourse($programofferid,$sectionid,$mstexamnameid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->courseName($x->courseCode)</option>";
        }
        echo  $output;
    }
}
