<?php

namespace App\com\adventure\school\role;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table='role_user';
    public $timestamps = false;
    protected $fillable = ['roleid','userid'];
}
