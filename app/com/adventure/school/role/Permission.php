<?php

namespace App\com\adventure\school\role;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\role\Role;
class Permission extends Model
{
    protected $table='permissions';
    protected $fillable = ['name','status'];
    public function getLastOne(){
    	$lastOne=\DB::table($this->table)
	    ->orderBy('id','desc')
	    ->first();
	    return $lastOne;
    }
    public function getRoleId(){
    	$aRole=new Role();
    	return $aRole->getRoleId();
    }
}
