<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
     protected  $table='programs';
     protected $fillable = ['name','programsign','status'];
     public static function getProgramsOnLevel(){
          $sql="SELECT 
          programs.id,
          programs.name,
          t1.programlevelid,
          programlevels.name AS levelName
          FROM `level_programs` AS t1
          INNER JOIN programlevels ON t1.programlevelid=programlevels.id
          INNER JOIN programs ON t1.programid=programs.id
          GROUP BY t1.programid";
          $qresul=\DB::select($sql);
          $result=collect($qresul);
          return $result;
     }
}
