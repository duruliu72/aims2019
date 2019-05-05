<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='addresses';
    public $timestamps = false;
   	protected $fillable = ['registeredid','typeid','divisionid','districtid','thanaid','postofficeid','postcode','localgovid','address'];
   	public function getAddressById($id){
   		$sql="SELECT 
		addresses.*,
		divisions.name AS divisionName,
		districts.name AS districtName,
		thanas.name AS thanaName,
		postoffices.name AS postofficeName,
		localgovs.name AS localgovName
		FROM `addresses`
		INNER JOIN divisions ON addresses.divisionid=divisions.id
		INNER JOIN districts ON addresses.districtid=districts.id
		INNER JOIN thanas ON addresses.thanaid=thanas.id
		INNER JOIN postoffices ON addresses.postofficeid=postoffices.id
		INNER JOIN localgovs ON addresses.localgovid=localgovs.id
		WHERE addresses.id=?";
		$qresult=\DB::select($sql,[$id]);
		$result=collect($qresult)->first();
		return $result;
	   }
	   public function getDropDownValue($id,$tableName,$compareid){
			$sql="SELECT * FROM `districts` WHERE divisionid=?";
	   }
}
