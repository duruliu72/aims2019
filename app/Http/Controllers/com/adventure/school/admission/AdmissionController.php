<?php

namespace App\Http\Controllers\com\adventure\school\admission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\admission\Admission;
use App\com\adventure\school\admission\VAdmissionSubject;
use App\com\adventure\school\admission\Applicant;
use App\com\adventure\school\admission\AdmissionApplicant;
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
use App\SendSms;
class AdmissionController extends Controller
{
    public function index(){
		// $sendMsg = new SendSms();
		// $message = 'Application Successful';
		// $sms_stutus = $sendMsg->MessageSend('01726720772', $message);
        $aAdmissionProgram=new AdmissionProgram();
        // sessionid,programid,groupid,mediumid,shiftid,tableName And last one compareid
        $programList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"programs",'programid');
        $mediumList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"mediums",'mediumid');
        $shiftList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"shifts",'shiftid');
        $groupList=$aAdmissionProgram->getAllOnIDS(0,0,0,0,0,"groups",'groupid');
    	$dataList=[
    		'programList'=>$programList,
	    	'mediumList'=>$mediumList,
            'shiftList'=>$shiftList,
            'groupList'=>$groupList,
    		'genderList'=>Gender::all(),
    		'quotaList'=>Quota::all(),
    		'religionList'=>Religion::all(),
    		'nationaityList'=>Nationality::all(),
    		'bloodgroupLst'=>BloodGroup::all(),
    		'divisionList'=>Division::all(),
    		'districtList'=>District::all(),
    		'thanaList'=>Thana::all(),
    		'postofficeList'=>PostOffice::all(),
    		'localgovList'=>LocalGov::all(),
    	];
    	return view('school.admission.admission',$dataList);
    }
    public function store(Request $request){
    	$isChecked=$request->isChecked;
    	$validatedData = $request->validate([
			'programid' => 'required',
			'mediumid' => 'required',
			'shiftid' => 'required',
        	'groupid' => 'required',
        	'firstName' => 'required',
        	'fatherName' => 'required',
        	'motherName' => 'required',
			'dob' => 'required',
			'phone' => 'required',
        	'genderid' => 'required',
        	'religionid' => 'required',
        	'nationalityid' => 'required',
        	'quotaid' => 'required',
        	'pre_divisionid' => 'required',
        	'pre_districtid' => 'required',
        	'pre_thanaid' => 'required',
        	'pre_postofficeid' => 'required',
        	'pre_postcode' => 'required',
        	'pre_localgovid' => 'required',
        	'pre_address' => 'required',
            ]);
    	$request->flash();
    	$aApplicant=new Applicant();
    	$programid=$request->programid;
    	$groupid=$request->groupid;
    	$mediumid=$request->mediumid;
    	$shiftid=$request->shiftid;
    	$aAdmissionProgram=new AdmissionProgram();
    	// find admission_programid id 
		$admission_programid=$aAdmissionProgram->getAdmissionProgramID(0,$programid,$groupid,$mediumid,$shiftid);
        // Create Applicant id
		$applicantid=$aApplicant->makeAppicantid($admission_programid);
        $aApplicant->applicantid=$applicantid;
		$aApplicant->firstName=$request->firstName;
		$aApplicant->middleName=$request->middleName;
		$aApplicant->lastName=$request->lastName;
		$aApplicant->phone=$request->phone;
    	$aApplicant->fatherName=$request->fatherName;
		$aApplicant->motherName=$request->motherName;
		
    	$aApplicant->f_occupation=$request->f_occupation?$request->f_occupation:null;
    	$aApplicant->m_occupation=$request->m_occupation;
    	$aApplicant->father_nid=$request->father_nid;
    	$aApplicant->mother_nid=$request->mother_nid;
    	$aApplicant->father_Phone=$request->father_Phone;
    	$aApplicant->mother_Phone=$request->mother_Phone;
    	$aApplicant->dob=date("Y-m-d", strtotime($request->dob));
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
    	$aApplicant->parent_income=$request->parent_income;
    	// Present Address
    	$presentAddress=new Address();
    	$presentAddress->divisionid=$request->pre_divisionid;
    	$presentAddress->districtid=$request->pre_districtid;
    	$presentAddress->thanaid=$request->pre_thanaid;
    	$presentAddress->postofficeid=$request->pre_postofficeid;
    	$presentAddress->postcode=$request->pre_postcode;
    	$presentAddress->localgovid=$request->pre_localgovid;
    	$presentAddress->address=$request->pre_address;
    	// Permanent Address
    	$permanentAddress=new Address();
    	if(isset($isChecked)){
    		$permanentAddress->divisionid=$request->pre_divisionid;
	    	$permanentAddress->districtid=$request->pre_districtid;
	    	$permanentAddress->thanaid=$request->pre_thanaid;
	    	$permanentAddress->postofficeid=$request->pre_postofficeid;
	    	$permanentAddress->postcode=$request->pre_postcode;
	    	$permanentAddress->localgovid=$request->pre_localgovid;
	    	$permanentAddress->address=$request->pre_address;
    	}else{
    		$validatedData = $request->validate([
	        	'per_divisionid' => 'required',
	        	'per_districtid' => 'required',
	        	'per_thanaid' => 'required',
	        	'per_postofficeid' => 'required',
	        	'per_postcode' => 'required',
	        	'per_localgovid' => 'required',
	        	'per_address' => 'required',
	    	]);
	    	$permanentAddress->divisionid=$request->per_divisionid;
	    	$permanentAddress->districtid=$request->per_districtid;
	    	$permanentAddress->thanaid=$request->per_thanaid;
	    	$permanentAddress->postofficeid=$request->per_postofficeid;
	    	$permanentAddress->postcode=$request->per_postcode;
	    	$permanentAddress->localgovid=$request->per_localgovid;
	    	$permanentAddress->address=$request->per_address;
    	}
    	
    	
    	// Guardian information
    	$aApplicant->guardianName=$request->guardianName;
    	$aApplicant->g_religion=$request->g_religion;
    	$aApplicant->g_contactno=$request->g_contactno;
    	$aApplicant->g_occupation=$request->g_occupation;
    	$aApplicant->g_income=$request->g_income;
    	// ==================================
		$guardianAddress=new Address();
		$test=0;
		if($request->g_divisionid!=null&&$request->g_divisionid!=""){
			$guardianAddress->divisionid=$request->g_divisionid;
			$test++;
		}
		if($request->g_districtid!=null&&$request->g_districtid!=""){
			$guardianAddress->districtid=$request->g_districtid;
			$test++;
		}
    	if($request->g_thanaid!=null&&$request->g_thanaid!=""){
			$guardianAddress->thanaid=$request->g_thanaid;
			$test++;
		}
    	if($request->g_postofficeid!=null&&$request->g_postofficeid!=""){
			$guardianAddress->postofficeid=$request->g_postofficeid;
			$test++;
		}
		if($request->g_postcode!=null&&$request->g_postcode!=""){
			$guardianAddress->postcode=$request->g_postcode;
			$test++;
		}
    	if($request->g_localgovid!=null&&$request->g_localgovid!=""){
			$guardianAddress->localgovid=$request->g_localgovid;
			$test++;
		}
    	if($request->g_address!=null&&$request->g_address!=""){
			$guardianAddress->address=$request->g_address;
			$test++;
		}
    	// Previous Information
    	$aApplicant->prevschool=$request->prevschool;
    	$aApplicant->lastclass=$request->lastclass;
    	$aApplicant->result=$request->result;
    	$aApplicant->passing_year=$request->passing_year;
    	$aApplicant->tcno=$request->tcno;
    	$aApplicant->tcissueddate=date("d-m-Y", strtotime($request->tcissueddate));
    	// ===================
    	substr(md5(time()),0,12);
		$upload_picture = $request->file('picture');
    	if($upload_picture!=null){
    		$explode_picture=explode('.',$upload_picture->getClientOriginalName());
    		$extention=end($explode_picture);
    		$nameexplode=explode(' ',$aApplicant->firstName);
    		$imagename=implode('_', $nameexplode);
	        $picture=$applicantid.'.'.$extention;
	        $destination=public_path('clientAdmin/admission/student');
	        $upload_picture->move($destination,$picture);
			$aApplicant->picture=$picture;
    	}

    	$upload_signature= $request->file('signature');
    	if($upload_signature!=null){
    		$explode_signature=explode('.',$upload_signature->getClientOriginalName());
    		$extention=end($explode_signature);
    		$nameexplode=explode(' ',$request->firstName);
			$imagename=implode('_', $nameexplode);
	        $signature=$applicantid.'_signature.'.$extention;
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
		// $admssion_roll=0;
		// ==============================
		$aAdmissionApplicant=new AdmissionApplicant();
		$aAdmissionApplicant->admission_programid=$admission_programid;
		$aAdmissionApplicant->applicantid=$applicantid;
		// $aAdmissionApplicant->admssion_roll=$admssion_roll;
        $status=\DB::transaction(function () use($aApplicant,$aAdmissionApplicant,$presentAddress,$permanentAddress,$guardianAddress,$test){
        	$presentAddress->save();
        	$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
        	$present_addressid=$lastOne->id;
        	$permanentAddress->save();
        	$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
			$permanent_addressid=$lastOne->id;
        	$aApplicant->present_addressid=$present_addressid;
			$aApplicant->permanent_addressid=$permanent_addressid;
			if($test==7){
				$guardianAddress->save();
				$lastOne=\DB::table('addresses')->orderBy('id', 'desc')->first();
				$gurdian_addressid=$lastOne->id;
				$aApplicant->gurdian_addressid=$gurdian_addressid;
			}
			$aApplicant->pin_code=$this->pingenerate();

			$aAdmissionApplicant->save();
			$sta=$aApplicant->save();
			// if($sta){
			// 	//Sending message to the applicant with applicationid and pincode
            //     $sendMsg = new SendSms();
            //     $message = 'Application Successful.Your ID: '.$applicantid.' Code: '.$this->pingenerate().'.';
            //     $sms_stutus = $sendMsg->MessageSend($request->phone, $message);
			// }
        	return $sta;
        });
        if($status!=true){
            $msg="Some thing is wrong!";
             return redirect()->back()->with('msg',$msg)->withInput($request->input());
		}
		$aObj=$aApplicant->getApplicant($applicantid);
        $dataList=[
            'bean'=>$aObj,
        ];
        return view('school.admission.applicantcopy',$dataList);
    }
    public function applicantCopyPage(){
        return view('school.admission.applicantview');
    }
    public function applicantCopy(Request $request){
        $applicantid=$request->applicantid;
        $pin_code=$request->pin_code;
        $aApplicant=new Applicant();
        $aObj=$aApplicant->getApplicant($applicantid,$pin_code);
        $dataList=[
            'bean'=>$aObj,
        ];
        return view('school.admission.applicantcopy',$dataList);
    }
    public function getAdmitCardForm(){
        return view('school.admission.admitcardview');
    }
    public function getAdmitCard(Request $request){
        $applicantid=$request->applicantid;
        $pin_code=$request->pin_code;
        $aApplicant=new Applicant();
		$aObj=$aApplicant->getApplicantAdmitCard($applicantid,$pin_code);
		// dd($aObj);
        $dataList=[
            'bean'=>$aObj,
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
     // For Ajax Call ===============
    //    ================================================================
   public function changeAddress(Request $request){
    $option=$request->option;
    $methodid=$request->methodid;
    $id=$request->id;
    if($option=="pre_division"){
        if($methodid==1){
			$this->getDropDownValue("districts","divisionid",$id);
        }
    }elseif($option=="pre_district"){
        if($methodid==1){
			$this->getDropDownValue("thanas","districtid",$id);
        }
    }elseif($option=="pre_thana"){
        if($methodid==1){
			$this->getDropDownValue("postoffices","thanaid",$id);
        }elseif($methodid==2){
			$this->getDropDownValue("localgovs","thanaid",$id);
		}
	}elseif($option=="per_division"){
		if($methodid==1){
			$this->getDropDownValue("districts","divisionid",$id);
        }
    }elseif($option=="per_district"){
		if($methodid==1){
			$this->getDropDownValue("thanas","districtid",$id);
        }
    }elseif($option=="per_thana"){
		if($methodid==1){
			$this->getDropDownValue("postoffices","thanaid",$id);
        }elseif($methodid==2){
			$this->getDropDownValue("localgovs","thanaid",$id);
		}
    }elseif($option=="g_division"){
        if($methodid==1){
			$this->getDropDownValue("districts","divisionid",$id);
        }
    }elseif($option=="g_district"){
		if($methodid==1){
			$this->getDropDownValue("thanas","districtid",$id);
        }
    }elseif($option=="g_thana"){
        if($methodid==1){
			$this->getDropDownValue("postoffices","thanaid",$id);
        }elseif($methodid==2){
			$this->getDropDownValue("localgovs","thanaid",$id);
		}
    }
}
private function getDropDownValue($tableName,$conditionid,$id){
    $aAddress=new Address();
    $result=$aAddress->getDropDownValue($tableName,$conditionid,$id);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
	public function pingenerate(){
		$pinstr="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$length=strlen($pinstr);
		$codeArray=array();
		$pin_code="";
		for($i=0;$i<$length;$i++){
			$codeArray[$i]=$pinstr[$i];
		}
		for($i=0;$i<6;$i++){
			$pin_code.=$codeArray[rand(0,61)];
		}
		return $pin_code;
	}
}
