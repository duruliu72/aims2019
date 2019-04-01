<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class LocalGov extends Model
{
    protected $table='localgovs';
   	protected $fillable = ['name','thanaid','status'];
   	public function getAllLocalGov(){
   		$sql="SELECT 
		localgovs.*,
		thanas.name AS thanaName,
		districts.name AS districtName,
		divisions.name AS divisionName
		FROM `localgovs`
		INNER JOIN thanas ON localgovs.thanaid=thanas.id
		INNER JOIN districts ON thanas.districtid=districts.id
		INNER JOIN divisions ON districts.divisionid=divisions.id";
   		$result=\DB::select($sql);
   		return $result;
   	}
   	public function getAllLocalGovOnThana($thanaid){
      $sql="SELECT * FROM `localgovs` WHERE thanaid=?";
      $result=\DB::select($sql,[$thanaid]);
      return $result;
    }
}
