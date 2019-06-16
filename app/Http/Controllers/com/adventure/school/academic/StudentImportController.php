<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Exports\ApplicantsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\basic\Divisions;
use App\Imports\DivisionsImport;
class StudentImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('studentimport');
       
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('studentimport');
        $applicant_data=\DB::table("applicants")->get();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'applicant_data'=>$applicant_data
        ];
        return view("export_import.export_excel",$dataList);
    }
    public function export()
    {
        return Excel::download(new ApplicantsExport, 'applicants.xlsx');
    }
    public function studentImport(Request $request){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('studentimport');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('studentimport');
        if($request->isMethod('post')&&$request->save_btn=='save_btn'){
            $xlsfile=$request->xlsfile;
            Excel::import(new DivisionsImport, $xlsfile);
            return redirect('studentimport')->with('success');
        }
        $aProgramOffer=new ProgramOffer();
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
	    	'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
            'pList'=>$pList,
        ];
    	return view('admin.academic.studentimport.create',$dataList);
    }
}
