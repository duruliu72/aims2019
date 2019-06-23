@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>
            @if($institute!=null)
              {{$institute->name}}
            @else
              Dashboard
            @endif</h3>
             <ol class="breadcrumb">
                <li>Academic Result</li>
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
                @if($exam_result==null)
                <div class="top_form">
                    <form action="{{URL::to('mstexammarkentry')}}" method="POST">
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
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('mstexammarkentry')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @else
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
                          <th>Print</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $id=0; ?>
                        @foreach($exam_result as $item)
                          <tr>
                            <td>{{++$id}}</td>
                            <td>{{$item->applicantid}}</td>
                            <td>{{sprintf("%s%s%s",$item->firstName,$item->middleName,$item->lastName)}}</td>
                            <td>{{$item->classroll}}</td>
                            <td>{{$item->grand_courses_marks}}</td>
                            <td>{{$item->grand_obt_marks}}</td>
                            <td>{{$item->tot_gradepoint}}</td>
                            <td>{{"A"}}</td>
                            <td>{{$id}}</td>
                            <td><a href="">Print</a></td>
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
@endsection