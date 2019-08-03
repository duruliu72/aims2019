<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\InstituteLavel;
use App\com\adventure\school\basic\Division;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\basic\PostOffice;
use App\com\adventure\school\basic\LocalGov;
use App\com\adventure\school\basic\Address;
use App\com\adventure\school\program\PLevel;
class InstituteController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('institute');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('institute');
        $aInstitute=new Institute();
        $aList=$aInstitute->getAllInstitute();
        $dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'pList'=>$pList,
            'result'=>$aList
        ];
    	return view('admin.basic.institute.index',$dataList);
    }
    public function create(){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('institute');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('institute');
        if($pList[2]->id!=2){
            return redirect('error');
        }
    	$dataList=[
            'institute'=>Institute::getInstituteName(),
            'sidebarMenu'=>$sidebarMenu,
            'divisionList'=>Division::all(),
            'districtList'=>District::all(),
            'thanaList'=>Thana::all(),
            'postofficeList'=>PostOffice::all(),
            'localgovList'=>LocalGov::all(),
            'pLevel'=>PLevel::all()
        ];
        return view('admin.basic.institute.create',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
         'name' => 'required',
         ]);
        $institute_lavelList=$request->programlevelid;
        $aInstitute=new Institute();
        // $result=$aInstitute->getAllInstitute();
        // if($result->count()>0){
        //     $msg="Already Institute is Created. Please Update Your Institute Info";
        //     return redirect()->back()->with('msg',$msg);
        // }
        $aInstitute->ins_mobile_no=$request->ins_mobile_no;
     	$aInstitute->name=$request->name;
     	$aInstitute->institutetypeid=$request->institutetypeid;
        $aInstitute->categoryid=$request->categoryid;
        $aInstitute->subcategoryid=$request->subcategoryid;
        $aInstitute->wordno=$request->wordno;
        $aInstitute->cluster=$request->cluster;
        $aInstitute->ein=$request->eiin;
        $upload_logo = $request->file('institutelogo');
        if($upload_logo!=null){
            $explode_logo=explode('.',$upload_logo->getClientOriginalName());
            $extention=end($explode_logo);
            $imagename='institute_logo';
            $logo=$imagename.'.'.$extention;
            $destination=public_path('clientAdmin/image/logo');
            $upload_logo->move($destination,$logo);
            $aInstitute->institutelogo=$logo;
        }
        // ==========================
        $aAddress=new Address();
        $aAddress->divisionid=$request->divisionid;
        $aAddress->districtid=$request->districtid;
        $aAddress->thanaid=$request->thanaid;
        $aAddress->postofficeid=$request->postofficeid;
        $aAddress->postcode=$request->postcode;
        $aAddress->localgovid=$request->localgovid;
        $aAddress->address=$request->address;
        // dd($institute_lavelList);
        $status=\DB::transaction(function () use($aInstitute,$aAddress,$institute_lavelList){
            try{
                $aAddress->save();
                $lastadd=\DB::table('addresses')->orderBy('id', 'desc')->first();
                $aInstitute->addressid=$lastadd->id;
                $aInstitute->save();
                $last_institute=\DB::table('institutes')->orderBy('id', 'desc')->first();
               
                foreach($institute_lavelList as $ins_lavel){
                    $aInstituteLavel=new InstituteLavel();
                    $aInstituteLavel->instituteid=$last_institute->id;
                    $aInstituteLavel->programlevelid=$ins_lavel;
                    dd($institute_lavelList);
                    // $aInstituteLavel->save();
                }
                return true;
            }catch(\Exception $e){
                return false;
            }
        });
     	if($status){
     		$msg="Institute Created Successfully";
		  }else{
		    $msg="Institute not Created";
		}
     	return redirect()->back()->with('msg',$msg);
    }
    public function edit($id){
        $aMenu=new Menu();
        $hasMenu=$aMenu->hasMenu('institute');
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$aMenu->getSidebarMenu();
        $pList=$aMenu->getPermissionOnMenu('institute');
    	$aObj=Institute::findOrfail($id);
        $aInstitute=$aObj->getInstituteById($id);
        if($pList[3]->id==3){
        	$dataList=[
                'institute'=>Institute::getInstituteName(),
                'sidebarMenu'=>$sidebarMenu,
                'divisionList'=>Division::all(),
                'districtList'=>District::all(),
                'thanaList'=>Thana::all(),
                'postofficeList'=>PostOffice::all(),
                'localgovList'=>LocalGov::all(),
                'pLevel'=>PLevel::all(),
                'bean'=>$aInstitute,
            ];
           	return view('admin.basic.institute.edit',$dataList); 
       }else{
            return redirect('error');
       }
        
    }
    public function update(Request $request, $id){
     	$aInstitute=Institute::findOrfail($id);
     	$validatedData = $request->validate([
         'name' => 'required',
         ]);
        $aInstitute->name=$request->name;
        $aInstitute->institutetypeid=$request->institutetypeid;
        $aInstitute->categoryid=$request->categoryid;
        $aInstitute->subcategoryid=$request->subcategoryid;
        $aInstitute->wordno=$request->wordno;
        $aInstitute->cluster=$request->cluster;
        $aInstitute->ein=$request->eiin;
        $upload_logo = $request->file('institutelogo');
        if($upload_logo!=null){
            $explode_logo=explode('.',$upload_logo->getClientOriginalName());
            $extention=end($explode_logo);
            $imagename='institute_logo';
            $logo=$imagename.'.'.$extention;
            $destination=public_path('clientAdmin/image/logo');
            $upload_logo->move($destination,$logo);
            $aInstitute->institutelogo=$logo;
        }
        
// ==============================
        $aAddress=Address::findOrfail($aInstitute->addressid);
        $aAddress->divisionid=$request->divisionid;
        $aAddress->districtid=$request->districtid;
        $aAddress->thanaid=$request->thanaid;
        $aAddress->postofficeid=$request->postofficeid;
        $aAddress->postcode=$request->postcode;
        $aAddress->localgovid=$request->localgovid;
        $aAddress->address=$request->address;
        $status=\DB::transaction(function () use($aInstitute,$aAddress){
            $aAddress->update();
            return $aInstitute->update();
        });
        if($status){
            $msg="Institute Update Successfully";
          }else{
            $msg="Institute not Update";
        }
        return redirect()->back()->with('msg',$msg);
    }
         // For Ajax Call ===============
    //    ================================================================
   public function changeAddress(Request $request){
    $option=$request->option;
    $methodid=$request->methodid;
    $id=$request->id;
    if($option=="division"){
        if($methodid==1){
			$this->getDropDownValue("districts","divisionid",$id);
        }
    }elseif($option=="district"){
        if($methodid==1){
			$this->getDropDownValue("thanas","districtid",$id);
        }
    }elseif($option=="thana"){
        if($methodid==1){
			$this->getDropDownValue("postoffices","thanaid",$id);
        }elseif($methodid==2){
			$this->getDropDownValue("localgovs","thanaid",$id);
		}
	}
}
private function getDropDownValue($tableName,$conditionid,$id){
    $aAddress=new Address();
    $result=$aAddress->getDropDownValue($tableName,$conditionid,$id);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
}