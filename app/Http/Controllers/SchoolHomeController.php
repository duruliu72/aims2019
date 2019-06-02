<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\com\adventure\school\basic\Institute;

class SchoolHomeController extends Controller
{
    public function index(){
        $dataList=[
            'institute'=>Institute::getInstituteName(),
        ];
        return view('school.home',$dataList);
    }
}
