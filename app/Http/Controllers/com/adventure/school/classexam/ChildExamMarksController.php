<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\academic\Student;
use App\com\adventure\school\classexam\ChildExamMarks;
use App\com\adventure\school\exam\ChildExam_Copy;

class ChildExamMarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function child_Exam_MarkEntry(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexammarkentry');
        $aProgramOffer=new ProgramOffer();
        $aMasterExam=new MasterExam();
        $aCourseOffer=new CourseOffer();
        $aStudent=new Student();
        $programofferinfo=null;
        $courseList=null;
        $studentList=null;
        $section=null;
        if($request->isMethod('post')&& $request->btn_next=="btn_next"){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
                'sectionid' => 'required|',
            ]);
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $sectionid=$request->sectionid;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
            $studentList=$aStudent->getStudentsOnClsNSec($programofferid,$sectionid);
            $aSection=new Section();
            $section=$aSection->getSection($sectionid);
        }
        if($request->isMethod('post')&& $request->btn_save=="btn_save"){
            $hasAllField=true;
            if($request->mst_examnameid==""){
                $msg="Select Master Exam";
                $hasAllField=false;
            }elseif($request->child_examnameid==""){
                $msg="Select Chld Exam";
                $hasAllField=false;
            }elseif($request->coursecodeid==""){
                $msg="Select Subject";
                $hasAllField=false;
            }elseif($request->checkbox==null){
                $msg="Check at lest one student";
                $hasAllField=false;
            }
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            $coursecodeid=$request->coursecodeid;
            $obt_marksList=$request->obt_marks;
            $checkList=$request->checkbox;
            $aChildExam_Copy=new ChildExam_Copy();
            $checkChildExam=$aChildExam_Copy->checkChildExam($programofferid,$mst_examnameid,$child_examnameid,$exam_no);
            if(!$checkChildExam){
                $msg="Child Exam Is Not Created yet";
            }elseif($hasAllField){
                $count=0;
                foreach($checkList as $studentid=>$v){
                    $aChildExamMarks=new ChildExamMarks();
                    $aChildExamMarks->programofferid=$programofferid;
                    $aChildExamMarks->sectionid=$sectionid;
                    $aChildExamMarks->mst_examnameid=$mst_examnameid;
                    $aChildExamMarks->child_examnameid=$child_examnameid;
                    $aChildExamMarks->studentid=$studentid;
                    $aChildExamMarks->coursecodeid=$coursecodeid;
                    $aChildExamMarks->obt_marks=$obt_marksList[$studentid];
                    $check_Std_MarkEntry=$aChildExamMarks->checkMarkEntry($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$studentid,$coursecodeid);
                    if($obt_marksList[$studentid]!="" && $check_Std_MarkEntry==false){
                        $aChildExamMarks->save();
                        $count++;
                    } 
                }
                if($count>0){
                    $msg=$count." Student Mark saved";
                }elseif($count>1){
                    $msg=$count." Students Mark saved";
                }else{
                    $msg="no save data";
                }
            }
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
            $studentList=$aStudent->getStudentsOnClsNSec($programofferid,$sectionid);
            $aSection=new Section();
            $section=$aSection->getSection($sectionid);
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        $masterExamNameList=ExamName::getExamName(1);
        $childExamNameList=ExamName::getExamName(2);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'programofferinfo'=>$programofferinfo,
            'section'=>$section,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'studentList'=>$studentList,
            'courseList'=>$courseList,
            "msg"=>$msg,
        ];
        return view('admin.classexam.childexammark_entry.childExamMarkEntry',$dataList);
    }
    public function child_Exam_MarkEdit(Request $request){
        $dataList=[

        ];
        return view('admin.classexam.childexammark_entry.childExamMarkEdit',$dataList);
    }
}
