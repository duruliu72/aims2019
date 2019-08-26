<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\com\adventure\school\basic\Institute;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }
    protected function authenticated(Request $request, $user)
    {
      $instituteName="Dashboard";
      $postOfficeName="";
      $localgovName="";
      $thanaName="";
      $districtName="";
      $divisionName="";
      $institutelogo="school-logo.png";
      $aInstitute=new Institute();
      $instituteObj=$aInstitute->getInstituteById(1);
      if($instituteObj!=null){
        $instituteName=$instituteObj->name;
        $postOfficeName=$instituteObj->postOfficeName;
        $localgovName=$instituteObj->localgovName;
        $thanaName=$instituteObj->thanaName;
        $districtName=$instituteObj->districtName;
        $divisionName=$instituteObj->divisionName;
        $institutelogo=$instituteObj->institutelogo;
      }
      session(["institute_name"=>$instituteName]);
      session(["postOfficeName"=>$postOfficeName]);
      session(["localgovName"=>$localgovName]);
      session(["thanaName"=>$thanaName]);
      session(["districtName"=>$districtName]);
      session(["divisionName"=>$divisionName]);
      session(["institutelogo"=>$institutelogo]);
    }
}
