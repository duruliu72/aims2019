<?php

namespace App\Http\Controllers\com\adventure\school\program;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\PLabel;
use App\com\adventure\school\program\Program;
use App\com\adventure\school\menu\Menu;
class ProgramControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createProgram(Request $request){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        if($request->isMethod('post')&&$request->btn_save=='btn_save'){
            $validatedData = $request->validate([
                'name' => 'required|unique:programs|max:255',
                'programlabelid'=>'required',
                ]);
                 $name=$request->name;
                 $programsign=$request->programsign;
                 $programlabelid=$request->programlabelid;
                 $aProgram=new Program();
                 $aProgram->name=$name;
                 $aProgram->programsign=$programsign;
                 $aProgram->programlabelid=$programlabelid;
                 $status=\DB::transaction(function () use($aProgram){
                    try {
                        $aProgram->save();
                        return true;
                    }catch(\Exception $e){
                        \DB::rollback();
                        return false;
                    };
                 });
                 if($status){
                     $msg="Program Created Successfully";
                  }else{
                    $msg="Program not Created";
                }
                return redirect()->back()->with('msg',$msg);
        }
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            $validatedData = $request->validate([
                'programlabelid'=>'required',
            ]);
            $id=$request->id;
            // dd($id);
            $aProgram=Program::findOrfail($id);
            $aProgram->name=$request->name;
            $aProgram->programsign=$request->programsign;
            $aProgram->programlabelid=$request->programlabelid;    
            $status=\DB::transaction(function() use($id,$aProgram){
                try{
                    $aProgram->update();
                    return true;
                }catch(\Exception $e){
                    \DB::rollback();
                    return false;
                };
            });
            if($status){
                $msg="Program Updated Successfully";
            }else{
                $msg="Program not Updated";
            }
            return redirect()->back()->with('msg',$msg);
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
        $aProgram=new Program();
        $programList=$aProgram->getPrograms();
        $plabelList=PLabel::all();
        $bean=null;
        $id=$request->id;
        if($id!=null){
            // if($pList[3]->id!=3){
            //     return redirect('error');
            // }
            $bean=Program::findOrfail($id);
            // dd($groupList);
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'plabelList'=>$plabelList,
            'programList'=>$programList,
            'bean'=>$bean
        ];
    	return view('admin.programsettings.program.programs_copy',$dataList);
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
        $aList=Program::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.program.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.program.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:programs|max:255',
        'programsign' => 'required|unique:programs|max:255',
    	]);
        $name=$request->name;
        $programsign=$request->programsign;
     	$aProgram=new Program();
        $aProgram->name=$name;
        $aProgram->programsign=$programsign;
     	$status=$aProgram->save();
     	if($status){
     		$msg="Program Created Successfully";
		  }else{
		    $msg="Program not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('program');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('program');
    	$aProgram=Program::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aProgram
        ];
        return view('admin.programsettings.program.edit',$dataList); 
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        // 'name' => 'required|unique:programs|max:255',
    	]);
        $name=$request->name;
        $programsign=$request->programsign;
     	$aProgram=Program::findOrfail($id);
        $aProgram->name=$name;
        $aProgram->programsign=$programsign;
     	$status=$aProgram->update();
     	if($status){
     		$msg="Program Updated Successfully";
		  }else{
		    $msg="Program not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
