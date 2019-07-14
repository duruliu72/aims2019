<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\program\CourseCode;
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
        $aSectionOffer=new SectionOffer();
        $aSection=new Section();
        $aMasterExam=new MasterExam();
        $aChildExam_Copy=new ChildExam_Copy();
        $aExamName=new ExamName();
        $aCourseOffer=new CourseOffer();
        $aCourseCode=new CourseCode();
        $aStudent=new Student();
        $programofferinfo=null;
        $sectionList=null;
        $courseList=null;
        $masterExamNameList=null;
        $childExamNameList=null;
        $studentList=null;
        $section=null;
        $master_exam_name=null;
        $child_exam_name=null;
        $chld_exam=null;
        $course=null;
        if($request->isMethod('post')&& $request->btn_next=="btn_next"){
            $validatedData = $request->validate([
                'programid' => 'required|',
                'groupid' => 'required|',
                'mediumid' => 'required|',
                'shiftid' => 'required|',
            ]);
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            //    Check Program offer Created or Not
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
            $masterExamNameList=$aMasterExam->getMasterExamOnPO($programofferid);
            $childExamNameList=$aChildExam_Copy->getChildExamOnPO($programofferid);
        }
        if($request->isMethod('post')&& $request->btn_next2=="btn_next2"){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $coursecodeid=$request->coursecodeid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $section=$aSection->getSection($sectionid);
            $master_exam_name=$aExamName->getExamONID($mst_examnameid);
            $child_exam_name=$aExamName->getExamONID($child_examnameid);
            $course=$aCourseCode->getCourse($coursecodeid);
            $chld_exam=$aChildExam_Copy->getChildExam($programofferid,$mst_examnameid,$child_examnameid);
            $aChildExamMarks=new ChildExamMarks();
            $studentList=$aChildExamMarks->getStudents($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid);
            // dd($studentList);
        }
        if($request->isMethod('post')&& $request->btn_save=="btn_save"){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $coursecodeid=$request->coursecodeid;
            $mst_examnameid=$request->mst_examnameid;
            $child_examnameid=$request->child_examnameid;
            $obt_marksList=$request->obt_marks;
            $checkList=$request->checkbox;
            $aChildExam_Copy=new ChildExam_Copy();
            $checkChildExam=$aChildExam_Copy->checkChildExam($programofferid,$mst_examnameid,$child_examnameid);
            if(!$checkChildExam){
                $msg="Child Exam Is Not Created yet";
            }else{
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
            $section=$aSection->getSection($sectionid);
            $master_exam_name=$aExamName->getExamONID($mst_examnameid);
            $child_exam_name=$aExamName->getExamONID($child_examnameid);
            $course=$aCourseCode->getCourse($coursecodeid);
            $chld_exam=$aChildExam_Copy->getChildExam($programofferid,$mst_examnameid,$child_examnameid);
            $aChildExamMarks=new ChildExamMarks();
            $studentList=$aChildExamMarks->getStudents($programofferid,$sectionid,$mst_examnameid,$child_examnameid,$coursecodeid);
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
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
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'section'=>$section,
            'master_exam_name'=>$master_exam_name,
            'child_exam_name'=>$child_exam_name,
            'chld_exam'=>$chld_exam,
            'course'=>$course,
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
        // For Ajax Call ===============
    //    ================================================================
    public function getValue(Request $request){
        $programofferid=$request->programofferid;
        $mst_examnameid=$request->mst_examnameid;
        $child_examnameid=$request->child_examnameid;
        $this->getChildExam($programofferid,$mst_examnameid,$child_examnameid);
    }
    public function getChildExam($programofferid,$mst_examnameid,$child_examnameid){
        $aChildExam_Copy=new ChildExam_Copy();
       
        $child_exam=$aChildExam_Copy->getChildExam($programofferid,$mst_examnameid,$child_examnameid);
        $mark['value']=$child_exam->hld_marks;
        $mark['output']="Marks($child_exam->hld_marks) <input type='hidden' id='hld_marks' value='$child_exam->hld_marks'>";
        echo  json_encode($mark);
    }
}
