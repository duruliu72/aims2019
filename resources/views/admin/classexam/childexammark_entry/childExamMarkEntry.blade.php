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
            @endif
      </h3>
        <ol class="breadcrumb">
              <li>Child Exam Mark Entry </li>
              @if($pList[2]->id==2)
              @endif
              @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!='')
              <span style="float: right;font-size: 15px;">
                {{ $msg }}
              </span>
              @endif
          </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel margin-bottom-zero">
          <div class="child-exam-mark-entry-wrapper">
            @if($programofferinfo==null)
              <div class="child-exam-mark-entry-item">
                <form action="{{URL::to('childexammarkentry')}}" method="POST">
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
                        <option  value="">SELECT</option>
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
                        <option  value="">SELECT</option>
                        @foreach ($shiftList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="groupid">Group</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                      <option  value="">SELECT</option>
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
                          <option  value="">SELECT</option>
                          @foreach ($sectionList as $x)
                              <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>                
                  </div>
                  <div style="text-align:right;">
                    <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn_next" value="btn_next">Next</button>
                  </div>
                </form>
              </div>
            @else
              <div class="child-exam-mark-entry-item">
                <div class="programofferinfo child-exam-mark-entry-item__m-bottom">
                    <div class="programofferinfo_item">
                        <span>Session: {{$programofferinfo->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class Level: {{$programofferinfo->levelName}}</span>
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
                        <span>Shift: {{$section->name}}</span>
                    </div>
                </div>
                <form action="{{URL::to('childexammarkentry')}}" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="programofferid" value="{{$programofferinfo->id}}">
                  <input type="hidden" name="sectionid" value="{{$section->id}}">
                  <div class="form-group row">
                      <label class="col-sm-2 control-label" for="mst_examnameid">Master Exam</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="mst_examnameid" id="mst_examnameid">
                          <option  value="">SELECT</option>
                          @foreach ($masterExamNameList as $x)
                              <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <label class="col-sm-2 control-label" for="child_examnameid">Child Name</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="child_examnameid" id="child_examnameid">
                          <option  value="">SELECT</option>
                          @foreach ($childExamNameList as $x)
                              <option value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                        </select>
                      </div>                
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 control-label" for="coursecodeid">Subject</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="coursecodeid" id="coursecodeid">
                          <option  value="">SELECT</option>
                          @foreach ($courseList as $x)
                              <option value="{{$x->id}}">{{sprintf("%s%s%s%s",$x->courseName,"(",$x->courseCode,")")}}</option>
                          @endforeach
                        </select>
                      </div>                
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <table class="table table-striped table-bordered table-hover customtable">
                        <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th>Student Name</th>
                              <th>Applicant Id</th>
                              <th>Class Roll</th>
                              <th>Marks</th>
                              <th width="2%"><input id="markcheckid" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $id=0; ?>
                          @foreach($studentList as $student)
                            <tr>
                              <td>{{++$id}}</td>
                              <td>{{sprintf('%s %s %s',$student->firstName,$student->middleName,$student->lastName)}}</td>
                              <td>{{$student->applicantid}}</td>
                              <td>{{$student->classroll}}</td>
                              <td class="id1"><input class="form-control" type="text" name="obt_marks[{{$student->id}}]" /></td>
                              <td><input class="markcheck" type="checkbox" name="checkbox[{{$student->id}}]"></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div style="text-align:right;">
                    <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn_save" value="btn_save">Save</button>
                  </div>
                </form>
              </div>
            @endif
          </div>
        </section>
      </div>
  </div>
</section>
</section>
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/childexammark.js')}}"></script>
<script type="text/javascript">
</script>
@endsection
