<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\program\Session;
use App\com\adventure\school\program\CourseCode;
use App\com\adventure\school\program\Section;
use App\com\adventure\school\employee\Employee;
use App\com\adventure\school\courseoffer\Mearge;
use App\com\adventure\school\courseoffer\CourseOffer;
use App\com\adventure\school\courseoffer\SectionOffer;
use App\com\adventure\school\courseoffer\SectionTeacher;
class MstExamMarkEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function markentry(){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('mstexammarkentry');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aProgramOffer=new ProgramOffer();
        $programofferinfo=$aProgramOffer->getProgramOffer(1);
        $aCourseCode=new CourseCode();
        
        // sessionid,programid,groupid,mediumid,shiftid and tableName
        
        $programList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aProgramOffer->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'programList'=>$programList,
            'groupList'=>$groupList,
            'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'programofferinfo'=>$programofferinfo,
            'msg'=>$msg
        ];
        return view('admin.classexam.markentry.markentryform',$dataList);
    }
}
