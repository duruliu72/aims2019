<?php

namespace App\Http\Controllers\com\adventure\school\menu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\role\Role;
use App\com\adventure\school\role\Permission;
use App\com\adventure\school\role\RoleMenu;
class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('menu');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('menu');
        $menuList=$aMenu->getAllMenu();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$menuList
        ];
    	return view('admin.menu.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('menu');
        if($hasMenu==false){
            return redirect('error');
        }
        $pList=$aMenu->getPermissionOnMenu('menu');
        if($pList[2]->id!=2){
             return redirect('error');
        }
    	$aList=$aMenu->getParentsMenu();
        $sidebarMenu=$aMenu->getSidebarMenu();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'parents'=>$aList,
        ];
        return view('admin.menu.create',$dataList); 
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
        // 'url' => 'required|unique:menus|max:255',
        'parentid' => 'required',
    	]);
     	$name=$request->name;
     	$parentid=$request->parentid;
     	$url=$request->url;
     	$menuorder=$request->menuorder;
     	if($menuorder==''){
	      $menuorder=100;
	    }
        $lastOne=\DB::table('menus')->orderBy('id', 'desc')->first();
        $id=0;
        if($lastOne!=null){
            $id=$lastOne->id+1;
        }else{
            $id=1;
        }
     	$aMenu=new Menu();
     	$aMenu->id=$id;
     	$aMenu->name=$name;
     	$aMenu->parentid=$parentid;
     	$aMenu->url=$url;
        $aMenu->menuorder=$menuorder;
        $isTrue=$aMenu->checkUrl($url);
        if($isTrue==true){
            $msg="This Url Already Exist";
            return redirect()->back()->with('msg',$msg);
        }
        $status=$aMenu->save();
        // Get Role id for current User
        $aRole=new Role();
        $roleid=$aRole->getRoleId();
        // Get All Permission for new menu
        $permissionList=Permission::all();
        $lastOne=\DB::table('menus')->orderBy('id', 'desc')->first();
        $newmenuid=$lastOne->id;
        $parentid=$lastOne->parentid;
        if($parentid!=0){
            foreach ($permissionList as $x) {
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->roleid=$roleid;
            $aRoleMenu->menuid=$newmenuid;
            $aRoleMenu->permissionid=$x->id;
            $aRoleMenu->save();
            }
        }else{
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->roleid=$roleid;
            $aRoleMenu->menuid=$newmenuid;
            $aRoleMenu->permissionid=0;
            $aRoleMenu->save();
        }
        
     	if($status){
     		$msg="Menu Created Successfully";
		  }else{
		    $msg="Menu not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=Menu::findOrfail($id);
        $hasMenu=$aMenu->hasMenu('menu');
        if($hasMenu==false){
            return redirect('error');
        }
    	$aList=$aMenu->getParentsMenu();
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('menu');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'bean'=>$aMenu,
            'parents'=>$aList
        ];
        return view('admin.menu.edit',$dataList);
    }
    public function update(Request $request, $id){
    	$validatedData = $request->validate([
        'parentid' => 'required',
    	]);
    	$name=$request->name;
     	$parentid=$request->parentid;
     	$url=$request->url;
     	$menuorder=$request->menuorder;
     	if($menuorder==''){
	      $menuorder=100;
	    }
     	$aMenu=Menu::findOrfail($id);
     	$aMenu->name=$name;
     	$aMenu->parentid=$parentid;
        $aMenu->menuorder=$menuorder;
        $status=$aMenu->update();
        $aRole=new Role();
        $roleid=$aRole->getRoleId();
        \DB::table('role_menu')
        ->where('roleid', '=', $roleid)
        ->where('menuid', '=', $aMenu->id)
        ->delete();
         // Get All Permission for new menu
         $permissionList=Permission::all();
        if($parentid!=0){
            foreach ($permissionList as $x) {
                $aRoleMenu=new RoleMenu();
                $aRoleMenu->roleid=$roleid;
                $aRoleMenu->menuid=$aMenu->id;
                $aRoleMenu->permissionid=$x->id;
                $aRoleMenu->save();
            }
        }else{
            $aRoleMenu=new RoleMenu();
            $aRoleMenu->roleid=$roleid;
            $aRoleMenu->menuid=$aMenu->id;
            $aRoleMenu->permissionid=0;
            $aRoleMenu->save();
        }
     	if($status){
     		$msg="Menu Updated Successfully";
		  }else{
		    $msg="Menu not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
