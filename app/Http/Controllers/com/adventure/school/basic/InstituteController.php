<?php

namespace App\Http\Controllers\com\adventure\school\basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\com\adventure\school\menu\Menu;
use App\com\adventure\school\basic\Institute;
use App\com\adventure\school\basic\InstituteLabel;
use App\com\adventure\school\basic\Division;
use App\com\adventure\school\basic\District;
use App\com\adventure\school\basic\Thana;
use App\com\adventure\school\basic\PostOffice;
use App\com\adventure\school\basic\LocalGov;
use App\com\adventure\school\basic\Address;
use App\com\adventure\school\program\PLabel;
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
        $aInstitute=new Institute();
        $instituteObj=$aInstitute->getInstituteById(1);
        // dd($instituteObj);
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
            'pLevel'=>PLabel::all()
        ];
        return view('admin.basic.institute.create',$dataList);
    }
    public function store(Request $request){
     	$validatedData = $request->validate([
         'name' => 'required',
         ]);
        $institute_labelList=$request->programlabelid;
        $aInstitute=new Institute();
        $result=$aInstitute->getAllInstitute();
        if($result->count()>0){
            $msg="Already Institute is Created. Please Update Your Institute Info";
            return redirect()->back()->with('msg',$msg);
        }
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
        // dd($institute_labelList);
        $status=\DB::transaction(function () use($aInstitute,$aAddress,$institute_labelList){
            try{
                if($institute_labelList!=null){
                    $aAddress->save();
                    $lastadd=\DB::table('addresses')->orderBy('id', 'desc')->first();
                    $aInstitute->addressid=$lastadd->id;
                    $aInstitute->save();
                    $last_institute=\DB::table('institutes')->orderBy('id', 'desc')->first();
                    foreach($institute_labelList as $programlabelid){
                        $aInstituteLabel=new InstituteLabel();
                        $aInstituteLabel->instituteid=$last_institute->id;
                        $aInstituteLabel->programlabelid=$programlabelid;
                        $aInstituteLabel->save();
                    }
                }else{
                    return false;
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
        if($pList[3]->id!=3){
            return redirect('error');
        }
        $aInstituteLabel=new InstituteLabel();
        $plavelList=$aInstituteLabel->getLabelsOnInstitueid($id);
        $dataList=[
        'institute'=>Institute::getInstituteName(),
        'sidebarMenu'=>$sidebarMenu,
        'divisionList'=>Division::all(),
        'districtList'=>District::all(),
        'thanaList'=>Thana::all(),
        'postofficeList'=>PostOffice::all(),
        'localgovList'=>LocalGov::all(),
        'pLevel'=>$plavelList,
        'bean'=>$aInstitute,
        ];
        return view('admin.basic.institute.edit',$dataList); 
    }
    public function update(Request $request, $id){
     	$aInstitute=Institute::findOrfail($id);
     	$validatedData = $request->validate([
         'name' => 'required',
         ]);
        $institute_labelList=$request->programlabelid;
        // dd($institute_labelList);
        $aInstitute->name=$request->name;
        $aInstitute->ins_mobile_no=$request->ins_mobile_no;
        $aInstitute->contact_person=$request->contact_person;
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
        $status=\DB::transaction(function () use($id,$aInstitute,$aAddress,$institute_labelList){
            try{
                if($institute_labelList!=null){
                    $aAddress->update();
                    $aInstitute->update();
                    \DB::table('institute_labels')
                        ->where('instituteid', $id)
                        ->delete();
                    foreach($institute_labelList as $programlabelid){
                        $aInstituteLabel=new InstituteLabel();
                        $aInstituteLabel->instituteid=$id;
                        $aInstituteLabel->programlabelid=$programlabelid;
                        $aInstituteLabel->save();
                    }
                    return true;
                }else{
                    return false;
                }
            }catch(\Exception $e){
                \DB::rollback();
                return false;
            }
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
    $divisonid=$request->divisonid;
    $districtid=$request->districtid;
    $thanaid=$request->thanaid;
    if($option=="division"){
        if($methodid==1){
			$this->getDropDownValue($divisonid,"districts","divisionid");
        }elseif($methodid==2){
            $this->getDropDownValue(0,"thanas","districtid");
        }elseif($methodid==3){
            $this->getDropDownValue(0,"localgovs","thanaid");
        }elseif($methodid==4){
            $this->getDropDownValue(0,"postoffices","thanaid");
        }
    }elseif($option=="district"){
        if($methodid==2){
			$this->getDropDownValue($districtid,"thanas","districtid");
        }elseif($methodid==3){
            $this->getDropDownValue(0,"localgovs","thanaid");
        }elseif($methodid==4){
            $this->getDropDownValue(0,"postoffices","thanaid");
        }
    }elseif($option=="thana"){
        if($methodid==3){
            $this->getDropDownValue($thanaid,"localgovs","thanaid");
        }elseif($methodid==4){
			$this->getDropDownValue($thanaid,"postoffices","thanaid");
		}
	}
}
private function getDropDownValue($conditionid,$tableName,$conditionField){
    $aAddress=new Address();
    $result=$aAddress->getDropDownValue($conditionid,$tableName,$conditionField);
    $output="<option value=''>SELECT</option>";
    foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
    }
    echo  $output;
}
}