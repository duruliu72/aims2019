<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\CourseCode;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\program\MarkCategory;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\MarkDistribution;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\classexam\MstExamMarks;
use App\com\adventure\school\academic\Student;
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
        $sectionid=$request->sectionid;
        $coursecodeid=$request->coursecodeid;
        $examnameid=$request->examnameid;
        $programofferinfo=null;
        $programofferid=null;
        $mark_catList=null;
        $studentList=null;
        $section=null;
        $courseCode=null;
        $exam=null;
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $aCourseOffer=new CourseOffer();
        $markDistObj=new MarkDistribution();
        $aStudent=new Student();
        $aMasterExam =new MasterExam();
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
             //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
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
            $checkMarkDist=$markDistObj->checkMarkDistribution($programofferid,$coursecodeid);
            if(!$checkMarkDist){
                $msg="This Course Mark is not distributed";
                return redirect()->back()->with('msg',$msg);
            }
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$examnameid);
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
            $coursecodeid=$request->coursecodeid;
            $examnameid=$request->examnameid;
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
                            $aMstExamMarks->teacherid=0;
                            $aMstExamMarks->studentid=$studentid;
                            $aMstExamMarks->coursecodeid=$coursecodeid;
                            $aMstExamMarks->examnameid=$examnameid;
                            $aMstExamMarks->examtypeid=1;  
                            $aMstExamMarks->markcategoryid=$markcatid;
                            $aMstExamMarks->marks=$catMark;
                            $checkentry=$aMstExamMarks->checkEntry($programofferid,$coursecodeid,$studentid,$markcatid);
                            if($checkentry==false){
                                $aMstExamMarks->save();
                            }
                        }
                    }
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $mark_catList=$markDistObj->getMarkCategory($programofferid,$coursecodeid);
        $aSection=new Section();
        $section=$aSection->getSection($sectionid);
        $aCourseCode=new CourseCode();
        $courseCode=$aCourseCode->getCourse($coursecodeid);
        $aMstExamMarks=new MstExamMarks();
        $studentList=$aMstExamMarks->getStudentsOnClsNSec($programofferid,$sectionid,$coursecodeid,$examnameid,'LEFT');     
        // dd($studentList);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        $aCourseCode=new CourseCode();
        $courseList=$aCourseCode->getAllCourse();
        $aExamName=new ExamName();
        $exam=$aExamName->getExamONID($examnameid);
        $examNameList=$aExamName->getExamName(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'courseList'=>$courseList,
            'examNameList'=>$examNameList,
            'section'=>$section,
            'courseCode'=>$courseCode,
            'exam'=>$exam,
            'mark_catList'=>$mark_catList,
            'studentList'=>$studentList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markentryform',$dataList);
    }
    public function marksedit(Request $request){
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
        $sectionid=$request->sectionid;
        $coursecodeid=$request->coursecodeid;
        $examnameid=$request->examnameid;
        $programofferinfo=null;
        $programofferid=null;
        $sectionList=Section::all();
        $mark_catList=null;
        $studentList=null;
        $section=null;
        $courseCode=null;
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $aCourseOffer=new CourseOffer();
        $markDistObj=new MarkDistribution();
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
             //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
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
            $checkMarkDist=$markDistObj->checkMarkDistribution($programofferid,$coursecodeid);
            if(!$checkMarkDist){
                $msg="This Course is not distributed Yet";
                return redirect()->back()->with('msg',$msg);
            }
            
            //    Check Teacher Assign or Not

            
           
            //    Check Student 
            // $checkStudensAdmit=$aStudent->checkStudentOnPO($programofferid);
            
        }
        $aCourseCode=new CourseCode();
        if($request->isMethod('post')&&$request->update_btn=='update_btn'){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $coursecodeid=$request->coursecodeid;
            $examnameid=$request->examnameid;
            $checkboxList=$request->checkbox;
            $marksList=$request->marks;
            if($checkboxList){
                foreach($checkboxList as $studentid=>$v){
                    $courseCatsMarks=$marksList[$studentid];
                    $isRowValFill=true;
                    $tot_marks=0;
                    // dd($courseCatsMarks);
                    foreach($courseCatsMarks as $markcatid=>$catMark){
                        $tot_marks=$tot_marks+$catMark;
                        if($catMark==null){
                            $isRowValFill=false;
                        }
                    }
                    $courseCode=$aCourseOffer->getCourseCode($programofferid,$coursecodeid);
                    if($isRowValFill==true && ($tot_marks<=$courseCode->coursemark)){
                        // Check Here Data Exit Or Not
                        // $aMstExamMarks=new MstExamMarks();
                        // $aMstExamMarks->programofferid=$programofferid;
                        // $aMstExamMarks->sectionid=$sectionid;
                        // $aMstExamMarks->teacherid=0;
                        // $aMstExamMarks->studentid=$studentid;
                        // $aMstExamMarks->coursecodeid=$coursecodeid;
                        // $aMstExamMarks->examnameid=$examnameid;
                        // $aMstExamMarks->examtypeid=1;  
                        // $aMstExamMarks->markcategoryid=$markcatid;
                        // $aMstExamMarks->marks=$catMark;
                        // $checkentry=$aMstExamMarks->checkEntry($programofferid,$coursecodeid,$studentid,$markcatid);
                        // if($checkentry==false){
                        //     $aMstExamMarks->save();
                        // }
                        foreach($courseCatsMarks as $markcatid=>$catMark){
                            $aMstExamMarks=new MstExamMarks();
                            $checkentry=$aMstExamMarks->checkEntry($programofferid,$coursecodeid,$studentid,$markcatid);
                            if($checkentry){
                                \DB::table('mst_exam_marks')
                                ->where('programofferid', $programofferid)
                                ->where('studentid', $studentid)
                                ->where('coursecodeid', $coursecodeid)
                                ->where('examnameid', $examnameid)
                                ->where('markcategoryid', $markcatid)
                                ->update(['marks' => $catMark]);
                            }else{
                                $aMstExamMarks->programofferid=$programofferid;
                                $aMstExamMarks->sectionid=$sectionid;
                                $aMstExamMarks->teacherid=0;
                                $aMstExamMarks->studentid=$studentid;
                                $aMstExamMarks->coursecodeid=$coursecodeid;
                                $aMstExamMarks->examnameid=$examnameid;
                                $aMstExamMarks->examtypeid=1;  
                                $aMstExamMarks->markcategoryid=$markcatid;
                                $aMstExamMarks->marks=$catMark;
                                // $checkentry=$aMstExamMarks->checkEntry($programofferid,$coursecodeid,$studentid,$markcatid);
                                if($checkentry==false){
                                    $aMstExamMarks->save();
                                }
                            }
                        }
                    }
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $mark_catList=$markDistObj->getMarkCategory($programofferid,$coursecodeid);
        // dd($mark_catList);
        $aSection=new Section();
        $section=$aSection->getSection($sectionid);
        $aMstExamMarks=new MstExamMarks();
        $courseCode=$aCourseOffer->getCourseCode($programofferid,$coursecodeid);
        $studentList=$aMstExamMarks->getStudentsOnClsNSec($programofferid,$sectionid,$coursecodeid,$examnameid,'INNER');     
        // dd($studentList);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $courseList=$aCourseCode->getAllCourse();
        $aExamName=new ExamName();
        $exam=$aExamName->getExamONID($examnameid);
        // dd($exam);
        $examNameList=$aExamName->getExamName(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'courseList'=>$courseList,
            'examNameList'=>$examNameList,
            'section'=>$section,
            'courseCode'=>$courseCode,
            'exam'=>$exam,
            'mark_catList'=>$mark_catList,
            'studentList'=>$studentList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markeditform',$dataList);
    }
}
