<?php

namespace App\Http\Controllers\com\adventure\school\classexam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\ProgramOffer;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\academic\Student;
use App\com\adventure\school\menu\Menu;
class TransferCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function transfer_certificate(Request $request){
        $msg="";
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('transfer_certificate');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        // ================
        $aProgramOffer=new ProgramOffer();
        $apObj=new Applicant();
        $stdObj=new Student();
        $applicant=null;
        $programofferinfo=null;
        if($request->isMethod('post')&&$request->create=='create'){
            $applicantid=$request->applicantid;
            $pin_code=$request->pin_code;
            $applicant=$apObj->getApplicant($applicantid);
            if($applicant!=null){
                $student=$stdObj->getCurrentStudent($applicantid);
                if($student!=null){
                    $programofferinfo=$aProgramOffer->getProgramOffer($student->programofferid);
                }else{
                    $msg="Invalid Student";
                }
            }else{
                $msg="Invalid Applicantid";
            }
        }
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'instituteObj'=>$instituteObj,
            'sidebarMenu'=>$sidebarMenu,
            'programofferinfo'=>$programofferinfo,
            'student'=>$applicant,
            "msg"=>$msg
        ];
        return view('admin.classexam.examresult.transfer_certificate',$dataList);
    }
}
