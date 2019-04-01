<?php

namespace App\Http\Controllers\com\adventure\school;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\role\RoleMenu;
use App\com\adventure\school\program\ProgramOffer;
class AjaxController extends Controller
{
	  public function getValue(Request $request){
	  	$option=$request->option;
	  	$idvalue=$request->idvalue;
	    $methodid=$request->methodid;
	    if($option=="programtogroup"){
	          if($methodid==1){
	             $this->getGroupOnProgram($idvalue);
	          }
	     }elseif($option=="admissiongroup"){
              if($methodid==1){
                  $this->getAllAdmissionGroup($idvalue);
              }
         }elseif ($option=="RcreatorToRole") {
            if($methodid==1){
                  $this->createRole($idvalue);
              }
         }
	  }
      private function getGroupOnProgram($programid){
            $sql="SELECT groups.* FROM `vprogram_groups` AS t1
            INNER JOIN groups ON t1.groupid=groups.id
            WHERE t1.programid=?";
            $result=\DB::select($sql,[$programid]);
            $output="<option value=''>SELECT</option>";
            foreach($result as $x){
                $output.="<option value='$x->id'>$x->name</option>";
            }
            echo  $output;
      }
      private function getAllAdmissionGroup($programid){
        $aProgramOffer=new ProgramOffer();
        $result=$aProgramOffer->getAllGroup(0,$programid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
            $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
      }
	  private function createRole($rolecreatorid){
  		$aRoleMenu=new RoleMenu();
  		$menuList=$aRoleMenu->getMenuListByRole($rolecreatorid);
        $permissionList=$aRoleMenu->getPermissionList($rolecreatorid);
        $output="<ul class='role_menu'>";
        foreach($menuList as $x){
          if($x->parentid==0){
        	$output.="<li><label><input type='checkbox' name='menuid[]' value='$x->id'>$x->name</label><input  type='checkbox' hidden checked name='permissionid_$x->id[]' value='0'>";
             $output.="<ul>";
             foreach($permissionList as $y){
             	if($y['menuitem']->parentid==$x->id){
             		$output.="<li>";
             		$output.="<div class='menu'>";
             		$id=$y['menuitem']->id;
             		$name=$y['menuitem']->name;
             		$output.="<label><input type='checkbox' name='menuid[]'' value='$id'>$name</label>";
             		$output.="</div>";
             		$output.="<div class='permission'>";
             		foreach($y['permissionList'] as $p){
             			$menuid=$y['menuitem']->id;
             			$permissionid="permissionid_".$menuid."[]";
                        $output.="<label><input type='checkbox' name='$permissionid' value='$p->permissionid'>$p->name &nbsp;&nbsp;</label>";
             		}
             		$output.="</div>";
             		$output.="</li>";
             	}
             }
             $output.="</ul>";
          }
        }
        $output.="</ul>";
 		echo  $output;  
	  }
	  public function getValueWith(Request $request){
	  	$option=$request->option;
	  	$rolecreatorid=$request->idvalue;
	  	$id=$request->id;
	    $methodid=$request->methodid;
	    if($option=="editRcreatorToRole"){
	          if($methodid==1){
	              $this->editRole($rolecreatorid,$id);
	          }
	     }
	  }
	  private function editRole($rolecreatorid,$id){
	  		$aRoleMenu=new RoleMenu();
	  		$list=$aRoleMenu->editPermissionList($rolecreatorid,$id);
	  		$output="<ul class='role_menu'>";
	  		foreach($list as $x){
	  			if($x['menuitem']->parentid==0){
	  				$menuid=$x['menuitem']->id;
	  				$menuname=$x['menuitem']->name;
	  				$permissionid="permissionid_".$menuid."[]";
	  				if($x['menuitem']->childroleid!=0){
	  					$output.="<li><label><input type='checkbox' checked name='menuid[]' value='$menuid'>$menuname</label><input  type='checkbox' hidden checked name='$permissionid' value='0'>";
	  				}else{
	  					$output.="<li><label><input type='checkbox' name='menuid[]' value='$menuid'>$menuname</label><input  type='checkbox' hidden checked name='$permissionid' value='0'>";
	  				}
	  				$output.="<ul>";
	  				foreach($list as $y){
	  					if($y['menuitem']->parentid==$x['menuitem']->id){
	  						$output.="<li>";
             				$output.="<div class='menu'>";
             				$ymid=$y['menuitem']->id;
             				$ymname=$y['menuitem']->name;
             				if($x['menuitem']->childroleid!=0){
             					$output.="<label><input type='checkbox' checked name='menuid[]' value='$ymid'>$ymname</label>";
             				}else{
             					$output.="<label><input type='checkbox' name='menuid[]' value='$ymid'>$ymname</label>";
             				}
             				$output.="</div>";
             				$output.="<div class='permission'>";
             				foreach($y['permissionList'] as $p){
             					$ypermissionid="permissionid_".$ymid."[]";
             					$ypid=$p->id;
             					$ypname=$p->name;
             					if($p->cid!=0){
             						$output.="<label><input type='checkbox' checked name='$ypermissionid' value='$ypid'>$ypname &nbsp;&nbsp;</label>";
             					}else{
             						$output.="<label><input type='checkbox' name='$ypermissionid' value='$ypid'>$ypname &nbsp;&nbsp;</label>";
             					}
             				}
             				$output.="</div>";
             				$output.="</li>";
	  					}
	  				}
	  				$output.="</ul>";
	  			}
	  		}
		  	$output.="</ul>";
	 		echo  $output;  
	  }
}
