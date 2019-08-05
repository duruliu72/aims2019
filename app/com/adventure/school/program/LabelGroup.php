<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class LabelGroup extends Model
{
    protected $table="label_groups";
    protected $fillable = ['programlabelid','groupid','status'];
    public function getGroupsOnLabel($programlabelid,$join){
        $sql="SELECT groups.*,
        IFNULL(lg_table.groupid,0) AS groupid
        FROM groups
        ".$join." JOIN (SELECT 
        lg.programlabelid,
        lg.groupid,
        plabels.name AS programLabel
        FROM `label_groups` AS lg
        INNER JOIN plabels ON lg.programlabelid=plabels.id
        WHERE lg.programlabelid=?) AS lg_table
        ON groups.id=lg_table.groupid";
        $qResult=\DB::select($sql,[$programlabelid]);
		$result=collect($qResult);
		return $result;
    }
}
