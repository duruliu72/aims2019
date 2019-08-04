<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
     protected  $table='programs';
     protected $fillable = ['name','programsign','programlabelid','status'];
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
     public function getProgramOnLabelid($programlabelid){
          $sql="SELECT * FROM `programs`
          WHERE programlabelid=?";
          $qresul=\DB::select($sql,[$programlabelid]);
          $result=collect($qresul);
          return $result;
     }
     public function getPrograms(){
          $sql="SELECT 
          programs.*,
          pl.name AS programLabel
          FROM `programs`
          INNER JOIN programlevels AS pl ON programs.programlabelid=pl.id
          ORDER BY programlabelid";
          $qResult=\DB::select($sql);
          $result=collect($qResult);
          return $result;
     }
}
