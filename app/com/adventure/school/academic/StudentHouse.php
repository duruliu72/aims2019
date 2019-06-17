<?php

namespace App\com\adventure\school\academic;

use Illuminate\Database\Eloquent\Model;

class StudentHouse extends Model
{
    protected  $table='students_house';
    protected $fillable = ['programofferid','applicantid','admittedtypeid','status'];
    public function check($programofferid,$applicantid){
        $sql="SELECT * FROM `students_house`
        WHERE programofferid=? && applicantid=?";
        $qResult=\DB::select($sql,[$programofferid,$applicantid]);
        $result=collect($qResult);
        if($result->count()>0){
            return true;
        }
        return false;
    }
}
