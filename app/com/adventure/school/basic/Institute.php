<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table='institutes';
   	protected $fillable = [
   		'name','ins_mobile_no','institutetypeid','categoryid','subcategoryid','addressid',
   		'wordno','cluster','ein','institutelogo','status'
   	];
   	public function getAllInstitute(){
   		$sql="SELECT 
		t1.*,
		divisions.name AS divisionName,
		districts.name AS districtName,
		thanas.name AS thanaName,
		postoffices.name AS postofficeName,
		addresses.postcode,
		localgovs.name AS localgovName,
		addresses.address
		FROM `institutes` AS t1
		INNER JOIN addresses ON t1.addressid=addresses.id
		INNER JOIN divisions ON addresses.divisionid=divisions.id
		INNER JOIN districts ON addresses.districtid=districts.id
		INNER JOIN thanas ON addresses.thanaid=thanas.id
		INNER JOIN postoffices ON addresses.postofficeid=postoffices.id
		INNER JOIN localgovs ON addresses.localgovid=localgovs.id";
		$qresult=\DB::select($sql);
		$result=collect($qresult);
		return $result;
   	}
   	public function getInstituteById($id){
   		$sql="SELECT 
		   t1.*,
		   addresses.divisionid,
		   divisions.name AS divisionName,
		   addresses.districtid,
		   districts.name as districtName,
		   addresses.thanaid,
		   thanas.name AS thanaName,
		   addresses.postofficeid,
		   addresses.postcode,
		   addresses.localgovid,
		   localgovs.name as localgovName,
		   addresses.address
		   FROM `institutes` AS t1
		   INNER JOIN addresses ON t1.addressid=addresses.id
		   INNER JOIN divisions ON addresses.divisionid=divisions.id
		   INNER JOIN districts ON addresses.districtid=districts.id
		   INNER JOIN thanas ON addresses.thanaid=thanas.id
			INNER JOIN localgovs ON addresses.localgovid=localgovs.id
		   WHERE t1.id=?";
		$qresult=\DB::select($sql,[$id]);
		$result=collect($qresult)->first();
		return $result;
   	}
   	public static function getInstituteName(){
		$sql="SELECT institutes.name FROM `institutes` WHERE id=1";
		$qresult=\DB::select($sql);
		$result=collect($qresult)->first();
		return $result;
   	}
}
