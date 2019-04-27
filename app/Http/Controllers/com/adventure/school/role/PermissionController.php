<?php

namespace App\Http\Controllers\com\adventure\school\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\role\Permission;
use App\com\adventure\school\role\RoleMenu;
use App\com\adventure\school\menu\Menu;
class PermissionController extends Controller
{
   public function __construct(){
        $this->middleware('auth');
    }
   public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('permission');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('permission');
        $permissionList=Permission::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$permissionList
        ];
    	return view('admin.rolesettings.permission.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('permission');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('permission');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $permissionList=Permission::all();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
        ];
        return view('admin.rolesettings.permission.create',$dataList);
    }
    public function store(Request $request){
    	$validatedData = $request->validate([
        'name' => 'required|unique:permissions|max:255',
    	]);
     	$name=$request->name;
     	$aPermission=new Permission();
     	$lastOne=$aPermission->getLastOne();
        $id=0;
        if($lastOne!=null){
            $id=$lastOne->id+1;
        }else{
            $id=1;
        }
        $aPermission->id=$id;
     	$aPermission->name=$name;
     	$status=$aPermission->save();
        // Get Role id
        $roleid=$aPermission->getRoleId();
        // Get All Menus For give new permission
        $menuLst=Menu::all();
        $lastOne=$aPermission->getLastOne();
        foreach ($menuLst as $x) {
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->roleid=$roleid;
            $aRoleMenu->menuid=$x->id;
            $aRoleMenu->permissionid=$lastOne->id;
            $aRoleMenu->save();
        }
     	if($status){
     		$msg="Permission Created Successfully";
		  }else{
		    $msg="Permission not Created";
		}
		return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('permission');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('permission');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aPermission=Permission::findOrfail($id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aPermission
        ];
        return view('admin.rolesettings.permission.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'name' => 'required|unique:permissions|max:255',
    	]);
    	$name=$request->name;
     	$aPermission=Permission::findOrfail($id);
     	$aPermission->name=$name;
     	$status=$aPermission->update();
     	if($status){
     		$msg="Permission Updated Successfully";
		  }else{
		    $msg="Permission not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
