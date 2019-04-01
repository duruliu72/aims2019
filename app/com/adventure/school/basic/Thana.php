<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $table='thanas';
   	protected $fillable = ['name','districtid','status'];
   	public function getAllThana(){
   		$sql="SELECT thanas.* ,
		districts.name AS districtName,
		divisions.name AS divisionName
		FROM `thanas`
		INNER JOIN districts ON thanas.districtid=districts.id
		INNER JOIN divisions ON districts.divisionid=divisions.id";
		$result=\DB::select($sql);
		return $result;
   	}
   	public function getAllThanaOnDistrict($districtid){
      $sql="SELECT * FROM `thanas` WHERE districtid=?";
      $result=\DB::select($sql,[$districtid]);
      return $result;
    }
}
