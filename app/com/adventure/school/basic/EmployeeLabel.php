<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class EmployeeLabel extends Model
{
    protected $table='employee_labels';
    protected $fillable = ['employeeid','programlabelid','status'];
    public function getLabels($employeeid){
        $sql="SELECT plabels.*,
        IFNULL(programlabelid,0) AS programlabelid
        FROM `plabels`
        LEFT JOIN (SELECT * FROM `employee_labels`
        WHERE employeeid=?) AS el ON plabels.id=el.programlabelid
        ORDER BY plabels.id";
        $qResult=\DB::select($sql,[$employeeid]);
        $result=collect($qResult);
        return $result;
    }
}
