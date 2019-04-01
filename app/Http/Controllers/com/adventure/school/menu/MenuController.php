<?php

namespace App\Http\Controllers\com\adventure\school\menu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    	return view('admin.menu.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$menuList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('menu');
        if($hasMenu==false){
            return redirect('error');
        }
        $pList=$aMenu->getPermissionOnMenu('menu');
        if($pList[2]->id==2){
           $aList=$aMenu->getParentsMenu();
            $sidebarMenu=$aMenu->getSidebarMenu();
            return view('admin.menu.create',['sidebarMenu'=>$sidebarMenu,'parents'=>$aList]); 
        }else{
             return redirect('error');
        }
    	
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
        if($pList[3]->id==3){
            return view('admin.menu.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aMenu,'parents'=>$aList]);
        }else{
            return redirect('error');
        }
        
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
     	if($status){
     		$msg="Menu Updated Successfully";
		  }else{
		    $msg="Menu not Updated";
		}
     	return redirect()->back()->with('msg',$msg);
    }
}
