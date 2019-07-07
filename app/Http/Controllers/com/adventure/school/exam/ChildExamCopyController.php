<?php

namespace App\Http\Controllers\com\adventure\school\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\exam\ExamName;
use App\com\adventure\school\exam\MasterExam;
use App\com\adventure\school\exam\ChildExamCourse;
use App\com\adventure\school\exam\ChildExam;

class ChildExamCopyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childExamCrete(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('childexam');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('childexam');
        // ======================
        $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $aMasterExam=new MasterExam();
        $aChildExam=new ChildExam();
        $masterExamNameList=null;
        $childExamNameList=null;
        $courseofferList=null;
        $programoffer=null;
        if($request->isMethod('post')&& $request->next=="next"){
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
            //Check Master Exam has jbeen Created or Not on Programoffer
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
            $hasMasterExam=$aMasterExam->hasMasterExam($programofferid);
            if(!$hasMasterExam){
                $msg="Please set up master exam at first on Class";
                return redirect()->back()->with('msg',$msg);
            }
            // check Minimum Courses on programoffer
            $num_of_courses=$aCourseOffer->getMinimumCourses($programofferid);
            $programoffer=$aProgramOffer->getProgramOffer($programofferid);
            if($num_of_courses<$programoffer->number_of_courses){
                $msg="please Offer minimum courses";
                return redirect()->back()->with('msg',$msg);
            }
            $courseofferList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
            // dd($courseofferList);
            $masterExamNameList=$aMasterExam->getMasterExamOnPO($programofferid);
            // dd($masterExamNameList);
        }
        if($request->isMethod('post')&& $request->btn_save=="btn_save"){
            $programofferid=$request->programofferid;
            $coursecodeidList=$request->coursecodeid;
            $marksList=$request->marks;
            $masterexamid=$request->masterexamid;
            $examnameid=$request->examnameid;
            $masterexamObj=$aMasterExam->getMasterExamOnPOAndExamNameId($programofferid,$masterexamid);
            $master_exam_id=$masterexamObj->id;
            $checkChldExam=$aChildExam->hasItem($master_exam_id,$examnameid);
            $isAllFill=true;
            foreach($coursecodeidList as $k=>$v){
                if($marksList[$k]==""){
                    $isAllFill=false;
                }
            }
            if($isAllFill){
                if(!$checkChldExam){
                    \DB::transaction(function () use($master_exam_id,$examnameid,$coursecodeidList,$marksList){
                        $childObj=new ChildExam();
                        $childObj->master_exam_id=$master_exam_id;
                        $childObj->examnameid=$examnameid;
                        $childObj->save();
                        $childexamObj=$childObj->getChildExamOnMasterExam($master_exam_id,$examnameid);
                        $child_exam_id=$childexamObj->id;
                        foreach($coursecodeidList as $k=>$v){
                            $aChildExamCourse=new ChildExamCourse();
                            $aChildExamCourse->child_exam_id=$child_exam_id;
                            $aChildExamCourse->coursecodeid=$v;
                            $aChildExamCourse->marks=$marksList[$k];
                            $aChildExamCourse->save();
                        }
                    });
                }else{
                    $msg="You already assign marks";
                }
            }else{
                $msg="Please fill in all subject marks";
            }
            $programoffer=$aProgramOffer->getProgramOffer($programofferid);
            $courseofferList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
            // dd($courseofferList);
            $masterExamNameList=$aMasterExam->getMasterExamOnPO($programofferid);
            // dd("Die Here");
        }
        $programList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aMasterExam->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $childExamNameList=ExamName::getExamName(2);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'pList'=>$pList,
            'masterExamNameList'=>$masterExamNameList,
            'childExamNameList'=>$childExamNameList,
            'courseofferList'=>$courseofferList,
            "programoffer"=>$programoffer,
            "msg"=>$msg,
        ];
        return view('admin.exam.childexam.childexamcreate_copy',$dataList);
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
            if($methodid==1){
                $this->getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid);
            }elseif($methodid==2){
                $this->getAllCourses($programid,$groupid,$mediumid,$shiftid);
            }
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
        $aMasterExam=new MasterExam();
        $result=$aMasterExam->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllCourses($programid,$groupid,$mediumid,$shiftid){
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $aChildExamCourse=new ChildExamCourse();
        $result=$aChildExamCourse->getAllCourses($programofferid);
        $output="";
        $sino=0;
        foreach($result as $x){
            $sino++;
            $output.="<tr>";
            $output.="<td>".$sino."<input type='hidden' name='courseofferid[$x->id]' value=".$x->id."></td>";
            $output.="<td>".$x->courseName."</td>";
            $output.="<td>".$x->courseCode."</td>";
            $output.="<td ><input  class=form-control' type='text' name='marks[$x->id]' value='10'></td>";
            $output.="</tr>";
        }
        echo  $output;
    }
    
    private function getExamNameOnProgramOffer($programid,$groupid,$mediumid,$shiftid){
        $aExamName=new ExamName();
        $aProgramOffer=new ProgramOffer();
        $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        $result=$aExamName->getExamNameOnProgramOffer($programofferid,1);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
