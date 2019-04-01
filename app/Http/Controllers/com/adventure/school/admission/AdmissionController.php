<?php

namespace App\Http\Controllers\com\adventure\school\admission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\Admission;
use App\com\adventure\school\admission\VAdmissionSubject;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionResult;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\Gender;
use App\com\adventure\school\basic\Quota;
use App\com\adventure\school\basic\Religion;
use App\com\adventure\school\basic\Nationality;
use App\com\adventure\school\basic\BloodGroup;
use App\com\adventure\school\basic\Division;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\basic\PostOffice;
use App\com\adventure\school\basic\LocalGov;
use App\com\adventure\school\basic\Address;
class AdmissionController extends Controller
{
    
    public function index(){
        $aAdmission=new Admission();
    	$dataList=[
    		'programList'=>$aAdmission->getAllProgram(0),
	    	'mediumList'=>$aAdmission->getAllMedium(0),
	    	'shiftList'=>$aAdmission->getAllShift(0),
    		'genderList'=>Gender::all(),
    		'quotaList'=>Quota::all(),
    		'religionList'=>Religion::all(),
    		'nationaityList'=>Nationality::all(),
    		'bloodgroupLst'=>BloodGroup::all(),
    		'divisionList'=>Division::all(),
    		'districtList'=>array(),
    		'thanaList'=>array(),
    		'postofficeList'=>array(),
    		'localgov'=>array(),
    	];
    	return view('school.admission.admission',$dataList);
    }
    public function store(Request $request){
    	$isChecked=$request->isChecked;
    	$validatedData = $request->validate([
        	'programid' => 'required',
        	'groupid' => 'required',
        	'mediumid' => 'required',
        	'shiftid' => 'required',
        	'name' => 'required',
        	'fatherName' => 'required',
        	'motherName' => 'required',
        	'dob' => 'required',
        	'birthregno' => 'required',
        	'genderid' => 'required',
        	'bloodgroupid' => 'required',
        	'religionid' => 'required',
        	'nationalityid' => 'required',
        	'quotaid' => 'required',
        	'divisionid' => 'required',
        	'districtid' => 'required',
        	'thanaid' => 'required',
        	'postofficeid' => 'required',
        	'postcode' => 'required',
        	'localgovid' => 'required',
        	'address' => 'required',
        	'g_divisionid' => 'required',
        	'g_districtid' => 'required',
        	'g_thanaid' => 'required',
        	'g_postofficeid' => 'required',
        	'g_postcode' => 'required',
        	'g_localgovid' => 'required',
        	'g_address' => 'required',
            'username' => 'required',    	]);
    	$request->flash();
    	$aApplicant=new Applicant();
    	$programid=$request->programid;
    	$groupid=$request->groupid;
    	$mediumid=$request->mediumid;
    	$shiftid=$request->shiftid;
    	$aAdmissionProgram=new AdmissionProgram();
    	// find programofferid id 
    	$programofferid=$aAdmissionProgram->getProgramOfferId(0,$programid,$groupid,$mediumid,$shiftid);
        // Create Applicant id
        $applicantid=$aApplicant->makeAppicantid($programofferid);
        // dd($applicantid);
    	$aApplicant->programofferid=$programofferid;
        $aApplicant->applicantid=$applicantid;
    	$aApplicant->name=$request->name;
    	$aApplicant->fatherName=$request->fatherName;
    	$aApplicant->motherName=$request->motherName;
    	$aApplicant->f_occupation=$request->f_occupation;
    	$aApplicant->m_occupation=$request->m_occupation;
    	$aApplicant->father_nid=$request->father_nid;
    	$aApplicant->mother_nid=$request->mother_nid;
    	$aApplicant->father_Phone=$request->father_Phone;
    	$aApplicant->mother_Phone=$request->mother_Phone;
    	$aApplicant->dob=date("Y-m-d", strtotime($request->dob));
    	// dd($aApplicant->dob);
    	$aApplicant->age=$request->age;
    	$aApplicant->birthregno=$request->birthregno;
    	$aApplicant->birthpalace=$request->birthpalace;
    	$aApplicant->genderid=$request->genderid;
    	$aApplicant->bloodgroupid=$request->bloodgroupid;
    	$aApplicant->marital_status=$request->marital_status;
    	$aApplicant->religionid=$request->religionid;
    	$aApplicant->nationalityid=$request->nationalityid;
    	$aApplicant->ethnicty=$request->ethnicty;
    	$aApplicant->quotaid=$request->quotaid;
    	$aApplicant->abled=$request->abled;
    	$aApplicant->email=$request->email;
    	$aApplicant->parent_income=$request->parent_income;
    	// Present Address
    	$presentAddress=new Address();
    	$presentAddress->divisionid=$request->divisionid;
    	$presentAddress->districtid=$request->districtid;
    	$presentAddress->thanaid=$request->thanaid;
    	$presentAddress->postofficeid=$request->postofficeid;
    	$presentAddress->postcode=$request->postcode;
    	$presentAddress->localgovid=$request->localgovid;
    	$presentAddress->address=$request->address;
    	
    	// Permanent Address
    	$permanentAddress=new Address();
    	if(isset($isChecked)){
    		$permanentAddress->divisionid=$request->divisionid;
	    	$permanentAddress->districtid=$request->districtid;
	    	$permanentAddress->thanaid=$request->thanaid;
	    	$permanentAddress->postofficeid=$request->postofficeid;
	    	$permanentAddress->postcode=$request->postcode;
	    	$permanentAddress->localgovid=$request->localgovid;
	    	$permanentAddress->address=$request->address;
    	}else{
    		$validatedData = $request->validate([
	        	'divisionid2' => 'required',
	        	'districtid2' => 'required',
	        	'thanaid2' => 'required',
	        	'postofficeid2' => 'required',
	        	'postcode2' => 'required',
	        	'localgovid2' => 'required',
	        	'address2' => 'required',
	    	]);
	    	$permanentAddress->divisionid=$request->divisionid2;
	    	$permanentAddress->districtid=$request->districtid2;
	    	$permanentAddress->thanaid=$request->thanaid2;
	    	$permanentAddress->postofficeid=$request->postofficeid2;
	    	$permanentAddress->postcode=$request->postcode2;
	    	$permanentAddress->localgovid=$request->localgovid2;
	    	$permanentAddress->address=$request->address2;
    	}
    	
    	
    	// Guardian information
    	$aApplicant->guardianName=$request->guardianName;
    	$aApplicant->g_religion=$request->g_religion;
    	$aApplicant->g_contactno=$request->g_contactno;
    	$aApplicant->g_occupation=$request->g_occupation;
    	$aApplicant->g_income=$request->g_income;
    	// ==================================
    	$guardianAddress=new Address();
    	$guardianAddress->divisionid=$request->g_divisionid;
    	$guardianAddress->districtid=$request->g_districtid;
    	$guardianAddress->thanaid=$request->g_thanaid;
    	$guardianAddress->postofficeid=$request->g_postofficeid;
    	$guardianAddress->postcode=$request->g_postcode;
    	$guardianAddress->localgovid=$request->g_localgovid;
    	$guardianAddress->address=$request->g_address;
    	// Previous Information
    	$aApplicant->prevschool=$request->prevschool;
    	$aApplicant->lastclass=$request->lastclass;
    	$aApplicant->result=$request->result;
    	$aApplicant->passing_year=$request->passing_year;
    	$aApplicant->tcno=$request->tcno;
    	
    	$aApplicant->tcissueddate=date("d-m-Y", strtotime($request->tcissueddate));
    	// dd($aApplicant->tcissueddate);
    	// ===================
    	// substr(md5(time()),0,12);
    	$upload_picture = $request->file('picture');
    	if($upload_picture!=null){
    		$explode_picture=explode('.',$upload_picture->getClientOriginalName());
    		$extention=end($explode_picture);
    		$nameexplode=explode(' ',$aApplicant->name);
    		$imagename=implode('_', $nameexplode);
	        $picture=$imagename.'.'.$extention;
	        $destination=public_path('clientAdmin/admission/student');
	        $upload_picture->move($destination,$picture);
	        $aApplicant->picture=$picture;
    	}

    	$upload_signature= $request->file('signature');
    	if($upload_signature!=null){
    		$explode_signature=explode('.',$upload_signature->getClientOriginalName());
    		$extention=end($explode_signature);
    		$nameexplode=explode(' ',$aApplicant->name);
    		$imagename=implode('_', $nameexplode);
	        $signature=$imagename.'_signature.'.$extention;
	        $destination=public_path('clientAdmin/admission/student');
	        $upload_signature->move($destination,$signature);
	        $aApplicant->signature=$signature;
    	}
    	$upload_father_picture=$request->file('father_picture');
       	if($upload_father_picture!=null){
       		$explode_father_picture=explode('.',$upload_father_picture->getClientOriginalName());
       		$extention=end($explode_father_picture);
       		$nameexplode=explode(' ',$aApplicant->fatherName);
    		$imagename=implode('_', $nameexplode);
	        $father_picture=$imagename.'.'.$extention;
	        $destination=public_path('clientAdmin/admission/parent');
	        $upload_father_picture->move($destination,$father_picture);
	        $aApplicant->father_picture=$father_picture;
       	}
       	$upload_mother_picture=$request->file('mother_picture');
        if($upload_mother_picture!=null){
        	$explode_mother_picture=explode('.',$upload_mother_picture->getClientOriginalName());
        	$extention=end($explode_mother_picture);
        	$nameexplode=explode(' ',$aApplicant->motherName);
    		$imagename=implode('_', $nameexplode);
	        $mother_picture=$imagename.'.'.$extention;
	        $destination=public_path('clientAdmin/admission/parent');
	        $upload_mother_picture->move($destination,$mother_picture);
	        $aApplicant->mother_picture=$mother_picture;
        }
        $aApplicant->username=$request->username;
        // Check here username For unique Value
        $hasSameUsername=$aApplicant->checkUsername($aApplicant->username);
        if($hasSameUsername){
            $msg="Usernme already exist.Give Different UserName";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $txtpassword=$request->password;
        $aApplicant->password=Hash::make($txtpassword);
       // die("Die Here");
        $status=\DB::transaction(function () use($aApplicant,$presentAddress,$permanentAddress,$guardianAddress){
        	$presentAddress->save();
        	$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
        	$present_addressid=$lastOne->id;
        	$permanentAddress->save();
        	$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
        	$permanent_addressid=$lastOne->id;
        	$guardianAddress->save();
        	$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
        	$gurdian_addressid=$lastOne->id;
        	$aApplicant->present_addressid=$present_addressid;
        	$aApplicant->permanent_addressid=$permanent_addressid;
        	$aApplicant->gurdian_addressid=$gurdian_addressid;
        	return $aApplicant->save();
        });
        if($status!=true){
            $msg="Some thing is wrong!";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aObj=$aApplicant->getApplicant($aApplicant->username,$aApplicant->password);
        $aAddress=new Address();
        $presentAddress=$aAddress->getAddressById($aObj->present_addressid);
        $permanentAddress=$aAddress->getAddressById($aObj->permanent_addressid);
        $aInstitute=new Institute();
        $instituteinfo=$aInstitute->getInstituteById(1);
        $dataList=[
            'instituteinfo'=>$instituteinfo,
            'applicantinfo'=>$aObj,
            'presentAddress'=>$presentAddress,
            'permanentAddress'=>$permanentAddress,
        ];
        return view('school.admission.applicantcopy',$dataList);
    }
    public function applicantCopyPage(){
        return view('school.admission.applicantview');
    }
    public function applicantCopy(Request $request){
        $username=$request->username;
        $password=$request->password;
        $isExist=\DB::table('applicants')->where('username',$username)->exists();
        if(!$isExist){
            $msg="User Name or Password is incorrect";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $hashedPassword=\DB::table('applicants')->where('username',$username)->first()->password;
        if (!Hash::check($password, $hashedPassword)) {
             $msg="Password is incorrect";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aApplicant=new Applicant();
        $aObj=$aApplicant->getApplicant($username,$hashedPassword);
        $aAddress=new Address();
        $presentAddress=$aAddress->getAddressById($aObj->present_addressid);
        $permanentAddress=$aAddress->getAddressById($aObj->permanent_addressid);
        $aInstitute=new Institute();
        $instituteinfo=$aInstitute->getInstituteById(1);
        $dataList=[
            'instituteinfo'=>$instituteinfo,
            'applicantinfo'=>$aObj,
            'presentAddress'=>$presentAddress,
            'permanentAddress'=>$permanentAddress,
        ];
     	return view('school.admission.applicantcopy',$dataList);
    }
    public function getAdmitCardForm(){
        return view('school.admission.admitcardview');
    }
    public function getAdmitCard(Request $request){
        $username=$request->username;
        $password=$request->password;
        $isExist=\DB::table('applicants')->where('username',$username)->exists();
        if(!$isExist){
            $msg="User Name or Password is incorrect";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $hashedPassword=\DB::table('applicants')->where('username',$username)->first()->password;
        if (!Hash::check($password, $hashedPassword)) {
             $msg="Password is incorrect";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aInstitute=new Institute();
        $aApplicant=new Applicant();
        $applicantinfo=$aApplicant->getApplicant($username,$hashedPassword);
        $isTrue=$aApplicant->isPaid($applicantinfo->applicantid);
        if(!$isTrue){
            $msg="Please Pay Your Admission Fee";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aAdmissionProgram=new AdmissionProgram();
        $aVAdmissionSubject=new VAdmissionSubject();
        $dataList=[
            'instituteinfo'=>$aInstitute->getInstituteById(1),
            'applicantinfo'=>$applicantinfo,
            'examinfo'=>$aAdmissionProgram->getExamInfo($applicantinfo->programofferid),
            'subjectinfo'=>$aVAdmissionSubject->getAdmitCardSubject($applicantinfo->programofferid),
        ];
        return view('school.admission.admitcard',$dataList);
    }
    public function admissionResultForm(){
        return view('school.admission.admissionresultview');
    }
    public function getAplicantResult(Request $request){
        $username=$request->username;
        $password=$request->password;
        $isExist=\DB::table('applicants')->where('username',$username)->exists();
        if(!$isExist){
            $msg="User Name or Password is incorrect";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $hashedPassword=\DB::table('applicants')->where('username',$username)->first()->password;
        if (!Hash::check($password, $hashedPassword)) {
             $msg="Password is incorrect";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aInstitute=new Institute();
        $aApplicant=new Applicant();
        $applicantinfo=$aApplicant->getApplicant($username,$hashedPassword);
        $aAdmissionResult=new AdmissionResult();
        $aObj=$aAdmissionResult->getMeritPosition($applicantinfo->programofferid,$applicantinfo->applicantid);
         $dataList=[
            'instituteinfo'=>$aInstitute->getInstituteById(1),
            'applicantinfo'=>$applicantinfo,
            'admissionresult'=>$aObj,
        ];
        return view('school.admission.admissionresult',$dataList);
    }
    // For Ajax Call
    public function getValue(Request $request){
        $option=$request->option;
        $idvalue=$request->idvalue;
        $methodid=$request->methodid;
        $programid=$request->programid;
        $groupid=$request->groupid;
        if($option=="program"){
            if($methodid==1){
                $this->getGroup($idvalue);
            }elseif($methodid==2){
                $this->getMedium($idvalue);
            }elseif($methodid==3){
                $this->getShift($idvalue);
            }
        }elseif($option=="group"){
            if($methodid==1){
                $this->getMediumWithProgram($programid,$idvalue);
            }elseif($methodid==2){
                $this->getShiftWithProgram($programid,$idvalue);
            }
        }elseif($option=="medium"){
            if($methodid==1){
                $this->getShiftWithProgramAndGroup($programid,$groupid,$idvalue);
            }
        }
    }
    private function getGroup($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getGroup(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMedium($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getMedium(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShift($programid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShift(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getMediumWithProgram($programid,$groupid){
        $aAdmission=new Admission();
        $result=$aAdmission->getMediumWithProgram(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgram($programid,$groupid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShiftWithProgram(0,$programid,$groupid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getShiftWithProgramAndGroup($programid,$groupid,$mediumid){
        $aAdmission=new Admission();
        $result=$aAdmission->getShiftWithProgramAndGroup(0,$programid,$groupid,$mediumid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }

}
