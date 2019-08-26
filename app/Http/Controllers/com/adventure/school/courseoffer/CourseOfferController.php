<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Course;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\courseoffer\SectionCourseTeacher;
class CourseOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createCourseOffer(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('courseoffercreate');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////////////////
        $aProgramOffer=new ProgramOffer();
        $aCourse=new Course();
        $programofferid=0;
        $programlabelid=0;
        $sectionList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            // Check Programoffer
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // dd($checkProgramoffer);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // dd($sectionList);
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $alreadySaved=$request->alreadySaved;
            $programofferid=$request->programofferid;
            $programlabelid=$request->programlabelid;
            $nocourses=$request->number_of_courses;
            $courseidList=$request->courseid;
            $courseNameList=$request->courseName;
            $courseCodeList=$request->courseCode;
            $teacherList=$request->teacherid;
            $coursemarksList=$request->coursemarks;
            $checkboxList=$request->checkbox;
            $request->flash();
            $fieldinCourses=0;
            if($checkboxList!=null){
                ["fieldinCourses"=>$fieldinCourses,"msg"=>$msg]=$this->MarkFieldCheck($checkboxList,$coursemarksList,$courseNameList,$courseCodeList);
                // dd($fieldinCourses);
            }else{
                $msg="Please Select At least One  Subjects";
            }
            if($fieldinCourses==count($checkboxList)){
            //    dd($fieldinCourses,count($checkboxList));
                $status=\DB::transaction(function() use($programofferid,$nocourses,$checkboxList,$courseidList,$coursemarksList,$teacherList){
                    try{
                        foreach($checkboxList as $cb_courseid=>$val){
                            $aCourseOffer=new CourseOffer();
                            $aCourseOffer->programofferid=$programofferid;
                            $aCourseOffer->courseid=$courseidList[$cb_courseid];
                            $aCourseOffer->coursemark=$coursemarksList[$cb_courseid];
                            $aCourseOffer->meargeid=$courseidList[$cb_courseid];
                            // $check Course Assign Or Not
                            $checkCourse=$aCourseOffer->checkCouseOffer($programofferid,$courseidList[$cb_courseid]);
                            if(!$checkCourse){
                                $aCourseOffer->save();
                                foreach($teacherList[$cb_courseid] as $key_sectionid=>$teacherid){
                                    $scTeacher=new SectionCourseTeacher();
                                    $scTeacher->programofferid=$programofferid;
                                    $scTeacher->sectionid=$key_sectionid;
                                    $scTeacher->courseid=$courseidList[$cb_courseid];
                                    $scTeacher->teacherid=$teacherid;
                                    $scTeacher->save();
                                }
                            }
                        }
                        return true;
                    }catch(\Exception $e){
                        // dd($e);
                        \DB::rollback();
                        return false;
                    }
                });
                if($status){
                    $msg="Course Offer Successfully";
                }else{
                    $msg="Course Offered not create";
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $aSectionOffer=new SectionOffer();
        $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
        // dd($programlabelid,$programofferid);
        $courseList=$aCourse->getCourseOnProgramoffer($programlabelid,$programofferid,"LEFT");
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $teacherList=Employee::all();
        // dd($teacherList);
        $aSCTeacher=new SectionCourseTeacher();
        $scteacherList=$aSCTeacher->getSectionCourseTeacher($programofferid);
        // dd($scteacherList);
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'teacherList'=>$teacherList,
            'programofferinfo'=>$programofferinfo,
            "sectionList"=>$sectionList,
            'courseList'=>$courseList,
            'scteacherList'=>$scteacherList,
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.create',$dataList);
    }
    public function editCourseOffer(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('editcourseoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////////////////
        $aProgramOffer=new ProgramOffer();
        $aCourse=new Course();
        $programofferid=0;
        $programlabelid=0;
        $sectionList=null;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $sessionid=$request->sessionid;
            $programlabelid=$request->programlabelid;
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            // Check Programoffer
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // dd($checkProgramoffer);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // dd($sectionList);
        }
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            $alreadySaved=$request->alreadySaved;
            $programofferid=$request->programofferid;
            $programlabelid=$request->programlabelid;
            $nocourses=$request->number_of_courses;
            $courseidList=$request->courseid;
            $courseNameList=$request->courseName;
            $courseCodeList=$request->courseCode;
            $teacherList=$request->teacherid;
            $coursemarksList=$request->coursemarks;
            $checkboxList=$request->checkbox;
            // dd($checkboxList);
            $request->flash();
            $fieldinCourses=0;
            if($checkboxList!=null){
                ["fieldinCourses"=>$fieldinCourses,"msg"=>$msg]=$this->MarkFieldCheck($checkboxList,$coursemarksList,$courseNameList,$courseCodeList);
                // dd($fieldinCourses);
            }else{
                $msg="Please Select At least a Subjects";
                // dd($msg);
            }
            // die("Die Here");
            if($fieldinCourses>0){
                $status=\DB::transaction(function() use($programofferid,$nocourses,$checkboxList,$courseidList,$coursemarksList,$teacherList){
                    try{
                        foreach($checkboxList as $cb_courseid=>$val){
                            // $check Course Assign Or Not
                            $aCourseOffer=new CourseOffer();
                            $checkCourse=$aCourseOffer->checkCouseOffer($programofferid,$courseidList[$cb_courseid]);
                            if($checkCourse){
                                \DB::table('courseoffer')
                                ->where('programofferid',$programofferid)
                                ->where('courseid', $courseidList[$cb_courseid])
                                ->update(['coursemark' => $coursemarksList[$cb_courseid]]);
                                foreach($teacherList[$cb_courseid] as $key_sectionid=>$teacherid){
                                    \DB::table('section_course_teachers')
                                    ->where('programofferid',$programofferid)
                                    ->where('sectionid', $key_sectionid)
                                    ->where('courseid', $courseidList[$cb_courseid])
                                    ->update(['teacherid' => $teacherid]);
                                }
                            }
                        }
                        return true;
                    }catch(\Exception $e){
                        // dd($e);
                        \DB::rollback();
                        return false;
                    }
                });
                if($status){
                    $msg="Course Update Successfully";
                }else{
                    $msg="Course Offered not Update";
                }
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $aSectionOffer=new SectionOffer();
        $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
        $courseList=$aCourse->getCourseOnProgramoffer($programlabelid,$programofferid,"INNER");
        // dd($courseList);
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $teacherList=Employee::all();
        // dd($teacherList);
        $aSCTeacher=new SectionCourseTeacher();
        $scteacherList=$aSCTeacher->getSectionCourseTeacher($programofferid);
        // dd($scteacherList);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "plabelList"=>$plabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'teacherList'=>$teacherList,
            'programofferinfo'=>$programofferinfo,
            "sectionList"=>$sectionList,
            'courseList'=>$courseList,
            'scteacherList'=>$scteacherList,
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.edit',$dataList);
    }
    // Helper Method
    private function MarkFieldCheck($checkboxList,$coursemarksList,$courseNameList,$courseCodeList){
        $fieldinCourses=0;
        foreach($checkboxList as $ck_courseid=>$val){
            if($coursemarksList[$ck_courseid]!=null){
                $fieldinCourses++;
            }
        }
        foreach($checkboxList as $ck_courseid=>$val){
            if($coursemarksList[$ck_courseid]===null){
                return array(
                    "fieldinCourses"=>$fieldinCourses,
                    "msg"=>$courseNameList[$ck_courseid]."(".$courseCodeList[$ck_courseid].") Mark Field Empty"
                );
            }
        }
        return array(
            "fieldinCourses"=>$fieldinCourses,
            "msg"=>""
        );
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
}
