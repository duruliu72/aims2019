@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row notprint">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>
              @if($institute!=null)
                {{$institute->name}}
              @else
                Dashboard
              @endif
            </h3>
             <ol class="breadcrumb">
                <li>All Applicants for Registration</li>
                @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                @endif
                @if(session()->has('msg'))
                <span style="float: right;font-size: 15px;">
                  {{ session()->get('msg') }}
                </span>
                @endif
                @if($msg!="")
                <span style="float: right;font-size: 15px;">
                  {{ $msg }}
                </span>
                @endif
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">
                <div class="top_form notprint">
                    <form action="{{URL::to('students')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="programid">Program</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                            <option  value="">SELECT</option>
                            @foreach ($programList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                           <option value="">SELECT</option>
                           @foreach ($mediumList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                           
                        </select>
                      </div>                  
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'shift')" class="form-control" name="shiftid" id="shiftid">
                          <option value="">SELECT</option>
                           @foreach ($shiftList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                        </select>
                      </div>
                      <label class="col-sm-2 control-label" for="groupid">Group</label>
                      <div class="col-sm-4">
                        <select  class="form-control" name="groupid" id="groupid">
                           <option value="">SELECT</option>
                          @foreach ($groupList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                        </select>
                      </div>                              
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('students')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($result))
                  <div class="printarea" id="printarea">
                    <div class="row print-row">
                      <div class="col-sm-12 print-col">
                         <div class="programinfo">
                            <div class="programinfo_item"><span>Session&nbsp:</span> <span>{{$result['programofferinfo']->sessionName}}</span></div>
                            <div class="programinfo_item"><span>Class&nbsp:</span> <span>{{$result['programofferinfo']->programName}}</span></div>
                            <div class="programinfo_item"><span>Group&nbsp:</span> <span>{{$result['programofferinfo']->groupName}}</span></div>
                            <div class="programinfo_item"><span>Medium&nbsp:</span> <span>{{$result['programofferinfo']->mediumName}}</span></div>
                            <div class="programinfo_item"><span>Shift&nbsp: </span> <span>{{$result['programofferinfo']->shiftName}}</span></div>
                         </div>
                      </div>
                    </div>
                    <div class="row print-row">
                    <form action="{{URL::to('students')}}" method="POST">
                      {{csrf_field()}}
                      <div class="col-sm-7 print-col">
                        <div class="applicant_info">
                            <input type="hidden" name="programofferid" value="{{$result['programofferinfo']->id}}">
                            <table>
                              <thead>
                                <tr>
                                  <th>SL NO</th>
                                  <th>Applicantid</th>
                                  <th>Name</th>
                                  <th>Merit</th>
                                  <th>Religion</th>
                                  <th width="80px;">Picture</th>
                                  <th width="100px">Class Roll</th>
                                  <th width="2%"><input id="applicantcheckid" type="checkbox"></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $i=0; ?>
                              @foreach($result['applicant_list'] as $applicant)
                                <tr>
                                  <td>{{++$i}}</td>
                                  <td>{{$applicant[0]->applicantid}}</td>
                                  <td>{{sprintf('%s %s %s',$applicant[0]->firstName,$applicant[0]->middleName,$applicant[0]->lastName)}}</td>
                                  <td>{{$applicant[2]}}</td>
                                  <td>{{$applicant[0]->religionName}}</td>
                                  <td style="margin:0px;padding:0px;"> <img style="width:80px;height:60px;" src="{{asset('clientAdmin/admission/student')}}/{{$applicant[0]->picture}}"></td>
                                  @if($applicant[1]->capplicantid!=0)
                                    <td>{{$applicant[1]->classroll}}</td>
                                    <td><span style='font-size:18px;'>&#10003;</span></td>
                                  @else
                                    <td><input type="text" class="form-control" name="classroll[{{$applicant[0]->applicantid}}]" id="classroll"></td>
                                    <td><input class="applicantcheck" type="checkbox" name="applicantcheck[{{$applicant[0]->applicantid}}]"></td>
                                  @endif
                                </tr>
                               @endforeach
                              </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="applicant_info">
                          <table class="table table-striped table-bordered table-hover customtable" id="studentcourse">
                              <thead>
                                  <tr>
                                      <th width="2%">#</th>
                                      <th>Course</th>
                                      <th>Course Type</th>
                                      <th width="2%"><input id="coursecheckid" type="checkbox"></th>
                                  </tr>
                              </thead>
                              <tbody>
                               <?php $id=0; ?>
                                @foreach($courseList as $course)
                                  <tr>
                                    <td>{{++$id}}</td>
                                    <td>{{$course->courseNameWithCode}}</td>
                                    <td>
                                        <select class="form-control" name="coursetypeid[{{$course->id}}]" id="coursetypeid">
                                        @foreach($courseTypeList as $x)
                                        <option value="{{$x->id}}">{{$x->name}}</option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td><input class="coursecheck" type="checkbox" name="coursecheck[{{$course->id}}]"></td>
                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
                          <div class="from-group row" style="margin-bottom:15px;">
                            <label class="col-sm-4 control-label" for="sectionid">Section</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="sectionid" id="sectionid">
                                  @foreach($sectionList as $x)
                                      <option value="{{$x->id}}">{{$x->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>
                          <div style="text-align:right;">
                             <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="save_btn" value="save_btn">Save</button>
                          </div>
                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
                @endif
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/student.js')}}"></script>
@endsection