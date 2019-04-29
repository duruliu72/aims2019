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
    public function menuList($parent_roleid,$child_roleid){
        $sql="SELECT 
        parent_menu.menuid,
        parent_menu.name,
        parent_menu.parentid,
        IFNULL(child_menu.menuid,0) AS child_menuid
        From(SELECT 
        role_menu.menuid,
        menus.name,
        menus.parentid
        FROM `role_menu`
        INNER JOIN menus ON role_menu.menuid=menus.id
        WHERE roleid=? GROUP BY menuid) AS  parent_menu
        LEFT JOIN
        (SELECT
        role_menu.menuid
        FROM `role_menu`
        WHERE roleid=? GROUP BY menuid) AS  child_menu 
        ON parent_menu.menuid=child_menu.menuid WHERE parent_menu.parentid!=0 ORDER BY parent_menu.menuid";
        $qresult=\DB::select($sql,[$parent_roleid,$child_roleid]);
        $result=collect($qresult);
        $parent_result=$this->parentMenuList($parent_roleid,$child_roleid);
        // dd($parent_result);
        foreach($parent_result as $parent_item){
            $list[$parent_item->menuid]=array();
        }
        foreach($result as $item){
            foreach($parent_result as $parent_item){
                if($parent_item->menuid==$item->parentid){
                    $permission=$this->permissionOnMenu($parent_roleid,$child_roleid,$item->menuid);
                    array_push($list[$parent_item->menuid],array($item,$permission));
                }
            }
        }
        return $list;
    }
    public function parentMenuList($parent_roleid,$child_roleid){
        $parentsql="SELECT 
        parent_menu.menuid,
        parent_menu.name,
        parent_menu.parentid,
        IFNULL(child_menu.menuid,0) AS child_menuid
        From (SELECT 
        role_menu.menuid,
        menus.name,
        menus.parentid
        FROM `role_menu`
        INNER JOIN menus ON role_menu.menuid=menus.id
        WHERE roleid=? GROUP BY menuid) AS  parent_menu
        LEFT JOIN
        (SELECT
        role_menu.menuid
        FROM `role_menu`
        WHERE roleid=? GROUP BY menuid) AS  child_menu 
        ON parent_menu.menuid=child_menu.menuid WHERE parent_menu.parentid=0  ORDER BY parent_menu.menuid";
        $parent_qresult=\DB::select($parentsql,[$parent_roleid,$child_roleid]);
        $parent_result=collect($parent_qresult);
        return $parent_result;
    }
    public function permissionOnMenu($parent_roleid,$child_roleid,$menuid){
        $sqlpermission="SELECT table1.*,
        IFNULL(table2.permissionid,0) AS child_permissionid
        FROM(SELECT 
        role_menu.menuid,
        role_menu.permissionid,
        permissions.name
        FROM `role_menu`
        INNER JOIN permissions ON role_menu.permissionid=permissions.id
        WHERE roleid=?) AS table1
        LEFT JOIN 
        (SELECT 
        role_menu.menuid,
        role_menu.permissionid
        FROM `role_menu`
        WHERE roleid=?) AS table2 ON table1.menuid=table2.menuid && table1.permissionid=table2.permissionid
        WHERE table1.menuid=?";
        $permission_qresult=\DB::select($sqlpermission,[$parent_roleid,$child_roleid,$menuid]);
        $permission_result=collect($permission_qresult);
        return $permission_result;
    }
}
