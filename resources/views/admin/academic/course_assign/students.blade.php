@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li> Assign Subject Information</li>
              @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!=null)
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
                @if(!isset($programofferinfo))
                <div class="top_form">
                    <form action="{{URL::to('editassigncourse')}}" method="POST">
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
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('courseoffercreate')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                  <div class="programofferinfo pmb ">
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
                </div>
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Applicant Id</th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th>Roll No</th>
                            <th>Common</th>
                            <th>Group Main</th>
                            <th>Optional</th>
                            <th>Extra</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id=1; ?>
                        @foreach($students as $std)
                        <tr>
                            <td>{{$id++}}</td>
                            <td>{{$std->applicantid}}</td>
                            <td>{{$std->r_studentid}}</td>
                            <td>{{sprintf("%s %s %s",$std->firstName,$std->middleName,$std->lastName)}}</td>
                            <td>{{$std->classroll}}</td>
                            <td>
                              @foreach($std->courses as $course)
                                @if($course->coursetypeid!=null && $course->coursetypeid==1)
                                  {{$course->courseCode}}
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($std->courses as $course)
                                @if($course->coursetypeid!=null && $course->coursetypeid==4)
                                  {{$course->courseCode}}
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($std->courses as $course)
                                @if($course->coursetypeid!=null && $course->coursetypeid==2)
                                  {{$course->courseCode}}
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($std->courses as $course)
                                @if($course->coursetypeid!=null && $course->coursetypeid==3)
                                  {{$course->courseCode}}
                                @endif
                              @endforeach
                            </td>
                            <td>
                                <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red" style="color:green">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                    </span>
                                </a>
                                <a target="_bladk" href="{{URL::to('/editassigncourse')}}/{{$std->programofferid}}/{{$std->sectionid}}/{{$std->id}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green" style="color:blue">
                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                    </span>
                                </a>
                                <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red" style="color:red">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>SL NO</th>
                          <th>Applicant Id</th>
                          <th>Student Id</th>
                          <th>Student Name</th>
                          <th>Roll No</th>
                          <th>Common</th>
                          <th>Group Main</th>
                          <th>Optional</th>
                          <th>Extra</th>
                          <th>action</th>
                        </tr>
                    </tfoot>
                </table>
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
<script src="{{asset('clientAdmin/js/studentlist.js')}}"></script>
@endsection