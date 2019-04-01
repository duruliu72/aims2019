<?php

namespace App\Http\Controllers\com\adventure\school\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    	return view('admin.rolesettings.role.index',['sidebarMenu'=>$sidebarMenu,'pList'=>$pList,'result'=>$roleList]);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('role');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('role');
        if($pList[2]->id==2){
            $aRole=new Role();
            $aRoleMenu=new RoleMenu();
            $roleList=$aRole->getIncludeSuccessorRole();
            $menuList=$aRoleMenu->getMenuListByRole($aRole->getRoleId());
            $permissionList=$aRoleMenu->getPermissionList($aRole->getRoleId());
            return view('admin.rolesettings.role.create',['sidebarMenu'=>$sidebarMenu,'roleList'=>$roleList,'menuList'=>$menuList,'permissionList'=>$permissionList]);
        }else{
            return redirect('error');
        }
        
    }
    private function isValid($selectmenu){
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
        if($selectmenu!=null){
            $isTrue=$this->isValid($selectmenu);
            $newRoleId=0;
            if($isTrue){
                $newRoleId=\DB::table('roles')->insertGetId(['name'=>$name,'rolecreatorid'=>$rolecreatorid]);
            }else{
                $msg="Please Select Sub Menu";
                return redirect()->back()->with('msg',$msg);
            }
            if($newRoleId){
                foreach($selectmenu as $menuid){
                    if(isset($_POST["permissionid_".$menuid])){
                        $permissionidList=$_POST["permissionid_".$menuid];
                        foreach ($permissionidList as $permissionid) {
                            $aRoleMenu=new RoleMenu();
                            $aRoleMenu->roleid=$newRoleId;
                            $aRoleMenu->menuid=$menuid;
                            $aRoleMenu->permissionid=$permissionid;
                            $aRoleMenu->save();
                        }
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
        if($pList[2]->id==2){
            $aRoleMenu=new RoleMenu();
            $aRole=Role::findOrfail($id);
            $roleList=$aRole->getPredecessorRole($aRole->id);
            $list=$aRoleMenu->editPermissionList($aRole->rolecreatorid,$aRole->id);
            return view('admin.rolesettings.role.edit',['sidebarMenu'=>$sidebarMenu,'roleList'=>$roleList,'bean'=>$aRole,'list'=>$list]); 
        }else{
            return redirect('error');
        }
        
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        ]);
        $selectmenu=$request->menuid;
        if($selectmenu!=null){
            $isTrue=$this->isValid($selectmenu);
            if($isTrue==false){
                $msg="Please Select Sub Menu";
                return redirect()->back()->with('msg',$msg);
            }
            $status=\DB::transaction(function () use($request, $id){
                $aRole=Role::findOrfail($id);
                $aRole->name=$request->name;
                $aRole->rolecreatorid=$request->rolecreatorid;
                $selectmenu=$request->menuid;
                $aRole->update();
                \DB::select('DELETE  FROM `role_menu` WHERE roleid=?',[$id]);
                foreach($selectmenu as $menuid){
                    $vpermissionid="permissionid_".$menuid;
                    if(isset($request->$vpermissionid)){
                        $permissionidList=$request->$vpermissionid;
                        foreach ($permissionidList as $permissionid) {
                            $aRoleMenu=new RoleMenu();
                            $aRoleMenu->roleid=$id;
                            $aRoleMenu->menuid=$menuid;
                            $aRoleMenu->permissionid=$permissionid;
                            $aRoleMenu->save();
                        }
                    } 
                }
            });
        }else{
             $msg="Please Select Menu";
             return redirect()->back()->with('msg',$msg);
        }
        return redirect()->back()->with('msg',"Role Updated Successfuly");
    }
}
