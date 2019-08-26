<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\PLabel;
use App\com\adventure\school\program\LabelGroup;
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
    	return view('admin.programsettings.programoffer.index_copy',$dataList);
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
        $pLabelList=PLabel::all();
        $aProgram=new Program();
        $programList=$aProgram->getPrograms();
        $mediumList=Medium::all();
        $shiftList=Shift::all();
        $groupList=Group::all();
        $aEmployee=new Employee();
        $employeeList=$aEmployee->getEmployees();
        $sectionList=Section::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            'pLabelList'=>$pLabelList,
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
        'programlabelid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
        'number_of_courses'=>'required|'
        ]);
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        // $seat=$request->seat;
        $number_of_courses=$request->number_of_courses;
        // For section table
        $sectionidList=$request->sectionid;
        $section_nameList=$request->section_name;
        $section_student_numberList=$request->section_student_number;
        $section_teacher_List=$request->section_teacher;
        $checkboxList=$request->checkbox;
        // dd($checkboxList);
        if($checkboxList==null){
            $msg="Select Section";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        // check Checked section student number field
        $total_std=0;
        foreach($checkboxList as $key=>$x){
            if($section_student_numberList[$key]==null){
                $msg=$section_nameList[$key]." Number of Student is Empty";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
            $total_std=$total_std+$section_student_numberList[$key];
        }
        // dd($total_std);
     	// Check Here. Is programoffer is Created
     	$aProgramOffer=new ProgramOffer();
     	$hasSame=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
     	if($hasSame){
            $msg="This Program Offer has Already Created";
            return redirect()->back()->with('msg',$msg);
        }
        $aProgramOffer->sessionid=$sessionid;
        $aProgramOffer->programlabelid=$programlabelid;
     	$aProgramOffer->programid=$programid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        if($cordinator!=null){
            $aProgramOffer->cordinator=$cordinator;
        }
        $aProgramOffer->seat=$total_std;
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
        // dd($aProgramOffer);
        $sessionList=Session::all();
        $pLabelList=PLabel::all();
        $aProgram=new Program();
        $programList=$aProgram->getPrograms();
        $mediumList=Medium::all();
        $shiftList=Shift::all();
        $groupList=Group::all();
        $aEmployee=new Employee();
        $employeeList=$aEmployee->getEmployees();
        $aSectionOffer=new SectionOffer();
        // dd($id);
        $sectionList=$aSectionOffer->getSectionOfferOnPO($id);
        // dd($sectionList);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'sessionList'=>$sessionList,
            "pLabelList"=>$pLabelList,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'employeeList'=>$employeeList,
            'sectionList'=>$sectionList,
            'bean'=>$aProgramOffer
        ];
        return view('admin.programsettings.programoffer.edit_copy',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'sessionid' => 'required|',
        'programlabelid' => 'required|',
        'programid' => 'required|',
        'groupid' => 'required|',
        'mediumid' => 'required|',
        'shiftid' => 'required|',
        'number_of_courses'=>'required|'
    	]);
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
     	$programid=$request->programid;
     	$groupid=$request->groupid;
     	$mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $cordinator=$request->cordinator;
        // $seat=$request->seat;
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
        $count=0;
        foreach($checkboxList as $key=>$x){
            if($section_student_numberList[$key]==null){
                if($count==0){
                    $msg="Fill in at least on Section";
                    return redirect()->back()->with('msg',$msg)->withInput($request->input());
                }
            }else{
                $count++;
            }
        }
        $total_std=0;
        foreach($section_student_numberList as $item){
            $total_std=$total_std+$item;
        }
     	// Check Here programoffer is Exist not
        $aProgramOffer=ProgramOffer::findOrfail($id);
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
        // dd($id,$programofferid);
        if($programofferid!=$id){
            $hasSame=$aProgramOffer->checkValue($sessionid,$programlabelid,$programid,$groupid,$mediumid,$shiftid);
            if($hasSame){
                $msg="This Program Offer has Already Exits";
                return redirect()->back()->with('msg',$msg);
            }
        }
     	$aProgramOffer->sessionid=$sessionid;
     	$aProgramOffer->programlabelid=$programlabelid;
     	$aProgramOffer->groupid=$groupid;
     	$aProgramOffer->mediumid=$mediumid;
        $aProgramOffer->shiftid=$shiftid;
        if($cordinator!=null){
            $aProgramOffer->cordinator=$cordinator;
        }
        $aProgramOffer->seat=$total_std;
        $aProgramOffer->number_of_courses=$number_of_courses;
        $status=\DB::transaction(function () use($id,$aProgramOffer,$sectionidList,$section_nameList,$section_student_numberList,$section_teacher_List,$checkboxList){
            $aProgramOffer->update();
            try{
                foreach($checkboxList as $key=>$x){
                    $sectionid=$sectionidList[$key];
                    $section_std_num=$section_student_numberList[$key];
                    if($section_student_numberList[$key]!=null){
                        // check section Assiogn or nor
                        $aSectionOffer=new SectionOffer();
                        $hasSection=$aSectionOffer->checkSection($id,$key);
                        $section_data=array();
                        if($section_teacher_List[$key]!=null){
                            $section_teacher=$section_teacher_List[$key];
                            $section_data=[
                                'section_std_num' => $section_std_num,
                                'section_teacher'=>$section_teacher
                            ];
                        }else{
                            $section_data=[
                                'section_std_num' => $section_std_num
                            ];
                        }
                        if($hasSection){
                            \DB::table('sectionoffer')
                            ->where('programofferid', $id)
                            ->where('sectionid', $sectionid)
                            ->update($section_data);
                        }else{
                            $aSectionOffer=new SectionOffer();
                            $aSectionOffer->programofferid=$id;
                            $aSectionOffer->sectionid=$sectionidList[$key];
                            $aSectionOffer->section_std_num=$section_student_numberList[$key];
                            if($section_teacher_List[$key]!=null){
                                $aSectionOffer->section_teacher=$section_teacher_List[$key];
                            }
                            $status=$aSectionOffer->save();
                        }
                    }else{
                        \DB::table('sectionoffer')
                        ->where('programofferid', $id)
                        ->where('sectionid', $sectionid)
                        ->delete();
                    }
                }
                return true;
            }catch(\Exception $e){
                \DB::rollback();
                return false;
            }            
        });
     	// $status=$aProgramOffer->update();
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
        $sessionid=$request->sessionid;
        $programlabelid=$request->programlabelid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        if($option=="programlabel"){
            if($methodid==1){
                $this->getProgramsOnProgramLavel($programlabelid);
            }elseif($methodid==2){
                $this->getGroupsOnProgramLavel($programlabelid);
            }
        }
        // elseif($option=="program"){
        //     if($methodid==1){
        //         $this->getGroupsOnProgram($programid);
        //     }
        // }
    }
    private function getProgramsOnProgramLavel($programlabelid){
        $aProgram=new Program();
        $result=$aProgram->getProgramOnLabelid($programlabelid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getGroupsOnProgramLavel($programlabelid){
        $aLabelGroup=new LabelGroup();
        $result=$aLabelGroup->getGroupsOnLabel($programlabelid,"INNER");
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    // private function getGroupsOnProgram($programid){
    //     $result=Group::getGroupsOnProgramID($programid);
    //     $output="<option value=''>SELECT</option>";
    //     foreach($result as $x){
    //        $output.="<option value='$x->id'>$x->name</option>";
    //     }
    //     echo  $output;
    // }
}
