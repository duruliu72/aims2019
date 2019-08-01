<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\Medium;
use App\com\adventure\school\program\Shift;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\menu\Menu;

class ProgramOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
        $aProgramOffer=new ProgramOffer();
        $aList=$aProgramOffer->getProgramOffers();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.programoffer.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $sessionList=Session::all();
        $programList=Program::getProgramsOnLevel();
        $mediumList=Medium::all();
        $shiftList=Shift::all();
        $groupList=Group::getGroupsOnProgram();
        $aEmployee=new Employee();
        $employeeList=$aEmployee->getEmployees();
        $sectionList=Section::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            'programList'=>$programList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
            'employeeList'=>$employeeList,
            'sectionList'=>$sectionList
        ];
        return view('admin.programsettings.programoffer.create_copy',$dataList);
    }
    public function store(Request $request){
        
     	$validatedData = $request->validate([
        'sessionid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
        'seat'=>'required|',
        'number_of_courses'=>'required|'
        ]);
     	$sessionid=$request->sessionid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        $seat=$request->seat;
        $number_of_courses=$request->number_of_courses;
        // For section table
        $sectionidList=$request->sectionid;
        $section_nameList=$request->section_name;
        $section_student_numberList=$request->section_student_number;
        $section_teacher_List=$request->section_teacher;
        $checkboxList=$request->checkbox;
        if($checkboxList==null){
            $msg="Select Section";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        // check Checked section student number field 
        foreach($checkboxList as $key=>$x){
            if($section_student_numberList[$key]==null){
                $msg=$section_nameList[$key]." Number of Student is Empty";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
        }
        // die("Die here");
     	// Check Here. Is programoffer is Created
     	$aProgramOffer=new ProgramOffer();
     	$hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
     	if($hasSame){
            $msg="This Program Offer has Already Created";
            return redirect()->back()->with('msg',$msg);
        }
     	$aProgramOffer->sessionid=$sessionid;
     	$aProgramOffer->programid=$programid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        if($cordinator!=null){
            $aProgramOffer->cordinator=$cordinator;
        }
        $aProgramOffer->seat=$seat;
        $aProgramOffer->number_of_courses=$number_of_courses;
        $status=\DB::transaction(function () use($aProgramOffer,$sectionidList,$section_nameList,$section_student_numberList,$section_teacher_List,$checkboxList){
            try {
                $aProgramOffer->save();
                $lastOne=\DB::table('programoffers')->orderBy('id', 'desc')->first();
                foreach($checkboxList as $key=>$x){
                    if($section_student_numberList[$key]!=null){
                        $aSectionOffer=new SectionOffer();
                        $aSectionOffer->programofferid=$lastOne->id;
                        $aSectionOffer->sectionid=$sectionidList[$key];
                        $aSectionOffer->section_std_num=$section_student_numberList[$key];
                        if($section_teacher_List[$key]!=null){
                            $aSectionOffer->section_teacher=$section_teacher_List[$key];
                        }
                        $status=$aSectionOffer->save();
                    }
                }
                return true;
            }catch(\Exception $e){
                    \DB::rollback();
                    return false;
            }
        });
     	if($status){
     		$msg="Program Offer Created Successfully";
		  }else{
		    $msg="Program Offer not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('programoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('programoffer');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aProgramOffer=ProgramOffer::findOrfail($id);
        $sessionList=Session::all();
        $programList=Program::getProgramsOnLevel();
        $mediumList=Medium::all();
        $shiftList=Shift::all();
        $groupList=Group::getGroupsOnProgram();
        $aEmployee=new Employee();
        $employeeList=$aEmployee->getEmployees();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'employeeList'=>$employeeList,
            'bean'=>$aProgramOffer
        ];
        return view('admin.programsettings.programoffer.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'sessionid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
    	]);
     	$sessionid=$request->sessionid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        $seat=$request->seat;
        $number_of_courses=$request->number_of_courses;
     	// dd($shiftid);
     	// Check Here programoffer is Exist not
        $aProgramOffer=ProgramOffer::findOrfail($id);
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        if($programofferid!=$id){
            $hasSame=$aProgramOffer->checkValue($sessionid,$programid,$groupid,$mediumid,$shiftid);
            if($hasSame){
                $msg="This Program Offer has Already Exits";
                return redirect()->back()->with('msg',$msg);
            }
        }
     	$aProgramOffer->sessionid=$sessionid;
     	$aProgramOffer->programid=$programid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        if($cordinator!=null){
            $aProgramOffer->cordinator=$cordinator;
        }
        $aProgramOffer->seat=$seat;
        $aProgramOffer->number_of_courses=$number_of_courses;
     	$status=$aProgramOffer->update();
     	if($status){
     		$msg="Program Offer Updated Successfully";
		  }else{
		    $msg="Program Offer not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    // For Ajax Call ===============
    public function getValue(Request $request){
        $option=$request->option;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        if($option=="program"){
            if($methodid==1){
                $this->getGroupsOnProgram($programid);
            }
        }
    }
    private function getGroupsOnProgram($programid){
        $result=Group::getGroupsOnProgramID($programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
