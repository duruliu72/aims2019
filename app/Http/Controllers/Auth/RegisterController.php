<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\com\adventure\school\role\Role;
use App\com\adventure\school\role\RoleUser;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\role\Permission;
use App\com\adventure\school\role\RoleMenu;
use App\com\adventure\school\role\RolePermission;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {       
        $aUser=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // Create Default Menu And Default Permission
        $menuList=Menu::All();
        if($menuList->count()==0){
            $aMenu1=new Menu();
            $aMenu1->id=1;
            $aMenu1->name="Menu Settings";
            $aMenu1->parentid=0;
            $aMenu1->menuorder=100;
            $aMenu1->save();
            $aMenu2=new Menu();
            $aMenu2->id=2;
            $aMenu2->name="Menu";
            $aMenu2->url="menu";
            $aMenu2->parentid=1;
            $aMenu2->menuorder=100;
            $aMenu2->save(); 
        }
        $pList=Permission::all();
        if($pList->count()==0){
           $aPermission1=new Permission();
           $aPermission1->id=1;
           $aPermission1->name="Read";
           $aPermission1->save();
           $aPermission2=new Permission();
           $aPermission2->id=2;
           $aPermission2->name="Create";
           $aPermission2->save();
           $aPermission3=new Permission();
           $aPermission3->id=3;
           $aPermission3->name="Up";
           $aPermission3->save();
           $aPermission4=new Permission();
           $aPermission4->id=4;
           $aPermission4->name="Up";
           $aPermission4->save();
        }
        \DB::transaction(function () use($aUser){
             // Create Role
            $aRole=new Role();
            $aRole->name=$aUser->name;
            $aRole->rolecreatorid=0;
            $aRole->save();
            $lastOne=\DB::table('roles')->orderBy('id', 'desc')->first();
            $newroleid=$lastOne->id;
            // Assign Role To User
            $aRoleUser=new RoleUser();
            $aRoleUser->roleid=$newroleid;
            $aRoleUser->userid=$aUser->id;
            $aRoleUser->save();
            // Assign Menus To Role
            $listx=Menu::All();
            $listy=Permission::all();
            foreach($listx as $x) {
                if($x->parentid!=0){
                    foreach($listy as $y){
                    $aRoleMenu=new RoleMenu();
                    $aRoleMenu->roleid=$newroleid;
                    $aRoleMenu->menuid=$x->id;
                    $aRoleMenu->permissionid=$y->id;
                    $aRoleMenu->save();
                    }
                }else{
                    $aRoleMenu=new RoleMenu();
                    $aRoleMenu->roleid=$newroleid;
                    $aRoleMenu->menuid=$x->id;
                    $aRoleMenu->permissionid=0;
                    $aRoleMenu->save();
                }
                
            }
        });
        return $aUser;
    }
}
