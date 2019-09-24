<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\classexam\MstExamResult;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\program\GradePoint;
use App\com\adventure\school\academic\Student;
class MstExamResultController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function mstSingleResult($programofferid,$examnameid,$studentid){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $student=$aMstExamResult->getSingleResult($programofferid,$examnameid,$studentid);
        // dd($student);
        $exam=$aExamName->getExamONID($examnameid);
        $aGradePoint=new GradePoint();
        $point_letters=$aGradePoint->getGradePointTable($programofferid);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'point_letters'=>$point_letters,
            'student'=>$student,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstsingleresult',$dataList);
    }
    public function getTranscripts(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('transcripts');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam =new MasterExam();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $programofferinfo=null;
        $point_letters=null;
        $transcripts=null;
        $exam=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $programid=$request->programid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $groupid=$request->groupid;
            $examnameid=$request->examnameid;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$examnameid);
            if(!$checkMasterExam){
                $msg="Plese SetUp Master Exam";
                return redirect()->back()->with('msg',$msg);
            }
            $transcripts=$aMstExamResult->getMstExamResult($programofferid,$examnameid);
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            // dd($programofferinfo);
            $exam=$aExamName->getExamONID($examnameid);
            //  dd($exam);
            $aGradePoint=new GradePoint();
            $point_letters=$aGradePoint->getGradePointNLetter($programofferid,100);
        }
        
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $examNameList=$aExamName->getExamName(1);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'examNameList'=>$examNameList,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'point_letters'=>$point_letters,
            'transcripts'=>$transcripts,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.transcripts',$dataList);
    }
    public function mstexamresult(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aMasterExam =new MasterExam();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $aStudent=new Student();
        $programofferinfo=null;
        $exam_result=null;
        $exam=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $groupid=$request->groupid;
            $examnameid=$request->examnameid;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // Check Master Exam Setup Or Not
            $checkMasterExam=$aMasterExam->hasItem($programofferid,$examnameid);
            if(!$checkMasterExam){
                $msg="Plese SetUp Master Exam";
                return redirect()->back()->with('msg',$msg);
            }
            $aGradePoint=new GradePoint();
            // Check Grdade point setUp or not
            $hasValue=$aGradePoint->hasValue($programofferid);
            if(!$hasValue){
                $msg="Plese SetUp Grade Point";
                return redirect()->back()->with('msg',$msg);
            }
             //    Check Student 
             $checkStudensAdmit=$aStudent->checkStudentOnPO($programofferid);
             if(!$checkStudensAdmit){
                 $msg="Student Not Admitted Yet";
                 return redirect()->back()->with('msg',$msg);
             }
            $exam_result=$aMstExamResult->getMstExamResult($programofferid,$examnameid);
            
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            // dd($programofferinfo);
            $exam=$aExamName->getExamONID($examnameid);
            //  dd($exam);
        }
        
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $examNameList=$aExamName->getExamName(1);
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'examNameList'=>$examNameList,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'exam_result'=>$exam_result,
            'instituteObj'=>$instituteObj,
            'msg'=>$msg
        ];
        return view('admin.classexam.examresult.mstexamresult',$dataList);
    }
    public function tatabulationSheet(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexamresult');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ==========================
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $aCourseOffer=new CourseOffer();
        $aStudent=new Student();
        $aMstExamResult=new MstExamResult();
        $aExamName=new ExamName();
        $aMasterExam=new MasterExam();
        $programofferinfo=null;
        $exam=null;
        $courses=null;
        $exam_result=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $sectionid=$request->sectionid;
            $mstexamnameid=$request->mstexamnameid;
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
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $exam=$aExamName->getExamONID($mstexamnameid);
            $courses=$aMstExamResult->getCoursesWithCategories($programofferid);
            $exam_result=$aMstExamResult->getMstExamResult($programofferid,$mstexamnameid);
        }
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        $examNameList=$aExamName->getExamName(1);
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'examNameList'=>$examNameList,
            "exam"=>$exam,
            'programofferinfo'=>$programofferinfo,
            'courses'=>$courses,
            'exam_result'=>$exam_result,
            'msg'=>$msg
        ];
        return view('admin.classexam.tabulation.tabulation_sheet',$dataList);
    }
    public function summaryResult(Request $request){
    }
    public function getValue(Request $request){
        header('Access-Control-Allow-Origin', '*');
        $option=$request->option;
        $methodid=$request->methodid;
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
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
                $this->getSectionOnProgramoffer($sessionid,0,0,0,0,0);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,0,0,0,0,0);
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
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,0,0,0,0);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,$programlabelid,0,0,0,0);
            }
        }else if($option=="program"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"groups",'groupid');
            }elseif($methodid==4){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"mediums",'mediumid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,0,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,$programid,0,0,0);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,$programlabelid,$programid,0,0,0);
            }
        }else if($option=="group"){
            if($methodid==6){
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            }
        }else if($option=="medium"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"groups",'groupid');
            }elseif($methodid==5){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,0,"shifts",'shiftid');
            }elseif($methodid==6){
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,$programid,0,$mediumid,0);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,$programlabelid,$programid,0,$mediumid,0);
            }
        }else if($option=="shift"){
            if($methodid==3){
                $this->getAllOnIDS($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid,"groups",'groupid');
            }elseif($methodid==6){
                $this->getSectionOnProgramoffer($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid);
            }elseif($methodid==7){
                $this->getMasterExams($sessionid,$programlabelid,$programid,0,$mediumid,$shiftid);
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
    private function getMasterExams($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
        $aMasterExam=new MasterExam();
        $result=$aMasterExam->getMasterExamOnPO($programofferid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
