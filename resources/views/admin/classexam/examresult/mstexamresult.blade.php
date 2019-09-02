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
                <li>Academic Result</li>
                @if($msg!="")
                  <span class="msg">
                  {{ $msg }}
                  </span>
                @endif
                @if ($errors->any())
                <span class="msg">{{$errors->all()[0] }}</span>
                @endif
                @if(session()->has('msg'))
                <span class="msg">
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
                @if($exam_result==null)
                <div class="top_form">
                    <form action="{{URL::to('mstexamresult')}}" method="POST">
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
                      <select  class="form-control" name="groupid" id="groupid">
                         <option value="">SELECT</option>
                         @foreach ($groupList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                              
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-2 control-label" for="examnameid">Exam</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="examnameid" id="examnameid">
                         <option value="">SELECT</option>
                         @foreach ($examNameList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                           
                  </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search Student</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('mstexammarkentry')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                <div class="academic-result">
                  <div class="academic-transcript__heading academic-result__heading">
                      <div class="institute-logo">
                        <img src="{{asset('clientAdmin/image/logo/institute_logo.png')}}">
                      </div>
                      <div class="institute-title">
                        <h2 class="institute-name">{{$instituteObj->name}}</h2>
                        <p class="institute-add">{{sprintf("%s, %s, %s",$instituteObj->localgovName,$instituteObj->thanaName,$instituteObj->districtName)}}</p>
                        <h3 class="std-transcript">STUDENT POSITION LIST</h3>
                        <h3 class="exam-name">{{$exam->name}}</h3>
                      </div>
                  </div>
                </div>
                <div class="programofferinfo">
                    <div class="programofferinfo_item">
                        <span>Session: {{$programofferinfo->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class: {{$programofferinfo->programName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Medium: {{$programofferinfo->mediumName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Shift: {{$programofferinfo->shiftName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Group: {{$programofferinfo->groupName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Exam: {{$exam->name}}</span>
                    </div>
                </div>
                <div class="mst_result">
                  <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>SL.</th>
                          <th>StudentID</th>
                          <th>Student Name</th>
                          <th>Roll No</th>
                          <th>Full Marks</th>
                          <th>Obtain Marks</th>
                          <th>GPA</th>
                          <th>Grade Letter</th>
                          <th>Class Position</th>
                          <th>Section Position</th>
                          <th class="no-print">Print</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $id=0; ?>
                        @foreach($exam_result as $item)
                          <tr>
                            <td>{{++$id}}</td>
                            <td>{{$item->applicantid}}</td>
                            <td>{{sprintf("%s %s %s",$item->firstName,$item->middleName,$item->lastName)}}</td>
                            <td>{{$item->classroll}}</td>
                            <td>{{$item->common_marks}}</td>
                            <td>{{sprintf('%.0f',$item->common_obt_marks)}}</td>
                            <td>{{sprintf("%.2f",$item->grade_point)}}</td>
                            @if($item->student_pass_status)
                            <td>{{$item->grade_letter}}</td>
                            @else
                            <td style="color:red;">{{$item->grade_letter}}</td>
                            @endif
                            <td>{{$item->class_position}}</td>
                            <td>{{$item->section_position}}</td>
                            <td class="no-print"><a target="_blank" href="{{URL::to('/mstexamresult')}}/{{$programofferinfo->id}}/{{$exam->id}}/{{$item->studentid}}">Print</a></td>
                          </tr>
                        @endforeach
                      <tbody>
                  </table>
                <div>
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
<script src="{{asset('clientAdmin/js/examresult.js')}}"></script>
<script src="{{asset('clientAdmin/js/print.js')}}"></script>
@endsection