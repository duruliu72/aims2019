<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected  $table='sessions';
    protected $fillable = ['name','status'];
    public function getSessionId($name=null){
		if($name==null){
			$name = date('Y');
		}
    	$sql="SELECT * FROM `sessions` WHERE name=?";
			$qresult=\DB::select($sql,[$name]);
			$result = collect($qresult);
			if($result->isNotEmpty()){
				$obj=$result->first();
				return $obj->id;
			}
			return 0;
    }
}
