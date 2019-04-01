<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table='districts';
   	protected $fillable = ['name','divisionid','status'];
   	public function getAllDistrict(){
   		$sql="SELECT districts.* ,
		divisions.name AS divisionName
		FROM `districts`
		INNER JOIN divisions ON districts.divisionid=divisions.id";
   		$result=\DB::select($sql);
		return $result;
   	}
    public function getAllDistrictOnDivision($divisionid){
      $sql="SELECT * FROM `districts` WHERE divisionid=?";
      $result=\DB::select($sql,[$divisionid]);
      return $result;
    }
}
