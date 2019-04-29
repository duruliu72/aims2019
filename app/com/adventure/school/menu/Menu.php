<?php

namespace App\com\adventure\school\menu;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\role\Role;
class Menu extends Model
{
    protected $table='menus';
   	protected $fillable = ['name','url','parentid','menuorder','status'];
   	public function getAllMenu(){
   		$sql="SELECT t1.id,
		t1.name,
		IFNULL(t1.url,'No Url') AS url,
		t1.parentid,
		t1.menuorder,
		t1.status,
		IFNULL(menus.name,'No Parent') AS parentName 
		FROM(SELECT * FROM `menus`) AS t1
		LEFT JOIN menus ON t1.parentid=menus.id ORDER BY t1.id";
   		$menuList=\DB::select($sql);
   		return $menuList;
   	}
   	public function getParentsMenu(){
   		$sql="SELECT * FROM `menus` WHERE parentid=0";
   		$pmenuList=\DB::select($sql);
   		return $pmenuList;
   	}
   	public function getPermissionOnMenu($url){
   		$aRole=new Role();
   		$sql="SELECT
		IFNULL(t3.id,0)as id 
		FROM permissions
		LEFT JOIN (SELECT permissions.* FROM(SELECT t1.permissionid FROM `role_menu` AS t1
		INNER JOIN menus ON t1.menuid=menus.id
		WHERE t1.roleid=? AND menus.url=?)AS t2
		INNER JOIN permissions ON t2.permissionid=permissions.id) AS t3 ON permissions.id=t3.id";
		$pList=\DB::select($sql,[$aRole->getRoleId(),$url]);
		$list=array();
		$i=1;
		foreach ($pList as $x){
			$list[$i]=$x;
			$i++;
		}
		return $list;
   	}
   	// For Dynamic menu===========================
   	public function getSidebarMenu(){
   		return $this->adminmenu(0);
   	}
   	private function adminmenu($parentid){
   		$menu = "";
   		$aRole=new Role();
       	$roleid=$aRole->getRoleId();
       	$sql="SELECT menus.* FROM(SELECT t1.roleid,t1.menuid FROM `role_menu` AS t1
		WHERE t1.roleid=? group BY t1.menuid) AS t2
		INNER JOIN menus ON t2.menuid=menus.id WHERE menus.parentid=? ORDER by menus.menuorder ASC";
	    $menuList=\DB::select($sql,[$aRole->getRoleId(),$parentid]);
	    foreach ($menuList as $x) {
		    $isTrue=$this->hasChild($x->id);
		    if($isTrue){
		     $menu .="<li class='sub-menu'><a href='javascript:;'>".$x->name."</a>";
		     $menu .= "<ul class='sub'>".$this->adminmenu($x->id)."</ul>";
		   }else{
		   	 if($x->parentid!=0){
		   	 	$url=url('/').'/'.$x->url;
		   	 	$menu .="<li class=''><a href='".$url."'>".$x->name."</a>";
		   	 }else{
		   	 	$menu .="<li class='sub-menu'><a href='javascript:;'>".$x->name."</a>";
		   	 }
		  }
		  $menu .= "</li>";
		}
		return $menu;
   	}
   	private  function hasChild($parentid){
	  $result=\DB::select('SELECT * FROM menus where parentid=?',[$parentid]);
	  if($result){
	    return true;
	  }else{
	    return false;
	  }
	}
	public function hasMenu($url){
		$aRole=new Role();
		$sql="SELECT menus.* FROM(SELECT t1.menuid FROM `role_menu` AS t1
		WHERE t1.roleid=? GROUP BY t1.menuid) AS t2
		INNER JOIN menus ON t2.menuid=menus.id WHERE menus.url=?";
		$hasMenu=\DB::select($sql,[$aRole->getRoleId(),$url]);
		if($hasMenu){
			return true;
		}else{
			return false;
		}
	}
	// ==========================================Picture Upload======================
	public function generateFilename($imagepropaties,$uploaded_file){
		$selectedimageurl=$uploaded_file;
		$file_name=$selectedimageurl['name'];
		$name_explode=explode('.', $file_name);
    $file_ext = strtolower(end($name_explode));
		$unique_name = $imagepropaties['name'].substr(md5(time()), 0, 10).'.'.$file_ext;
		return $unique_name;
	}
	public function fileUpload($uploads_dir,$uploaded_file,$imagepropaties,$unique_name){
		$selectedimageurl=$uploaded_file;
		$file_temp = $selectedimageurl['tmp_name'];
		move_uploaded_file($file_temp,$uploads_dir.$unique_name);
		$resizeWidth=$imagepropaties['resizeWidth'];
		$resizeHeight=$imagepropaties['resizeHeight'];
		$this->resizeSingleImageFile($unique_name,$resizeWidth,$resizeHeight,$uploads_dir);
	}
	private function duplicateImage($unique_name,$resizeWidth,$resizeHeight,$dirSRC){
		if(is_dir($dirSRC)){
			if($dh = opendir($dirSRC)){
				while (($filename = readdir($dh)) !== false){
						if($filename===$unique_name){
								$filename = $dirSRC.DIRECTORY_SEPARATOR.$filename;
								$pathinfo = pathinfo($filename, PATHINFO_EXTENSION);
								if(in_array($pathinfo, ['jpg', 'jpeg', 'png'])){
										$im = @imagecreate(110, 20);
										$background_color = imagecolorallocate($im, 0, 0, 0);
										imagejpeg($im,$dirSRC."newfile.".$pathinfo);
										imagedestroy($im);
										if (!copy($filename, $dirSRC."newfile.".$pathinfo)) {
											echo "failed to copy $file...\n";
										}
										list($width, $height) = getimagesize($filename);
										$new_width = $resizeWidth;
										$new_height = $resizeHeight;
										$image_p = imagecreatetruecolor($new_width, $new_height);
										if($pathinfo == 'jpeg' || $pathinfo == 'jpg'){
												$image = imagecreatefromjpeg($filename);
												imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
												imagejpeg($image_p, $filename, 100);
											}elseif($pathinfo == 'png'){
												$image = imagecreatefrompng($filename);
												imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
												imagepng($image_p, $filename);
											}
								}
						}
				}
				closedir($dh);
			}
		}
	}
	private function resizeSingleImageFile($unique_image,$resizeWidth,$resizeHeight,$dirSRC){
			if(is_dir($dirSRC)){
				if($dh = opendir($dirSRC)){
					while (($filename = readdir($dh)) !== false){
							if($filename===$unique_image){
									$filename = $dirSRC.DIRECTORY_SEPARATOR.$filename;
									$pathinfo = pathinfo($filename, PATHINFO_EXTENSION);
									if(in_array($pathinfo, ['jpg', 'jpeg', 'png'])){
											list($width, $height) = getimagesize($filename);
											$new_width = $resizeWidth;
											$new_height = $resizeHeight;
											$image_p = imagecreatetruecolor($new_width, $new_height);
											if($pathinfo == 'jpeg' || $pathinfo == 'jpg'){
													$image = imagecreatefromjpeg($filename);
													imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
													imagejpeg($image_p, $filename, 100);
												}elseif($pathinfo == 'png'){
													$image = imagecreatefrompng($filename);
													imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
													imagepng($image_p, $filename);
												}
									}
							}
					}
					closedir($dh);
				}
			}
	}
	// ====================
		function resizeimagefile($dirSRC,$resizeWidth,$resizeHeight){
				if(is_dir($dirSRC)){
						if($dh = opendir($dirSRC)){
							while (($filename = readdir($dh)) !== false){
								$filename = $dirSRC.DIRECTORY_SEPARATOR.$filename;
								$pathinfo = pathinfo($filename, PATHINFO_EXTENSION);
								if(in_array($pathinfo, ['jpg', 'jpeg', 'png'])){
									list($width, $height) = getimagesize($filename);
									$new_width = $resizeWidth;
									$new_height = $resizeHeight;
									$image_p = imagecreatetruecolor($new_width, $new_height);
									if($pathinfo == 'jpeg' || $pathinfo == 'jpg'){
											$image = imagecreatefromjpeg($filename);
											imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
											imagejpeg($image_p, $filename, 100);
									}elseif($pathinfo == 'png'){
										$image = imagecreatefrompng($filename);
										imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
										imagepng($image_p, $filename);
									}
								}
							}
							closedir($dh);
						}
						return true;
				}
				return false;
	}
}