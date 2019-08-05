<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\PLabel;
use App\com\adventure\school\program\Group;
use App\com\adventure\school\program\LabelGroup;
use App\com\adventure\school\menu\Menu;
class PLabelControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createLabel(Request $request){
        // die("Die Here");
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plabel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plabel');
        if($request->isMethod('post')&&$request->btn_save=='btn_save'){
            $validatedData = $request->validate([
                'name' => 'name|unique:plabels|max:255',
                ]);
                 $name=$request->progamLabel;
                 $groupidList=$request->groupid;
                 $aPLabel=new PLabel();
                 $aPLabel->name=$name;
                 $status=\DB::transaction(function() use($aPLabel,$groupidList){
                    try{
                        if($groupidList!=null){
                            $aPLabel->save();
                            $lastPLabel=\DB::table('plabels')->orderBy('id', 'desc')->first();
                        }else{
                            return false;
                        }
                        foreach($groupidList as $groupid){
                            $aLabelGroup=new LabelGroup();
                            $aLabelGroup->programlabelid=$lastPLabel->id;
                            $aLabelGroup->groupid=$groupid;
                            $aLabelGroup->save();
                        }
                        return true;
                    }catch(\Exception $e){
                        return false;
                    }
                 });
                 if($status){
                     $msg="Class Label Created Successfully";
                  }else{
                    $msg="Class Label not Created";
                }
                return redirect()->back()->with('msg',$msg);
        }
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            // $validatedData = $request->validate([
            //     'programlavelid'=>'required',
            // ]);
            $id=$request->id;
            $name=$request->progamLabel;
            $groupidList=$request->groupid;
            // dd($id);
            $aPLabel=PLabel::findOrfail($id);
            $aPLabel->name=$name;
            $status=\DB::transaction(function()use($id,$aPLabel,$groupidList){
                try{
                    if($groupidList!=null){
                        $aPLabel->update();
                        \DB::table('label_groups')
                        ->where('programlabelid', '=', $id)->delete();
                    }
                    foreach($groupidList as $groupid){
                        $aLabelGroup=new LabelGroup();
                        $aLabelGroup->programlabelid=$id;
                        $aLabelGroup->groupid=$groupid;
                        $aLabelGroup->save();
                    }
                    return true;
                }catch(\Exception $e){
                    \DB::rollback();
                    return false;
                }
            });
            // $status=$aPLabel->update();
            if($status){
                $msg="Course Updated Successfully";
            }else{
                $msg="Course not Updated";
            }
            return redirect()->back()->with('msg',$msg);
        }
       
        $aPLabel=new PLabel();
        $plavelList=$aPLabel->getPLabels();
        $bean=null;
        $id=$request->id;
        $editgroupList=null;
        if($id!=null){
            // if($pList[3]->id!=3){
            //     return redirect('error');
            // }
            $obj=new LabelGroup();
            $editgroupList=$obj->getGroupsOnLabel($id,"LEFT");
            // dd($editgroupList);
            $bean=PLabel::findOrfail($id);
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            "groupList"=>Group::all(),
            'editgroupList'=>$editgroupList,
            'result'=>$plavelList,
            'bean'=>$bean
        ];
    	return view('admin.programsettings.label.program_label',$dataList);
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        $aList=PLevel::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.level.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.level.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programlevels|max:255',
    	]);
     	$name=$request->name;
     	$aProgramLevel=new PLevel();
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->save();
     	if($status){
     		$msg="Level Created Successfully";
		  }else{
		    $msg="Level not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('plevel');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('plevel');
    	$aProgramLevel=PLevel::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aProgramLevel
        ];
        return view('admin.programsettings.level.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$name=$request->name;
     	$aProgramLevel=PLevel::findOrfail($id);
     	$aProgramLevel->name=$name;
     	$status=$aProgramLevel->update();
     	if($status){
     		$msg="Level Updated Successfully";
		  }else{
		    $msg="Level not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
