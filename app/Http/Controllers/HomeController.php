<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('adminhome',['sidebarMenu'=>$sidebarMenu]);
    }
}
