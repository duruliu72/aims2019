<?php

namespace App\com\adventure\school\usermanager;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\role\Role;
class UserManager extends Model
{
    public function getUsers($rolecreatorid){
        $sql="SELECT 
        users.id,
        users.name userName,
        users.email,
        roles.name AS roleName
        FROM `users`
        INNER JOIN role_user ON users.id=role_user.userid
        INNER JOIN roles ON role_user.roleid=roles.id
        WHERE role_user.roleid=?";
        $qResult=\DB::select($sql,[$rolecreatorid]);
        $result=collect($qResult);
        return $result;
    }
    public function getSuccessorUsers(){
        $users=array();
        $aRole=new Role();
        $roleList=$aRole->getExcludeSuccessorRole();
        foreach($roleList as $roleitem){
            $result=$this->getUsers($roleitem->id);
            foreach($result as $user){
                array_push($users,$user);
            }
        }
        return $users;
    }
    public function checkUserForEdit($id){
        $users=$this->getSuccessorUsers();
        foreach($users as $user){
            if($user->id==$id){
                return true;
            }
        }
        return false;
    }
    public function getUser($userid){
        $sql="SELECT 
        users.id,
        users.name userName,
        users.email,
        role_user.roleid,
        roles.name AS roleName
        FROM `users`
        INNER JOIN role_user ON users.id=role_user.userid
        INNER JOIN roles ON role_user.roleid=roles.id
        WHERE role_user.userid=?";
        $qResult=\DB::select($sql,[$userid]);
        $result=collect($qResult)->first();
        return $result;
    }
}
