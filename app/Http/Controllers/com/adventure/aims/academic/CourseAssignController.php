<?php

namespace App\Http\Controllers\com\adventure\aims\academic;

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
use App\com\adventure\school\academic\StudentCourse;
class CourseAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function students(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('editassigncourse');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////////////////
        $aProgramOffer=new ProgramOffer();
        $aStudent=new Student();
        $aStudentCourse=new StudentCourse();
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
            $sectionid=$request->sectionid;
            // Check Program Offer Created Or Not
            $checkProgramOffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramOffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // check sectionOffer
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            $students=$aStudent->getStudentsOnProgramofferID($programofferid,$sectionid);
            foreach ($students as $student) {
                $student_courses=$aStudentCourse->getStudentCourcesForEdit($programofferid,$sectionid,$student->id);
                $student->courses=$student_courses;
            }
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
        return view('admin.academic.course_assign.students',$dataList);
    }
    public function assignCourses(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('editassigncourse');
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
        $programofferid=$request->programofferid;
        $sectionid=$request->sectionid;
        $studentid=$request->studentid;
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            $programofferid=$request->programofferid;
            $sectionid=$request->sectionid;
            $studentid=$request->studentid;
            $courseType_List=$request->coursetypeid;
            $coursecheck_List=$request->coursecheck;
            foreach($coursecheck_List as $courseid){
                $aStudentCourse=new StudentCourse();
                $aStudentCourse->studentid=$studentid;
                $aStudentCourse->courseid=$courseid;
                $aStudentCourse->coursetypeid=$courseType_List[$courseid];
                $check=$aStudentCourse->checkValue($studentid,$courseid);
                if(!$check){
                    $aStudentCourse->save();
                }else{
                    \DB::table('student_courses')
                    ->where('studentid', $studentid)
                    ->where('courseid', $courseid)
                    ->update(['coursetypeid' => $courseType_List[$courseid]]);
                }
            }
        }
        $aStudentCourse=new StudentCourse();
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $students=$aStudent->getStudentsOnProgramofferID($programofferid,$sectionid);
        foreach ($students as $student) {
            $student_courses=$aStudentCourse->getStudentCourcesForEdit($programofferid,$sectionid,$student->id);
            $student->courses=$student_courses;
        }
        $student=$students->where("id",$studentid)->first();
        // dd($student);
        $courseTypeList=CourseType::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programofferinfo'=>$programofferinfo,
            'courseTypeList'=>$courseTypeList,
            'student'=>$student,
            'msg'=>$msg
        ];
        return view('admin.academic.course_assign.student_courses',$dataList);
    }
}
