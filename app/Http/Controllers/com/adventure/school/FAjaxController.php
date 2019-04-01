<?php

namespace App\Http\Controllers\com\adventure\school;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\admission\AdmissionProgram;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\basic\PostOffice;
use App\com\adventure\school\basic\LocalGov;
class FAjaxController extends Controller
{
    public function getFValue(Request $request){
    	$option=$request->option;
	  	$idvalue=$request->idvalue;
	    $methodid=$request->methodid;
	    if($option=="divisionToDistrict"){
            // For present Address
            if($methodid==1){
                $this->getAllDistrictOnDivision($idvalue);
            }elseif($methodid==2){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==3){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==4){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="districtToThana"){
            if($methodid==1){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==2){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==3){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="thanaToPostofficeandlocalgov"){
            if($methodid==1){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==2){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="divisionToDistrict2"){
             // For permanent Address
            if($methodid==1){
                $this->getAllDistrictOnDivision($idvalue);
            }elseif($methodid==2){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==3){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==4){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="districtToThana2"){
            if($methodid==1){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==2){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==3){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="thanaToPostofficeandlocalgov2"){
            if($methodid==1){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==2){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="g_divisionToDistrict"){
             // For Guardian Address
            if($methodid==1){
                $this->getAllDistrictOnDivision($idvalue);
            }elseif($methodid==2){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==3){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==4){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="g_districtToThana"){
            if($methodid==1){
                $this->getAllThanaOnDistrict($idvalue);
            }elseif($methodid==2){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==3){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }elseif($option=="g_thanaToPostofficeandlocalgov"){
            if($methodid==1){
                $this->getAllPostOfficeOnThana($idvalue);
            }elseif($methodid==2){
                $this->getAllLocalGovOnThana($idvalue);
            }
         }
    }

    private function getAllFGroup($programid){
    	$aAdmissionProgram=new AdmissionProgram();
    	$result=$aAdmissionProgram->getAllGroup(0,$programid);
    	$output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllMediumOnProgram($programid){
    	$aAdmissionProgram=new AdmissionProgram();
    	$result=$aAdmissionProgram->getAllMediumOnProgram(0,$programid);
    	$output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllShiftOnProgram($programid){
    	$aAdmissionProgram=new AdmissionProgram();
    	$result=$aAdmissionProgram->getAllShiftOnProgram(0,$programid);
    	$output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllDistrictOnDivision($divisionid){
        $aDistrict=new District();
        $result=$aDistrict->getAllDistrictOnDivision($divisionid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllThanaOnDistrict($districtid){
        $aThana=new Thana();
        $result=$aThana->getAllThanaOnDistrict($districtid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllPostOfficeOnThana($thanaid){
        $aPostOffice=new PostOffice();
        $result=$aPostOffice->getAllPostOfficeOnThana($thanaid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
    private function getAllLocalGovOnThana($thanaid){
        $aLocalGov=new LocalGov();
        $result=$aLocalGov->getAllLocalGovOnThana($thanaid);
        $output="<option value=''>SELECT</option>";
        foreach($result as $x){
           $output.="<option value='$x->id'>$x->name</option>";
        }
        echo  $output;
    }
}
