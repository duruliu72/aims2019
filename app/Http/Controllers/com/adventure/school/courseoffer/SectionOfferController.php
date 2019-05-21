<?php

namespace App\Http\Controllers\com\adventure\school\courseoffer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\Section;
class SectionOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sectionoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sectionoffer');
        $aSectionOffer=new SectionOffer();
        $aList=$aSectionOffer->getSectionOffers();
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.courseoffer.sectionoffer.index',$dataList);
    }
    public function create(){
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sectionoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sectionoffer');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $aProgramOffer=new ProgramOffer();
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $sectionList=Section::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
        ];
        return view('admin.courseoffer.sectionoffer.create',$dataList);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'programid' => 'required|',
            'groupid' => 'required|',
            'mediumid' => 'required|',
            'shiftid' => 'required|',
        ]);
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $programid=$request->programid;
        $groupid=$request->groupid;
        $mediumid=$request->mediumid;
        $shiftid=$request->shiftid;
        $nameList=$request->name;
        $sectionidList=$request->sectionid;
        $section_studentList=$request->section_student;
        $isSectionOfferSave=false;
        $msg="";
        $checkboxList=$request->checkbox;
        if($checkboxList==null){
            $msg="Select Section";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        foreach($checkboxList as $key=>$x){
            if($section_studentList[$key]==null){
                $msg=$nameList[$key]."  is Empty";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
        }
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $isAssignSection=$aSectionOffer->isAssignSectionToProgramOffer($programofferid);
        if($isAssignSection){
            $msg="You have already asign section";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        foreach($checkboxList as $key=>$x){
            if($section_studentList[$key]!=null && $programofferid!=0){
                $aSectionOffer=new SectionOffer();
                $aSectionOffer->programofferid=$programofferid;
                $aSectionOffer->sectionid=$sectionidList[$key];
                $aSectionOffer->section_student=$section_studentList[$key];
                $status=$aSectionOffer->save();
                if($status){
                    $isSectionOfferSave=true;
                }else{
                    $isSectionOfferSave=false;
                }
            }
        }
     	if($isSectionOfferSave){
     		$msg="Section offer Created Successfully";
		  }else{
		    $msg="Section offer not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aSectionOffer=new SectionOffer();
        $isTrue=$aSectionOffer->isAssignSectionToProgramOffer($id);
        if($isTrue==false){
            abort(404);
        }
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('sectionoffer');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('sectionoffer');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aProgramOffer=ProgramOffer::findOrfail($id);
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $aSectionOffer=new SectionOffer();
        $sectionList=$aSectionOffer->getSectionOfferOnPO($id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'sectionList'=>$sectionList,
            'bean'=>$aProgramOffer,
            // 'soList'=>$soList
        ];
        return view('admin.courseoffer.sectionoffer.edit',$dataList); 
    }
    public function update(Request $request, $id){
        $checkboxList=$request->checkbox;
        $sectionidList=$request->sectionid;
        $section_studentList=$request->section_student;
        \DB::table('sectionoffer')->where('programofferid', '=', $id)->delete();
        if($checkboxList==null){
            $msg="Select Section";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $msg="";
        foreach($checkboxList as $key=>$x){
            if($section_studentList[$key]==null){
                $msg=$nameList[$key]."  is Empty";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
        }
        $aProgramOffer=ProgramOffer::findOrfail($id);
        $isSectionOfferUpdate=false;
    	foreach($checkboxList as $key=>$x){
            if($section_studentList[$key]!=null){
                $aSectionOffer=new SectionOffer();
                $aSectionOffer->programofferid=$id;
                $aSectionOffer->sectionid=$sectionidList[$key];
                $aSectionOffer->section_student=$section_studentList[$key];
                $status=$aSectionOffer->save();
                if($status){
                    $isSectionOfferUpdate=true;
                }else{
                    $isSectionOfferUpdate=false;
                }
            }
        }
     	if($isSectionOfferUpdate){
     		$msg="Section offer Updated Successfully";
		  }else{
		    $msg="Section offer not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
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
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getAllOnIDS($sessionid,$programid,$groupid,$mediumid,$shiftid,$tableName,$compareid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getSectionOfferOnPO($programid,$groupid,$mediumid,$shiftid){
        $yearName = date('Y');
        $aSession=new Session();
        $sessionid=$aSession->getSessionId($yearName);
        $aProgramOffer=new ProgramOffer();
        $aSectionOffer=new SectionOffer();
        $programofferid=$aProgramOffer->getProgramOfferId($sessionid,$programid,$groupid,$mediumid,$shiftid);
        $sectionList=$aSectionOffer->getSectionOfferOnPO($programofferid);
        $output="";
        foreach($sectionList as $x){
            if($x->sectionid!=0){
                $output.="<tr>";
                $output.="<td>$x->id<input type='hidden' name='sectionid[$x->id]' value='$x->id' /></td>";
                $output.="<td>$x->name<input type='hidden' name='name[$x->id]' value='$x->name'/></td>";
                $output.="<td class='no-padding'><input class='form-control' type='text' name='section_student[$x->id]' value='$x->section_student' /></td>";
                $output.="<td><input class='markcheck' checked type='checkbox' name='checkbox[$x->id]' /></td>";
                $output.="</tr>";
            }else{
                $output.="<tr>";
                $output.="<td>$x->id<input type='hidden' name='sectionid[$x->id]' value='$x->id' /></td>";
                $output.="<td>$x->name<input type='hidden' name='name[$x->id]' value='$x->name'/></td>";
                $output.="<td class='no-padding'><input class='form-control' type='text' name='section_student[$x->id]' value='' /></td>";
                $output.="<td><input class='markcheck' type='checkbox' name='checkbox[$x->id]' /></td>";
                $output.="</tr>";
            }
        }
        echo $output;
    }
}
