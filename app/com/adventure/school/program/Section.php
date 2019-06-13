<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table="sections";
    protected $fillable = ['name','status'];
    public function getSection($id){
        $sql="SELECT * FROM `sections`
        WHERE id=?";
        $qResult=\DB::select($sql,[$id]);
        $section=collect($qResult)->first();
        return $section;
    }
}
