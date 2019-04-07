<?php

namespace App\Http\Controllers\com\adventure\school\academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\admission\Applicant;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index1(Request $request){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('student');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aObj=null;
        if($request->isMethod('post')&&$request->find=='find'){
            $aApplicant=new Applicant();
            $applicantid=$request->applicantid;
            $aObj=$aApplicant->getApplicantByApplicantID($applicantid);
            if($aObj==null) {
                $msg="Wrong Appicant Id";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
        }
        $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'aObj'=>$aObj
        ];
        return view('admin.academic.student.index',$dataList);
    }
}
