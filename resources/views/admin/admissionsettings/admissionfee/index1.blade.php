@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <a style="position: absolute;top: 25px;right: 50px;" href="{{URL::to('/admissionfee')}}">Refresh</a>
             <!--  <li><a href="{{URL::to('/admissionprogram')}}">All</a></li>
              <li>Admission Program</li> -->
              @if ($errors->any())
                   <ol class="breadcrumb">
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                   </ol>
              @endif
              @if(session()->has('msg'))
              <ol class="breadcrumb">
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              </ol>
              @endif
           
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <section class="panel">
              <div class="panel-body">
                @if($aObj==null)
                <form action="{{URL::to('admissionfee/pay')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="applicantid">Applicant Id</label>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" name="applicantid" id="applicantid" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                       <button type="submit" class="btn btn-default" name="find" value="find">Find</button>
                    </div>                           
                  </div>
                </form>
                @else
                <div class="applicant-info">
                    <div class="applicant_desc">
                        <div class="photo">
                          <img src="{{asset('clientAdmin/image/picture')}}/{{$aObj->picture}}">
                        </div>
                        <div class="info">
                            <table>
                                <tr>
                                    <td>Id <span>:</span></td>
                                    <td>{{$aObj->applicantid}}</td>
                                </tr>
                                <tr>
                                    <td>Name <span>:</span></td>
                                    <td>{{$aObj->name}}</td>
                                </tr>
                                <tr>
                                    <?php $dob=date("d/m/Y", strtotime($aObj->dob)) ?>
                                    <td>Date Of Birth <span>:</span></td>
                                    <td>{{$dob}}</td>
                                </tr>
                                <tr>
                                    <td>Gender <span>:</span></td>
                                    <td>{{$aObj->genderName}}</td>
                                </tr>
                                <tr>
                                    <td>Reigion <span>:</span></td>
                                    <td>{{$aObj->religionName}}</td>
                                </tr>
                                <tr>
                                    <td>Blood Group <span>:</span></td>
                                    <td>{{$aObj->bloodgroupName}}</td>
                                </tr>
                                <tr>
                                    <td>Payment Status <span>:</span></td>
                                    <td>{{$aObj->statement}}</td>
                                </tr>
                                <tr>
                                    <td>Payment Amount <span>:</span></td>
                                    <td>{{$aObj->amount}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="classinfo">
                            <table>
                                  <tr>
                                    <td>Class <span>:</span></td>
                                    <td>{{$aObj->programName}}</td>
                                </tr>
                                <tr>
                                    <td>Group <span>:</span></td>
                                    <td>{{$aObj->groupName}}</td>
                                </tr>
                                <tr>
                                    <td>Shift <span>:</span></td>
                                    <td>{{$aObj->shiftName}}</td>
                                </tr>
                                 <tr>
                                    <td>Session <span>:</span></td>
                                    <td>{{$aObj->sessionName}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <form action="{{URL::to('admissionfee/pay')}}" method="POST" class="right-part">
                  {{csrf_field()}}
                  <div class="form-group row">
                    <input type="hidden" name="programofferid" value="{{$aObj->programofferid}}">
                    <input type="hidden" name="applicantid" value="{{$aObj->applicantid}}">
                    <label class="col-md-3 control-label" for="amount">Admission Fee</label>
                    <div class="col-md-7">
                       <input type="text" class="form-control" name="amount" id="amount">
                    </div>
                    <div class="col-md-2">
                       <button type="submit" class="btn btn-default" name="save" value="save">Save</button>
                    </div>                           
                  </div>
                </form>
                @endif
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection