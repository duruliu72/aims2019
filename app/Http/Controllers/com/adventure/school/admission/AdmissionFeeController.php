<?php

namespace App\Http\Controllers\com\adventure\school\admission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\BillAccount;
class AdmissionFeeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionfee');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('admissionfee');
        $aApplicant=new Applicant();
        $aList=$aApplicant->getAllApplicantStatus();
         $dataList=[
                'sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList
        ];
        return view('admin.admissionsettings.admissionfee.index',$dataList);
    }
    public function payment($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionfee');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aApplicant=Applicant::findOrfail($id);
        $aObj=$aApplicant->getApplicantByApplicantID($aApplicant->applicantid);
         $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'aObj'=>$aObj
        ];
        return view('admin.admissionsettings.admissionfee.payment',$dataList);
    }
    public function Paymentstore(Request $request){
         $programofferid=$request->programofferid;
        $applicantid=$request->applicantid;
        $amount=$request->amount;
        $aBillAccount=new BillAccount();
        $aBillAccount->programofferid=$programofferid;
        $aBillAccount->sender_receiver=$applicantid;
        $aBillAccount->amount=$amount;
        $status=$aBillAccount->save();
        // Check Amount For an Applicant And Generate Admission Roll
        $aBillAccount->generateAdmissionRoll($applicantid);
        if($status){
             $msg="Transacton Successfully";
          }else{
            $msg="Transacton Error";
        }
        return redirect()->back()->with('msg',$msg);
    }
    // ==================================================================
    public function index1(Request $request){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('admissionfee/pay');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $aObj=null;
        if($request->isMethod('post')&&$request->find=='find'){
            $aApplicant=new Applicant();
            $applicantid=$request->applicantid;
            $aObj=$aApplicant->getApplicantByApplicantID($applicantid);
            // dd($aObj);
            if($aObj==null) {
                $msg="Wrong Appicant Id";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
        }
        if($request->isMethod('post')&&$request->save=='save'){
            $status=$this->store1($request);
            if($status){
                $msg="Transacton Successfully";
                return redirect()->back()->with('msg',$msg)->withInput($request->input());
            }
            $msg="Transacton Error";
            return redirect()->back()->with('msg',$msg)->withInput($request->input()); 
        }
        $dataList=[
                'sidebarMenu'=>$sidebarMenu,
                'aObj'=>$aObj
        ];
        return view('admin.admissionsettings.admissionfee.index1',$dataList);
    }
    public function store1(Request $request){
        $programofferid=$request->programofferid;
        $applicantid=$request->applicantid;
        $amount=$request->amount;
        $aBillAccount=new BillAccount();
        $aBillAccount->programofferid=$programofferid;
        $aBillAccount->sender_receiver=$applicantid;
        $aBillAccount->amount=$amount;
        $status=$aBillAccount->save();
        // Check Amount For an Applicant And Generate Admission Roll
        $aBillAccount->generateAdmissionRoll($applicantid);
        return $status;
    }
}
