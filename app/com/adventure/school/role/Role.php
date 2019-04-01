<?php

namespace App\com\adventure\school\role;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Role extends Model
{
    protected $table='roles';
    protected $fillable = ['name','rolecreatorid','status'];
    public function getRoleId(){
	 	 $aRole=\DB::select('SELECT 
        roles.id ,
        roles.name 
        FROM users
        INNER JOIN role_user ON users.id=role_user.userid
        INNER JOIN roles ON role_user.roleid=roles.id
        WHERE users.id=1',[Auth::user()->id])[0];
	 	 return $aRole->id;
	 }
    public function getIncludeSuccessorRole(){
        return $this->ownAndSuccessorRole($this->getRoleId());
    }
    public function getExcludeSuccessorRole(){
        return $this->getRoleList($this->getRoleId(),0);
    }
    public function ownAndSuccessorRole($id){
      $result=\DB::select('SELECT t1.*,roles.name AS creatorName 
FROM (SELECT * FROM `roles` WHERE roles.id=?) AS t1 
LEFT JOIN roles ON t1.rolecreatorid=roles.id', [$id]);
      $list[0]=$result[0];
      $items=$this->getRoleList($id,0);
      $i=1;
      foreach ($items as $item){
        $list[$i]=$item;
        $i++;
      }
      return $list;
    }
    public function getPredecessorRole($id){
       $list1=$this->getIncludeSuccessorRole();
       $list2=$this->ownAndSuccessorRole($id);
       $isExist=true;
        $i=0;
        $list=array();
        foreach ($list1 as $item) {
           $isExist=$this->check($list2,$item->id);
           if($isExist==false){
               $list[$i]=$item;
               $i++;
           }
        }
        return $list;
    }
    private function check($list,$id){
       foreach ($list as $item) {
         if($item->id==$id){
           return true;
         }
       }
       return false;
    }
    private function getRoleList($roleid,$i){
        $result=\DB::select('SELECT t1.*,roles.name AS creatorName FROM (SELECT * FROM `roles`
WHERE roles.rolecreatorid=?) AS t1
LEFT JOIN roles ON t1.rolecreatorid=roles.id', [$roleid]);
        if(count($result)>0){
            foreach ($result as $item) {
              $list[$i]=$item;
              $i++;
              $hasItem=$this->hasItem($item->id);
              if($hasItem){
                $iresult=$this->getRoleList($item->id,$i);
                foreach ($iresult as $value) {
                 $list[$i]=$value;
                 $i++;
               }
             }
            }
            return $list;
        }
        return $result;
    }

    private  function hasItem($roleid){
        $result=\DB::select('select * from roles where rolecreatorid=?',[$roleid]);
        if($result){
          return true;
        }else{
          return false;
        }
    }
}
