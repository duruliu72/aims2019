<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\menu\Menu;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $aMenu=new Menu();
        $sidebarMenu=$aMenu->getSidebarMenu();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu
        ];
        return view('adminhome',$dataList);
    }
}
