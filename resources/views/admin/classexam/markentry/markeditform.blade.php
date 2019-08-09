@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <ol class="breadcrumb">
                <li>Mark Entry Form</li>
                @if($msg!="")
                  <span style="float: right;font-size: 15px;">
                  {{ $msg }}
                  </span>
                @endif
                @if ($errors->any())
                <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                @endif
                @if(session()->has('msg'))
                <span style="float: right;font-size: 15px;">
                  {{ session()->get('msg') }}
                </span>
                @endif
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">
                <div class="top_form">
                    <form action="{{URL::to('mstexammarkedit')}}" method="POST">
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
                     <label class="col-sm-2 control-label" for="sectionid">Section</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="sectionid" id="sectionid">
                         <option value="">SELECT</option>
                         @foreach ($sectionList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="mstexamnameid">Exam</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'mstexamedit')" class="form-control" name="mstexamnameid" id="mstexamnameid">
                         <option value="">SELECT</option>
                         @foreach ($examNameList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                            
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 control-label" for="courseid">Subject</label>
                      <div class="col-sm-4">
                        <select  class="form-control" name="courseid" id="courseid">
                          <option value="">SELECT</option>
                          @foreach ($courseList as $x)
                            <option value="{{$x->id}}">{{sprintf('%s %s%s%s',$x->courseName,'(',$x->courseCode,')')}}</option>
                          @endforeach
                        </select>
                      </div>                        
                  </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('mstexammarkentry')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($programofferinfo))
                <div class="programofferinfo">
                    <div class="programofferinfo_item">
                        <span>Session: {{$programofferinfo->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class Level: {{$programofferinfo->programLabel}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class: {{$programofferinfo->programName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Medium: {{$programofferinfo->mediumName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Group: {{$programofferinfo->groupName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Shift: {{$programofferinfo->shiftName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Section: {{$section->name}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Subject: {{sprintf('%s %s%s%s',$course->courseName,'(',$course->courseCode,')')}}</span>
                    </div>
                </div>
                <div class="bottom_form markentry-form">
                  <form action="{{URL::to('mstexammarkedit')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="programofferid" value="{{$programofferinfo->id}}">
                    <input type="hidden" name="sectionid" value="{{$section->id}}">
                    <input type="hidden" name="courseid" value="{{$course->id}}">
                    <input type="hidden" name="mstexamnameid" value="{{$exam->id}}">
                    <div class="row">
                      <div class="col-sm-12">
                        <table class="table table-striped table-bordered table-hover customtable" id="markentry">
                          <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th>Student Name</th>
                              <th>Class Roll</th>
                              @foreach($mark_catList as $x)
                              <th>{{$x->name}}(<span class="categorymarks">{{$x->cat_hld_mark}}</span>)</th>
                              @endforeach
                              <th width="2%"><input id="markcheckid" type="checkbox"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $id=0; ?>
                            @foreach($studentList as $student)
                            <tr>
                              <td>{{++$id}}</td>
                              <td>{{sprintf('%s %s %s',$student->firstName,$student->middleName,$student->lastName)}}</td>
                              <td>{{$student->classroll}}</td>
                              @if($student->studentid==0)
                                @foreach($mark_catList as $y)
                                  <td class="id1"><input class="form-control" type="text" name="marks[{{$student->id}}][{{$y->id}}]" /></td>
                                @endforeach
                                <td><input class="markcheck" type="checkbox" name="checkbox[{{$student->id}}]"></td>
                              @else
                              @foreach($student->markList as $y)
                                <td>{{$y->marks}}</td>   
                              @endforeach
                              <td><span style='font-size:18px;'>&#10003;</span></td> 
                              @endif
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="save_btn" value="save_btn">Save</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('mstexammarkentry')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
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
<script src="{{asset('clientAdmin/js/markentry.js')}}"></script>
@endsection