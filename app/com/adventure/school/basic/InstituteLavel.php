<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class InstituteLavel extends Model
{
    protected $table='institute_lavel';
    protected $fillable = ['instituteid','programlevelid','categoryid','status'];
}
