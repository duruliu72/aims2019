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
            $checkProgramoffer=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            // dd($checkProgramoffer);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            $aSectionOffer=new SectionOffer();
            $sectionList=$aSectionOffer->getSectionsOnPO($programofferid);
            // dd($sectionList);
        }
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $programofferid=$request->programofferid;
            $nocourses=$request->number_of_courses;
            $courseidList=$request->courseid;
            $teacherList=$request->teacherid;
            $coursemarksList=$request->coursemarks;
            $checkboxList=$request->checkbox;
            if($checkboxList!=null && count($checkboxList)>=$nocourses){
                dd("Ddd");
            }
            die("Die Here");
            \DB::transaction(function() use($programofferid,$nocourses){
                try{
                    $aCourseOffer=new CourseOffer();
                    $scTeacher=new SectionCourseTeacher();
                }catch(\Exception $e){

                }
            });
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $courseList=$aCourse->getCourseOnProgramoffer($programlabelid,$programofferid,"LEFT");
        // sessionid,programlabelid,programid,groupid,mediumid,shiftid and tableName
        $sessionList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"sessions",'sessionid');
        $plabelList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"plabels",'programlabelid');
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,0,"groups",'groupid');
        $teacherList=Employee::all();
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
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.create',$dataList);
    }
    public function editCourseOffer(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('courseoffercreate');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        ///////////////////////////////////
        $aProgramOffer=new ProgramOffer();
        $aCourseCode=new CourseCode();
        $programofferid=0;
        if($request->isMethod('post')&&$request->search_btn=='search_btn'){
            $programid=$request->programid;
            $groupid=$request->groupid;
            $mediumid=$request->mediumid;
            $shiftid=$request->shiftid;
            $checkProgramoffer=$aProgramOffer->checkValue(0,$programid,$groupid,$mediumid,$shiftid);
            if(!$checkProgramoffer){
                $msg="Program Offer is not created yet";
                return redirect()->back()->with('msg',$msg);
            }
            $programofferid=$aProgramOffer->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        }
        if($request->isMethod('post')&&$request->update_btn=='update_btn'){
            $programofferid=$request->programofferid;
            $checkboxList=$request->checkbox;
            // $coursecodeidList=$request->coursecodeid;
            $teacherList=$request->teacherid;
            $coursemarksList=$request->coursemarks;
            $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
            if($checkboxList!=null){
                // transition will have to done
                $status=\DB::transaction(function () use($programofferid,$checkboxList,$coursemarksList,$teacherList){
                    $checkfield=true;
                    foreach($checkboxList as $key=>$v){
                        if($coursemarksList[$key]==null){
                            $checkfield=false;
                        }
                    }
                    $save_item=0;
                    foreach($checkboxList as $key=>$v){
                        $aCourseOffer=new CourseOffer();
                        $aCourseOffer->programofferid=$programofferid;
                        $aCourseOffer->coursecodeid=$key;
                        if($teacherList[$key]!=null){
                            $aCourseOffer->teacherid=$teacherList[$key];
                        }
                        $aCourseOffer->coursemark=$coursemarksList[$key];
                        $aCourseOffer->meargeid=$key;
                        if($aCourseOffer->isSameCourse($programofferid,$key)==true&&$checkfield==true){
                            \DB::table('courseoffer')
                            ->where('programofferid', $programofferid)
                            ->where('coursecodeid', $key)
                            ->update([
                                'coursemark' => $coursemarksList[$key],
                                'teacherid'=>$teacherList[$key],
                                "meargeid"=>$key
                            ]);
                            $save_item++;
                        }elseif($aCourseOffer->isSameCourse($programofferid,$key)==false&&$checkfield==true){
                            $aCourseOffer->save();
                            $save_item++;
                        }
                    }
                    if($save_item==count($checkboxList)){
                        return true;
                    }
                    return false;
                });
                if($status){
                    $msg="Item save Successfully";
                }else{
                    $msg="Item not save";
                }
            }else{
                $msg="Select at Lest one Courses";
                return redirect()->back()->with('msg',$msg);
            }
        }
        $programofferinfo=$aProgramOffer->getProgramOffer($programofferid);
        $courseList=$aCourseCode->getAllCourseOnProgramOffer($programofferid);
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $teacherList=Employee::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'teacherList'=>$teacherList,
            'programofferinfo'=>$programofferinfo,
            'courseList'=>$courseList,
            'msg'=>$msg
        ];
        return view('admin.courseoffer.courseoffer.edit',$dataList);
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
