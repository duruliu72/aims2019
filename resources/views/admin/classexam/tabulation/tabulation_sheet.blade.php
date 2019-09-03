@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet" media="all">
<link href="{{asset('clientAdmin/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper no-padding no-margin">
        <div class="row no-print">
          <div class="col-lg-12">
             <ol class="breadcrumb">
                <li>TABULATION SHEET</li>
                @if($msg!="")
                  <span style="float: right;font-size: 15px;">
                  {{ $msg }}
                  </span>
                @endif
                @if ($errors->any())
                <span style="float: right;font-size: 15px;">{{$errors->all()[0]}}</span>
                @endif
                @if(session()->has('msg'))
                <span style="float: right;font-size: 15px;">
                  {{ session()->get('msg') }}
                </span>
                @endif
                <button class="print-btn" onclick="Print()">Print</button>
            </ol>
          </div>
        </div>
        <div class="row no-margin">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body no-border no-padding">
                @if($programofferinfo==null)
                <div class="top_form">
                  <form action="{{URL::to('tabulation_sheet')}}" method="POST">
                  {{csrf_field()}}
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="sessionid">Session</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'session')" class="form-control" name="sessionid" id="sessionid">
                            <option  value="">SELECT</option>
                          @foreach ($sessionList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div> 
                      <label class="col-sm-2 control-label" for="programlabelid">Class Label</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'programlabel')" class="form-control" name="programlabelid" id="programlabelid">
                          <option value="">SELECT</option>
                          @foreach ($plabelList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>                   
                    </div>
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
                        <select onchange="getChange(this,'group')"  class="form-control" name="groupid" id="groupid">
                          <option value="">SELECT</option>
                          @foreach ($groupList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>                              
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="mstexamnameid">Exam</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="mstexamnameid" id="mstexamnameid">
                          <option value="">SELECT</option>
                          @foreach ($examNameList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <label class="col-sm-2 control-label" for="sectionid">Section</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="sectionid" id="sectionid">
                          <option value="">SELECT</option>
                          @foreach ($sectionList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>                           
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('tabulation_sheet')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                <div class="tabulation-sheet">
                  <div class="tabulation-sheet__heading">
                      <div class="institute-logo">
                        <img src="{{asset('clientAdmin/image/logo/')}}/{{Session::get('institutelogo')}}">
                      </div>
                      <div class="institute-title">
                        <h2 class="institute-name">{{Session::get("institute_name")}}</h2>
                        <p class="institute-add">{{sprintf("%s, %s, %s",Session::get("localgovName"),Session::get("thanaName"),Session::get("districtName"))}}</p>
                        <h3 class="std-transcript">TABULATION SHEET</h3>
                      </div>
                  </div>
                  <div class="tabulation-sheet__content">
                      <div class="tabulation-sheet__poinfo">
                        <ul>
                          <li>{{$programofferinfo->programName}}</li>
                          <li>{{$programofferinfo->mediumName}}</li>
                          <li>{{$programofferinfo->shiftName}}</li>
                          <li>{{$programofferinfo->groupName}}</li>
                          <li>{{$programofferinfo->sessionName}}</li>
                          <li>{{$programofferinfo->sessionName}}</li>
                          <li>{{$exam->name."' ".$programofferinfo->sessionName}}</li>
                        </ul>
                      </div>
                      <div class="tabulation-sheet__data">
                          <div class="ts-table_wrapper">
                            <table class="table table-bordered" style="width:100%;">
                              <thead>
                                  <tr>
                                    <th rowspan="2" colspan="1">SL</th>
                                    <th rowspan="2" colspan="1" width="500">Student Id<br/>Student Name</th>
                                    <th rowspan="2" colspan="1">Roll No</th>
                                    @foreach($courses as $course)
                                    <th colspan="{{count($course->categories)+1}}">{{sprintf("%s(%s)",$course->courseName,$course->courseCode)}}<br/>{{sprintf("(%s)",$course->coursemark)}}</th>
                                    @endforeach
                                    <th colspan="6">Total Result</th>
                                  </tr>
                                  <tr>
                                  @foreach($courses as $course)
                                    @foreach($course->categories as $cat)
                                    <th>{{$cat->name}}</th>
                                    @endforeach
                                    <th>Total.</th>
                                  @endforeach
                                    <th>Marks</th>
                                    <th>Obt Marks</th>
                                    <th>GP</th>
                                    <th>GL</th>
                                    <th>Fail Subject</th>
                                    <th>Position</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $id=0; ?>
                                @foreach($exam_result as $std)
                                <tr>
                                  <td>{{++$id}}</td>
                                  <td style="display: block;width: 150px;text-align: left;">{{$std->applicantid}}<br/>{{sprintf("%s %s %s",$std->firstName,$std->middleName,$std->lastName)}}</td>
                                  <td>{{$std->classroll}}</td>
                                  @foreach($std->m_courses as $mc)
                                    @foreach($mc->courses as $course)
                                      @foreach($course->categories as $cat)
                                        <td>{{$cat->round_std_obt_mark}}</td>
                                      @endforeach
                                      @if($course->course_pass_status==0)
                                      <td style="color:red;">{{$course->round_std_course_obt_mark}}</td>
                                      @else
                                      <td>{{$course->round_std_course_obt_mark}}</td>
                                      @endif
                                    @endforeach
                                  @endforeach
                                  <td>{{$std->common_marks}}</td>
                                  <td>{{$std->common_obt_marks}}</td>
                                  <td>{{$std->grade_point}}</td>
                                  <td>{{$std->grade_letter}}</td>
                                  <td>{{$std->common_fail_sub}}</td>
                                  <td>{{$std->class_position}}</td>
                                <tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                      </div>
                  </div>
                  <div class="tabulation-sheet__footer">
                      <p>Result generated by:   aims  ||  Powerd by:  www.adventure-soft.com</p>
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
<script src="{{asset('clientAdmin/js/tabulation_sheet.js')}}"></script>
<script src="{{asset('clientAdmin/js/print.js')}}"></script>
@endsection