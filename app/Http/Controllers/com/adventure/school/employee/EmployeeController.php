<?php

namespace App\Http\Controllers\com\adventure\school\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\EmployeeType;
use App\com\adventure\school\basic\Designation;
use App\com\adventure\school\basic\Department;
use App\com\adventure\school\basic\EmploymentStatus;
use App\com\adventure\school\basic\EmployeeStatus;
use App\com\adventure\school\basic\Gender;
use App\com\adventure\school\basic\Nationality;
use App\com\adventure\school\basic\BloodGroup;
use App\com\adventure\school\basic\MaritalStatus;
use App\com\adventure\school\basic\EducationDegree;
use App\com\adventure\school\basic\EducationInfo;
use App\com\adventure\school\employee\Employee;

class EmployeeController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employees');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employees');
        $aEmployee=new Employee();
        $aList=$aEmployee->getEmployees();
        $datalist=[
        'sidebarMenu'=>$sidebarMenu,
        'pList'=>$pList,
        'result'=>$aList,
        ];
    	return view('admin.employee.employee.index',$datalist);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employees');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employees');
        $datalist=[
            'sidebarMenu'=>$sidebarMenu, 
            'employeetypeList'=>EmployeeType::all(),
            'designationList'=>Designation::all(),
            'departmentList'=>Department::all(),
            'employmentStatusList'=>EmploymentStatus::all(),
            'employeeStatusList'=>EmployeeStatus::all(),
            'genderList'=>Gender::all(),
            'nationalityList'=>Nationality::all(),
            'bloodGroupList'=>BloodGroup::all(),
            'maritalStatusList'=>MaritalStatus::all(),
            'educationDegreeList'=>EducationDegree::all()
        ];
        if($pList[2]->id==2){
            return view('admin.employee.employee.create',$datalist);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
        // 'avatar' => 'dimensions:ratio=3/2'
     	 $validatedData = $request->validate([
        'employeetypeid' => 'required',
        'designationid' => 'required',
        'departmentid' => 'required',
        'employmentstatusid' => 'required',
        'employeestatusid' => 'required',
        'employeeposition' => 'required',
        'joining_date' => 'required',
        'retirement_date' => 'required',
        'first_name' => 'required',
        'middle_name' => 'required',
        'last_name' => 'required',
        'dob' => 'required',
        'father_name' => 'required',
        'mother_name' => 'required',
        'genderid' => 'required',
        'mobileno' => 'required',
        'birthregno' => 'required',
        'nationalityid' => 'required',
        'nationalidno' => 'required',
        'bloodgroupid' => 'required',
        'marital_statusid' => 'required',
        'email' => 'required',
        'present_addressid' => 'required',
        // 'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=200,max_height=250',
        'educationdegreeid' => 'required',
        'discipline' => 'required',
        'grade' => 'required',
        'passingyear' => 'required',
        'board' => 'required',
        ]);
        // die("Die Here");
        $aEmployee=new Employee();
        $aEmployee->employeeidno=$aEmployee->generateEmployeeIdNo();
        $aEmployee->employeetypeid=$request->employeetypeid;
        $aEmployee->designationid=$request->designationid;
        $aEmployee->departmentid=$request->departmentid;
        $aEmployee->employmentstatusid=$request->employmentstatusid;
        $aEmployee->employeestatusid=$request->employeestatusid;
        $aEmployee->employeeposition=$request->employeeposition;
        $aEmployee->joining_date=date("Y-m-d", strtotime($request->joining_date));
        $aEmployee->retirement_date=date("Y-m-d", strtotime($request->retirement_date));
        $aEmployee->first_name=$request->first_name;
        $aEmployee->middle_name=$request->middle_name;
        $aEmployee->last_name=$request->last_name;
        $aEmployee->father_name=$request->father_name;
        $aEmployee->mother_name=$request->mother_name;
        $aEmployee->genderid=$request->genderid;
        $aEmployee->mobileno=$request->mobileno;
        $aEmployee->dob=date("Y-m-d", strtotime($request->dob));
        $aEmployee->birthregno=$request->birthregno;
        $aEmployee->nationalityid=$request->nationalityid;
        $aEmployee->nationalidno=$request->nationalidno;
        $aEmployee->bloodgroupid=$request->bloodgroupid;
        $aEmployee->marital_statusid=$request->marital_statusid;
        $aEmployee->email=$request->email;
        $aEmployee->present_addressid=$request->present_addressid;
        $aEmployee->indexno=$request->indexno;
        $picture=$_FILES["picture"];
        $signature=$_FILES["signature"];
        $picturepropaties=[
            'maxwidth'=>176,
            'maxheight'=>200,
            'resizeWidth'=>155,
            'resizeHeight'=>195,
            'name'=>'picture'
        ];
        $signatureproperties=[
            'maxwidth'=>341,
            'maxheight'=>91,
            'resizeWidth'=>155,
            'resizeHeight'=>91,
            'name'=>'signature'
        ];
        $uploads_dir=public_path().'/clientAdmin/image/employee/';
        if($picture['size']==0){
            $msg='You did  not select Picture';
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        if($signature['size']==0){
            $msg='You did  not select Signature';
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        list($pictureWidth, $pictureHeight) = getimagesize($picture['tmp_name']);
        list($signatureWidth, $signatureHeight) = getimagesize($signature['tmp_name']);
        if($pictureWidth>$picturepropaties['maxwidth'] && $pictureHeight>$picturepropaties['maxheight']){
            $msg="Picture should be (".$picturepropaties['resizeWidth']."px by ".$picturepropaties['resizeHeight']."px)";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        if($signatureWidth>$signatureproperties['maxwidth'] && $signatureHeight>$signatureproperties['maxheight']){
            $msg="Signature should be (".$signatureproperties['resizeWidth']."px by ".$signatureproperties['resizeHeight']."px)";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
        $aMenu=new Menu();
        $unique_picture=$aMenu->generateFilename($picturepropaties,$picture);
        $unique_signature=$aMenu->generateFilename($signatureproperties,$signature);
        $aEmployee->picture=$unique_picture;
        $aEmployee->signature=$unique_signature;
        if(isset($request->educationdegreeid)&&isset($request->discipline)&&isset($request->grade)&&isset($request->passingyear)&&isset($request->board)){
            $status=$aEmployee->save();
            $lastOne=\DB::table('employees')
            ->orderBy('id','desc')
            ->first();
            $educationdegreeid=$request->educationdegreeid;
            $discipline=$request->discipline;
            $grade=$request->grade;
            $passingyear=$request->passingyear;
            $board=$request->board;
            foreach($educationdegreeid as $key=>$x){
                if($x!="" && $discipline[$key]!="" && $grade[$key]!="" && $passingyear[$key]!="" && $board[$key]!=""){
                    $aEducationInfo=new EducationInfo();
                    $aEducationInfo->employeeid=$lastOne->id;
                    $aEducationInfo->educationdegreeid=$x;
                    $aEducationInfo->discipline=$discipline[$key];
                    $aEducationInfo->grade=$grade[$key];
                    $aEducationInfo->passingyear=$passingyear[$key];
                    $aEducationInfo->board=$board[$key];
                    $aEducationInfo->save();
                }
            }
            if($status){
                $aMenu->fileUpload($uploads_dir,$picture,$picturepropaties,$unique_picture);
                $aMenu->fileUpload($uploads_dir,$signature,$signatureproperties,$unique_signature);
                $msg="Employee Created Successfully";
             }else{
               $msg="Employee not Created";
           }
            return redirect()->back()->with('msg',$msg);
        }else{
            $msg="Select your education quality info";
            return redirect()->back()->with('msg',$msg)->withInput($request->input());
        }
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('employeetypes');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('employeetypes');
    	$aEmployeeStatus=EmployeeStatus::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.employeestatus.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aEmployeeStatus]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:employeestatus|max:255',
    	]);
    	$name=$request->name;
     	$aEmployeeStatus=EmployeeStatus::findOrfail($id);
     	$aEmployeeStatus->name=$name;
     	$status=$aEmployeeStatus->update();
     	if($status){
     		$msg="Employee Updated Successfully";
		  }else{
		    $msg="Employee not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
