<?php
namespace App\Http\Controllers\com\adventure\school\program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\program\PLevel;
use App\com\adventure\school\program\Course;
use App\com\adventure\school\menu\Menu;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createCourse(Request $request){
        // die("Die Here");
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        if($request->isMethod('post')&&$request->btn_save=='btn_save'){
            $validatedData = $request->validate([
                'courseCode' => 'required|unique:courses|max:255',
                'programlavelid'=>'required',
                ]);
                 $courseName=$request->courseName;
                 $courseCode=$request->courseCode;
                 $programlavelid=$request->programlavelid;
                 $aCourse=new Course();
                 $aCourse->courseName=$courseName;
                 $aCourse->courseCode=$courseCode;
                 $aCourse->programlavelid=$programlavelid;
                 $status=$aCourse->save();
                 if($status){
                     $msg="Course Created Successfully";
                  }else{
                    $msg="Course not Created";
                }
                return redirect()->back()->with('msg',$msg);
        }
        if($request->isMethod('post')&&$request->btn_update=='btn_update'){
            $validatedData = $request->validate([
                'programlavelid'=>'required',
            ]);
            $id=$request->id;
            // dd($id);
            $aCourse=Course::findOrfail($id);
            $aCourse->courseName=$request->courseName;
            $aCourse->courseCode=$request->courseCode;
            $aCourse->programlavelid=$request->programlavelid;
            $status=$aCourse->update();
            if($status){
                $msg="Course Updated Successfully";
            }else{
                $msg="Course not Updated";
            }
            return redirect()->back()->with('msg',$msg);
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
        $aCourse=new Course();
        $courseList=$aCourse->getCourses();
        $plavelList=PLevel::all();
        $bean=null;
        $id=$request->id;
        if($id!=null){
            // if($pList[3]->id!=3){
            //     return redirect('error');
            // }
            $bean=Course::findOrfail($id);
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'plevelList'=>$plavelList,
            'courseList'=>$courseList,
            'bean'=>$bean
        ];
    	return view('admin.programsettings.course.courses',$dataList);
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
        $aList=Course::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.programsettings.course.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('admin.programsettings.course.create',$dataList);
    }
    public function store(Request $request){
     	 $validatedData = $request->validate([
        'name' => 'required|unique:courses|max:255',
    	]);
     	$name=$request->name;
     	$aCourse=new Course();
     	$aCourse->name=$name;
     	$status=$aCourse->save();
     	if($status){
     		$msg="Course Created Successfully";
		  }else{
		    $msg="Course not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('course');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('course');
    	$aCourse=Course::findOrfail($id);
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aCourse
        ];
        return view('admin.programsettings.course.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:courses|max:255',
    	]);
    	$name=$request->name;
     	$aCourse=Course::findOrfail($id);
     	$aCourse->name=$name;
     	$status=$aCourse->update();
     	if($status){
     		$msg="Course Updated Successfully";
		  }else{
		    $msg="Course not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
