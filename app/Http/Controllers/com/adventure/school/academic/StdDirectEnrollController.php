<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\basic\Gender;
use App\com\adventure\school\basic\Religion;
use App\com\adventure\school\basic\Quota;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\program\CourseType;
use App\com\adventure\school\academic\Student;
use App\com\adventure\school\academic\StudentHouse;
use App\com\adventure\school\academic\StudentCourse;
class StdDirectEnrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function stdDirectEroll(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('directenroll');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $sectionList=null;
        $courseList=null;
        $courseTypeList=null;
        $field_data=null;
        $aProgramOffer=new ProgramOffer();
        $aCourseOffer=new CourseOffer();
        $aSectionOffer=new SectionOffer();
        $programofferid=0;
        if($request->isMethod('post')&&$request->next_btn=='next_btn'){
            $validatedData = $request->validate([
                'programid' => 'required',
                'mediumid' => 'required',
                'shiftid' => 'required',
                'groupid' => 'required',
                // 'firstName' => 'required',
                // 'motherName' => 'required',
                // 'dob' => 'required',
                // 'phone' => 'required',
                // 'genderid' => 'required',
                // 'religionid' => 'required',
                // 'quotaid' => 'required',
                ]);
            $request->flash();
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $firstName=$request->firstName;
            $middleName=$request->middleName;
            $lastName=$request->lastName;
            $phone=$request->phone;
            $fatherName=$request->fatherName;
            $motherName=$request->motherName;
            $dob=$request->dob;
            $genderid=$request->genderid;
            $religionid=$request->religionid;
            $quotaid=$request->quotaid;
            // Check Program Offer Created Or Not
            $checkProgramOffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramOffer){
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
            $field_data=[
                "programofferid"=>$programofferid,
                "firstName"=>$firstName,
                "middleName"=>$middleName,
                "lastName"=>$lastName,
                "phone"=>$phone,
                "fatherName"=>$fatherName,
                "motherName"=>$motherName,
                "dob"=>$dob,
                "genderid"=>$genderid,
                "religionid"=>$religionid,
                "quotaid"=>$quotaid
            ];
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $programofferid=$request->programofferid;;
            $firstName=$request->firstName;
            $middleName=$request->middleName;
            $lastName=$request->lastName;
            $fatherName=$request->fatherName;
            $motherName=$request->motherName;
            $genderid=$request->genderid;
            $religionid=$request->religionid;
            $quotaid=$request->quotaid;
            $picture=$request->picture;
            $signature=$request->signature;            
            $aApplicant=new Applicant();
            $applicantid=$aApplicant->makeAppicantid($programofferid);
            $aApplicant->applicantid=$applicantid;
            $aApplicant->pin_code=$this->pingenerate();
            $aApplicant->firstName=$request->firstName;
            $aApplicant->middleName=$request->middleName;
            $aApplicant->lastName=$request->lastName;
            $aApplicant->phone=$request->phone;
            $aApplicant->fatherName=$request->fatherName;
            $aApplicant->motherName=$request->motherName;
            $aApplicant->dob=date("Y-m-d", strtotime($request->dob));
            $aApplicant->genderid=$request->genderid;
            $aApplicant->religionid=$request->religionid;
            $aApplicant->quotaid=$request->quotaid;

            $upload_picture = $request->file('picture');
            if($upload_picture!=null){
                $explode_picture=explode('.',$upload_picture->getClientOriginalName());
                $extention=end($explode_picture);
                $picture=$applicantid.'.'.$extention;
                $destination=public_path('clientAdmin/admission/student');
                $upload_picture->move($destination,$picture);
                $aApplicant->picture=$picture;
            }
            $upload_signature= $request->file('signature');
            if($upload_signature!=null){
                $explode_signature=explode('.',$upload_signature->getClientOriginalName());
                $extention=end($explode_signature);
                $signature=$applicantid.'_signature.'.$extention;
                $destination=public_path('clientAdmin/admission/student');
                $upload_signature->move($destination,$signature);
                $aApplicant->signature=$signature;
            }
            $coursecheckList=$request->coursecheck;
            if($coursecheckList){
                $aStudentHouse=new StudentHouse();
                $aStudentHouse->programofferid=$programofferid;
                $aStudentHouse->applicantid=$applicantid;
                // Direct admittedtypeid value=1
                $aStudentHouse->admittedtypeid=1;
                $coursetypeidList=$request->coursetypeid;
                $sectionid=$request->sectionid;
                $classroll=$request->classroll;

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
                    $status=\DB::transaction(function () use($coursecheckList,$coursetypeidList,$programofferid,$applicantid,$aApplicant,$aStudentHouse,$aStudent){
                        $aApplicant->save();
                        $hasValue=$aStudentHouse->check($programofferid,$applicantid);
                        if(!$hasValue){
                            $aStudentHouse->save();      
                        }
                        $aStudent->save();
                        $studentid=$aStudent->getLastID();
                        foreach ($coursecheckList as $key => $value) {
                            $aStudentCourse= new StudentCourse();
                            $aStudentCourse->studentid=$studentid;
                            $aStudentCourse->coursecodeid=$key;
                            $aStudentCourse->coursetypeid=$coursetypeidList[$key];
                            $aStudentCourse->save();
                        }
                    });
                    $msg="Student Registered Successfuly";
                }else{
                    $msg="Applicant Already Registered";
                }
            }
        }
        // sessionid,programid,groupid,mediumid,shiftid,tableName and $compaireid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        // dd($programofferinfo);
        $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
        $courseList=$aCourseOffer->getCoursesOnProgramOffer($programofferid);
        $courseTypeList=CourseType::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'programofferinfo'=>$programofferinfo,
            'sectionList'=>$sectionList,
            'courseList'=>$courseList,
            'courseTypeList'=>$courseTypeList,
            'genderList'=>Gender::all(),
            'religionList'=>Religion::all(),
            'quotaList'=>Quota::all(),
            'field_data'=>$field_data,
            'msg'=>$msg
        ];
        return view('admin.academic.student.studentdirect_enroll',$dataList);
    }
    public function pingenerate(){
		$pinstr="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$length=strlen($pinstr);
		$codeArray=array();
		$pin_code="";
		for($i=0;$i<$length;$i++){
			$codeArray[$i]=$pinstr[$i];
		}
		for($i=0;$i<6;$i++){
			$pin_code.=$codeArray[rand(0,61)];
		}
		return $pin_code;
	}
}
