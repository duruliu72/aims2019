<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    protected $table='postoffices';
   	protected $fillable = ['name','thanaid','status'];
   	public function getAllPostOffice(){
   		$sql="SELECT 
		postoffices.*,
		thanas.name AS thanaName,
		districts.name AS districtName,
		divisions.name AS divisionName
		FROM `postoffices`
		INNER JOIN thanas ON postoffices.thanaid=thanas.id
		INNER JOIN districts ON thanas.districtid=districts.id
		INNER JOIN divisions ON districts.divisionid=divisions.id";
		$result=\DB::select($sql);
		return $result;
   	}
   	public function getAllPostOfficeOnThana($thanaid){
      $sql="SELECT * FROM `postoffices` WHERE thanaid=?";
      $result=\DB::select($sql,[$thanaid]);
      return $result;
    }
}
