<?php

namespace App\Http\Controllers\com\adventure\school\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\role\Role;
use App\com\adventure\school\role\RoleMenu;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('role');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('role');
        $aRole=new Role();
        $roleList=$aRole->getExcludeSuccessorRole();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$roleList,
        ];
    	return view('admin.rolesettings.role.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('role');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('role');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $aRole=new Role();
        $aRoleMenu=new RoleMenu();
        $roleList=$aRole->getIncludeSuccessorRole();
        $menuList=$aRoleMenu->menuList($aRole->getRoleId(),0);
        $parentMenuList=$aRoleMenu->parentMenuList($aRole->getRoleId(),0);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'roleList'=>$roleList,
            'menuList'=>$menuList,
            'parentMenuList'=>$parentMenuList
        ];
        return view('admin.rolesettings.role.create',$dataList);
    }
    private function isSelectedSubMenu($selectmenu){
        $tempid=0;
        foreach ($selectmenu as $x ) {
            $sql="SELECT * FROM `menus` WHERE id=?";
            $result=\DB::select($sql,[$x]);
            foreach ($result as $y) {
                 if($y->parentid==0){
                     $tempid=$y->id;
                 }elseif ($y->parentid==$tempid) {
                     return true;
                 }
            }
        }
        return false;
    }
    public function store(Request $request){
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        ]);
        $name=$request->name;
        $rolecreatorid=$request->rolecreatorid;
        $selectmenu=$request->menuid;
        $permissionidList=$request->permissionid;
        if($selectmenu!=null){
            $isTrue=$this->isSelectedSubMenu($selectmenu);
            $newRoleId=0;
            if($isTrue){
                $newRoleId=\DB::table('roles')->insertGetId(['name'=>$name,'rolecreatorid'=>$rolecreatorid]);
            }else{
                $msg="Please Select Sub Menu";
                return redirect()->back()->with('msg',$msg);
            }
            if($newRoleId){
                foreach($selectmenu as $menuid){
                    foreach ($permissionidList[$menuid] as $permissionid) {
                        $aRoleMenu=new RoleMenu();
                        $aRoleMenu->roleid=$newRoleId;
                        $aRoleMenu->menuid=$menuid;
                        $aRoleMenu->permissionid=$permissionid;
                        $aRoleMenu->save();
                    }
                }
                $msg="Role Created Successfuly";
            }else{
                $msg="Role not Created";
            }
        }else{
            $msg="Please Select Menu";
        }
        return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('role');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('role');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $aRoleMenu=new RoleMenu();
        $aRole=Role::findOrfail($id);
        $roleList=$aRole->getPredecessorRole($aRole->id);
        $menuList=$aRoleMenu->menuList($aRole->rolecreatorid,$aRole->id);
        $parentMenuList=$aRoleMenu->parentMenuList($aRole->rolecreatorid,$aRole->id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'roleList'=>$roleList,
            'menuList'=>$menuList,
            'parentMenuList'=>$parentMenuList,
            'bean'=>$aRole
        ];
        return view('admin.rolesettings.role.edit',$dataList); 
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        ]);
        $selectmenu=$request->menuid;
        if($selectmenu!=null){
            $isTrue=$this->isSelectedSubMenu($selectmenu);
            if($isTrue==false){
                $msg="Please Select Sub Menu";
                return redirect()->back()->with('msg',$msg);
            }
            $status=\DB::transaction(function () use($request, $id){
                $aRole=Role::findOrfail($id);
                $aRole->name=$request->name;
                $aRole->rolecreatorid=$request->rolecreatorid;
                $selectmenu=$request->menuid;
                $permissionidList=$request->permissionid;
                $aRole->update();
                \DB::select('DELETE  FROM `role_menu` WHERE roleid=?',[$id]);
                foreach($selectmenu as $menuid){
                    foreach ($permissionidList[$menuid] as $permissionid) {
                        $aRoleMenu=new RoleMenu();
                        $aRoleMenu->roleid=$id;
                        $aRoleMenu->menuid=$menuid;
                        $aRoleMenu->permissionid=$permissionid;
                        $aRoleMenu->save();
                    }
                }
            });
        }else{
             $msg="Please Select Menu";
             return redirect()->back()->with('msg',$msg);
        }
        return redirect()->back()->with('msg',"Role Updated Successfuly");
    }
    // For Ajax Call ===============
    public function getValue(Request $request){
        $option=$request->option;
        $methodid=$request->methodid;
        $rolecreatorid=$request->rolecreatorid;
        $createdroleid=$request->createdroleid;
        if($option=="rolecreate"){
            if($methodid==1){
                $this->roleCreate($rolecreatorid,$createdroleid);
            }
        }elseif($option=="rolecedit"){
            if($methodid==1){
                $this->editRole($rolecreatorid,$createdroleid);
            }
        }
    }
    private function roleCreate($rolecreatorid,$createdroleid){
        $aRoleMenu=new RoleMenu();
        $menuList=$aRoleMenu->menuList($rolecreatorid,$createdroleid);
        $parentMenuList=$aRoleMenu->parentMenuList($rolecreatorid,$createdroleid);
        $output="<ul class='role_menu'>";
        foreach($parentMenuList as $x){
            $output.="<li><label><input type='checkbox' name='menuid[$x->menuid]' value='$x->menuid'>$x->name</label>";
            $output.="<input type='hidden' name='permissionid[$x->menuid][0]' value='0'>";
            $output.="<ul>";
            foreach($menuList[$x->menuid] as $item){
                $menuid=$item[0]->menuid;
                $menuName=$item[0]->name;
                $output.="<li>";
                $output.="<div class='menu'>";
                $output.="<label><input type='checkbox' name='menuid[$menuid]' value='$menuid'>$menuName</label>";
                $output.="</div>";
                $output.="<div class='permission'>";
                foreach($item[1] as $permission_item){
                    $permissionName=$permission_item->name;
                    $permissionid=$permission_item->permissionid;
                    $output.="<label><input type='checkbox' name='permissionid[$menuid][$permissionid]' value='$permissionid'>$permissionName &nbsp;&nbsp;</label>";
                }
                $output.="</div>";
                $output.="</li>";
            }
            $output.="</ul>";
        }
        $output.="</ul";
        echo  $output;
    }
    private function editRole($rolecreatorid,$createdroleid){
        $aRoleMenu=new RoleMenu();
        $menuList=$aRoleMenu->menuList($rolecreatorid,$createdroleid);
        $parentMenuList=$aRoleMenu->parentMenuList($rolecreatorid,$createdroleid);
        $output="<ul class='role_menu'>";
        foreach($parentMenuList as $x){
            if($x->child_menuid!=0){
                $output.="<li><label><input type='checkbox' checked name='menuid[$x->menuid]' value='$x->menuid'>$x->name</label>";
            }else{
                $output.="<li><label><input type='checkbox' name='menuid[$x->menuid]' value='$x->menuid'>$x->name</label>";
            }
            $output.="<input type='hidden' name='permissionid[$x->menuid][0]' value='0'>";
            $output.="<ul>";
            foreach($menuList[$x->menuid] as $item){
                $menuid=$item[0]->menuid;
                $menuName=$item[0]->name;
                $output.="<li>";
                $output.="<div class='menu'>";
                if($item[0]->child_menuid!=0){
                    $output.="<label><input type='checkbox' checked name='menuid[$menuid]' value='$menuid'>$menuName</label>";
                }else{
                    $output.="<label><input type='checkbox' name='menuid[$menuid]' value='$menuid'>$menuName</label>";
                }
                $output.="</div>";
                $output.="<div class='permission'>";
                foreach($item[1] as $permission_item){
                    $permissionName=$permission_item->name;
                    $permissionid=$permission_item->permissionid;
                    if($permission_item->child_permissionid!=0){
                        $output.="<label><input type='checkbox' checked name='permissionid[$menuid][$permissionid]' value='$permissionid'>$permissionName &nbsp;&nbsp;</label>";
                    }else{
                        $output.="<label><input type='checkbox' name='permissionid[$menuid][$permissionid]' value='$permissionid'>$permissionName &nbsp;&nbsp;</label>";
                    }  
                }
                $output.="</div>";
                $output.="</li>";
            }
            $output.="</ul>";
        }
        $output.="</ul";
        echo  $output;
    }
}
