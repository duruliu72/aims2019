<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
     protected  $table='programs';
     protected $fillable = ['name','programsign','programlabelid','status'];
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
          INNER JOIN plabels AS pl ON programs.programlabelid=pl.id
          ORDER BY programlabelid";
          $qResult=\DB::select($sql);
          $result=collect($qResult);
          return $result;
     }
}
