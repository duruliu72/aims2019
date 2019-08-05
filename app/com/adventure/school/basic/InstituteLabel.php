<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class InstituteLabel extends Model
{
    protected $table='institute_labels';
    protected $fillable = ['instituteid','programlabelid','status'];
    public function getLabelsOnInstitueid($instituteid){
        $sql="SELECT plabels.*,
        IFNULL(insl_table.programlabelid,0) AS programlabelid
        FROM plabels
        LEFT JOIN(SELECT * FROM `institute_labels`
        WHERE instituteid=?) AS insl_table ON plabels.id=insl_table.programlabelid";
        $qresult=\DB::select($sql,[$instituteid]);
		$result=collect($qresult);
		return $result;
    }
}
