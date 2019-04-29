<?php

namespace App\Http\Controllers\com\adventure\school\usermanager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\basic\Institute;
use Illuminate\Support\Facades\Hash;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\usermanager\UserManager;
use App\com\adventure\school\role\Role;
use App\com\adventure\school\role\RoleUser;
use App\User;
class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){   
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('user');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('user');
        $obj=new UserManager();
        $users=$obj->getSuccessorUsers();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'users'=>$users,
        ];
        return view('admin.user_manager.user.index', $dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('user');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('user');
        if($pList[2]->id!=2){
            return redirect('error');
        }
        $aRole=new Role();
        $roleList=$aRole->getExcludeSuccessorRole();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'roleList'=>$roleList
        ];
        return view('admin.user_manager.user.create',$dataList);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'roleid' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $roleid=$request->roleid;
        $aUser=new User();
        $aUser->name=$request->name;
        $aUser->email=$request->email;
        $aUser->password= Hash::make($request->input('password'));
         $status=$aUser->save();
        $last_user=$aUser->getLastOne();
        $aRoleUser=new RoleUser();
        $aRoleUser->roleid=$roleid;
        $aRoleUser->userid=$last_user->id;
        $aRoleUser->save();
        if($status){
            $msg='User was successfully created!';
         }else{
           $msg="User not Created";
        }
        return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('user');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('user');
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aRole=new Role();
        $roleList=$aRole->getExcludeSuccessorRole();
        $obj=new UserManager();
        $checkUser=$obj->checkUserForEdit($id);
        if(!$checkUser){
            return redirect('error');
        }
        $user=$obj->getUser($id);
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'roleList'=>$roleList,
            'bean'=>$user
        ];
        return view('admin.user_manager.user.edit', $dataList);
    }
    public function update(Request $request, $id)
    {  
        $validatedData = $request->validate([
            'roleid' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);
        $roleid=$request->roleid;
        $aUser=User::findOrfail($id);
        $aUser->name=$request->name;
        $aUser->email=$request->email;
        if($request->email!=""){
            $aUser->password= Hash::make($request->input('password'));
        }
        $status=$aUser->update();
        \DB::table('role_user')
            ->where('userid', $id)
            ->update(['roleid' => $roleid]);
        if($status){
            $msg='User Updated successfully!';
         }else{
           $msg="User not Updated";
        }
        return redirect()->back()->with('msg',$msg);      
    }
}
