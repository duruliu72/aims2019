<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EducationInfo extends Model
{
    protected $table='educationinfo';
    protected $fillable = ['employeeid','educationdegreeid','discipline','grade','passingyear','board','status'];
    public function getEducationInfo($employeeid){
        $sql="SELECT * FROM `educationinfo`
        WHERE employeeid=?";
        $qResult=\DB::select($sql,[$employeeid]);
        $result=collect($qResult);
        return $result;
    }
}
