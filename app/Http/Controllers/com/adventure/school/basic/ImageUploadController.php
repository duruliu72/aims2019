<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\ImageUpload;
use App\com\adventure\school\menu\Menu;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('imageupload');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('imageupload');
    	$aList=ImageUpload::all();
    	return view('admin.basic.imageupload.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$aList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('imageupload');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('imageupload');
        if($pList[2]->id==2){
            return view('admin.basic.imageupload.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
            return redirect('error');
        }
    	
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        // 'name' => 'required|unique:imageupload|max:255',
        ]);
        $aMenu=new Menu();
        $uploads_dir=public_path().'/clientAdmin/image/employee/';
     	$aImageUpload=new ImageUpload();
        $aImageUpload->name=$request->name;
        $selectedimageurl=$_FILES["imageurl"];
        if($selectedimageurl['size']==0){
            $msg='You did  not select picture';
            return redirect()->back()->with('msg',$msg);
        }
        $imagepropaties=[
            'maxwidth'=>2400,
            'maxheight'=>2400,
            'resizeWidth'=>155,
            'resizeHeight'=>195
        ];
        $file_name=$aMenu->fileUpload($uploads_dir,$selectedimageurl,$imagepropaties);
        if($file_name==""){
            $msg="Image file should be (".$width."px by ".$height."px)";
            return redirect()->back()->with('msg',$msg);
        }
        $aImageUpload->imageurl=$file_name;
     	$status=$aImageUpload->save();
     	if($status){
     		$msg="Image Upload Successfully";
		  }else{
		    $msg="Image not Upload";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function show($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('imageupload');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('imageupload');
        $fileLocation='http://localhost/school2019/public/clientAdmin/image/employee/';
        $aFileUrl=ImageUpload::findOrfail($id);
        // ============================Resize All image =================
        $dirSRC = public_path().'/clientAdmin/image/employee/';
        $resizeWidth=155;
        $resizeHeight=195;
        $isTrue=$aMenu->resizeimagefile($dirSRC,$resizeWidth,$resizeHeight);
        // dd($isTrue);
        //////////////////////////////////////////////////////////////////
        $dataList=[
            'sidebarMenu'=>$sidebarMenu,
            'fileLocation'=>$fileLocation,
            'aFileUrl'=>$aFileUrl
        ];
        return view('admin.basic.imageupload.show',$dataList);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('imageupload');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('imageupload');
    	$aImageUpload=ImageUpload::findOrfail($id);
        if($pList[3]->id==3){
           return view('admin.basic.imageupload.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aImageUpload]); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:imageupload|max:255',
    	]);
    	$name=$request->name;
     	$aImageUpload=ImageUpload::findOrfail($id);
        $aImageUpload->name=$request->name;
        $aImageUpload->imageurl=$request->imageurl;
     	$status=$aImageUpload->update();
     	if($status){
     		$msg="Image Upload Updated Successfully";
		  }else{
		    $msg="Image Upload not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
