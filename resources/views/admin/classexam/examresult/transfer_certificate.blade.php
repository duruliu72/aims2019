@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet" media="all">
<link href="{{asset('clientAdmin/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        @if($student!=null)
        <div class="row no-print">
          <div class="col-lg-12">
            <button class="print-btn tc-top" onclick="Print()">Print</button>
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-lg-12">
            <section class="transfer_certificate_wrapper">
            @if($programofferinfo==null)
              <div class="transfer_certificate">
                <form action="{{URL::to('transfer_certificate')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-4 control-label" for="applicantid">Applicant ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="applicantid" id="applicantid">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 control-label" for="pin_code">Pin Code</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="pin_code" id="pin_code">
                    </div>
                  </div>
                  <div class="tc-group float-right">
                  <span class="tc-msg">{{$msg}}</span> 
                  <button type="submit" class="btn btn-default c_btn" name="create" value="create">Create</button>
                  </div>
                </form>
              </div>
            @else
            <div class="tc-envelope">
              <div class="institute-info">
                <div class="institute-title">
                  <h2 class="institute-name">{{$instituteObj->name}}</h2>
                  <p class="institute-add">{{sprintf("%s, %s, %s",$instituteObj->localgovName,$instituteObj->thanaName,$instituteObj->districtName)}}</p>
                </div>
                <div class="institute-logo">
                  <img src="{{asset('clientAdmin/image/logo/institute_logo.png')}}">
                </div>
              </div>
              <div class="tc_heading">
                <h2 class="tc-headline">Transfer Certificate</h2>
                <div class="tc-serial">
                  <p>Serial No. 9103</p>
                </div>
                <div class="tc-date">
                  <p>Date:02/07/2019</p>
                </div>
              </div>
              <div class="tc-desc">
                <p class="tc-para">This is to consenting that {{sprintf("%s %s %s",$student->firstName,$student->middleName,$student->lastName)}}, ID-{{$student->applicantid}} @if($student->genderName=="Male") daughter @else son @endif of {{$student->fatherName}} & {{$student->motherName}} of Village ______________ .@if($student->genderName=="Male") She @else He @endif had been studying in this school. @if($student->genderName=="Male") Her @else His @endif date of birth
                    is {{$student->dob}} (as per description of admission book).@if($student->genderName=="Male") she @else he @endif had been studying in this school. @if($student->genderName=="Male") She @else He @endif has been reading in {{$programofferinfo->programName}} ,Session-{{$programofferinfo->sessionName}}, Group-{{$programofferinfo->groupName}} 
                    of this school and @if($student->genderName=="Male") She @else He @endif had been studying in this school. @if($student->genderName=="Male") She @else He @endif was passed the TEST. All the dues from him was recived with understanding up to the 
                    dated month of 17-06-2019.
                </p>
                <p class="tm">@if($student->genderName=="Male") Her @else His @endif moral characher : Good</p>
                <p class="tm">Behavior: Good</p>
                <p class="tm"> Progress: Saisfactory</p>
                <p class="tm bt-space">Cause of leaving the school: Change of residence</p>
                <p class="tm">I wish all @if($student->genderName=="Male") her @else his @endif Success in Life.</p>
              </div>
              <div class="tc-auth">
                  <div class="tc-auth_item tc-auth_headmster">
                    <p>Head master Signature Kishoreganj high school</p>
                    <p>akhra Bazar , Kisherganj Sadar</p>
                  </div>
              </div>
            </div>
            @endif
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/print.js')}}"></script>
@endsection