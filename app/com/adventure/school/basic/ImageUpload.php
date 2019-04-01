<?php

namespace App\com\adventure\school\basic;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $table='imageupload';
    public $timestamps = false;
   	protected $fillable = ['name','imageurl'];
}
