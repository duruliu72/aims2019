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
              <div class="panel-body no-border">
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
                                    <th rowspan="2" colspan="1">Student Id</th>
                                    <th rowspan="2" colspan="1" width="500">Student Name</th>
                                    <th rowspan="2" colspan="1">Roll No</th>
                                    @foreach($courses as $course)
                                    <th colspan="{{count($course->categories)+1}}">{{$course->courseName}}</th>
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
                                  <td>{{$std->applicantid}}</td>
                                  <td style="display: block;width: 150px;text-align: left;">{{sprintf("%s %s %s",$std->firstName,$std->middleName,$std->lastName)}}</td>
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
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/examresult.js')}}"></script>
<script src="{{asset('clientAdmin/js/print.js')}}"></script>
@endsection