<?php

namespace App\com\adventure\school\role;
use Illuminate\Database\Eloquent\Model;
class RoleMenu extends Model
{
    protected $table='role_menu';
    public $timestamps = false;
    protected $fillable = ['roleid','menuid','permissionid'];

    // Menu List For System Login user Role
    public function getMenuListByRole($roleid){
    	$sql="SELECT menus.* FROM(SELECT t1.roleid,t1.menuid 
        FROM `role_menu` AS t1 WHERE t1.roleid=? GROUP BY t1.menuid) t2
        INNER JOIN menus ON t2.menuid=menus.id";
		$list=\DB::select($sql,[$roleid]);
		return $list;
    }
    public function getPermissionList($roleid){
        $menuList=$this->getMenuListByRole($roleid);
        $tdarray=array();
        $i=0;
        foreach ($menuList as $x) {
         $permissionList=$this->getPermisionListByMenu($roleid,$x->id);
         $tdarray[$i] =['menuitem'=>$x,'permissionList'=>$permissionList];
         $i++;
        }
       return $tdarray;
    }
    private function getPermisionListByMenu($roleid,$menuid){
        $sql="SELECT t1.*,permissions.name
        FROM `role_menu` AS t1
        INNER JOIN permissions ON t1.permissionid=permissions.id
        WHERE t1.roleid=? && t1.menuid=?";
        $list=\DB::select($sql,[$roleid,$menuid]);
        return $list;
    }
    public function getMenuList($parentid,$chieldid){
        $sql="SELECT t1.*,
        IFNULL(t2.id,0) AS childroleid
        FROM(SELECT 
        menus.*
        FROM `role_menu`
        INNER JOIN menus ON role_menu.menuid=menus.id
        WHERE roleid=? GROUP BY role_menu.menuid) AS t1
        LEFT JOIN (SELECT 
        menus.*
        FROM `role_menu`
        INNER JOIN menus ON role_menu.menuid=menus.id
        WHERE roleid=? GROUP BY role_menu.menuid) AS t2 ON t1.id=t2.id";
        $list=\DB::select($sql,[$parentid,$chieldid]);
        return $list;
    }
    public function editPermissionList($parentid,$chieldid){
        $menuList=$this->getMenuList($parentid,$chieldid);
        $tdarray=array();
        $i=0;
        foreach ($menuList as $x) {
         $permissionList=$this->getEditPermissionList($parentid,$chieldid,$x->id);
         $tdarray[$i] =['menuitem'=>$x,'permissionList'=>$permissionList];
         $i++;
        }
       return $tdarray;
    }
    private function getEditPermissionList($parentid,$chieldid,$menuid){
        $sql="SELECT t1.*,
        IFNULL(t2.id,0) AS cid
        FROM(SELECT permissions.*
        FROM `role_menu`
        INNER JOIN permissions ON permissions.id=role_menu.permissionid
        WHERE role_menu.roleid=? && role_menu.menuid=?) AS t1
        LEFT JOIN (SELECT permissions.*
        FROM `role_menu`
        INNER JOIN permissions ON permissions.id=role_menu.permissionid
        WHERE role_menu.roleid=? && role_menu.menuid=?) AS t2 ON t1.id=t2.id ORDER BY t1.id";
        $list=\DB::select($sql,[$parentid,$menuid,$chieldid,$menuid]);
        return $list;
    }
}
