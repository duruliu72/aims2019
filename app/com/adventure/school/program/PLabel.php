<?php

namespace App\com\adventure\school\program;

use Illuminate\Database\Eloquent\Model;
use App\com\adventure\school\program\LabelGroup;
class PLabel extends Model
{
    protected  $table='plabels';
    protected $fillable = ['name','status'];
    public function getPLabels(){
        $pLabelList=PLabel::all();
        $aLabelGroup=new LabelGroup();
        foreach($pLabelList as $pl){
            $groupList=$aLabelGroup->getGroupsOnLabel($pl->id,"INNER");
            $pl->groupList=$groupList;
        }
        return $pLabelList;
    }

}
