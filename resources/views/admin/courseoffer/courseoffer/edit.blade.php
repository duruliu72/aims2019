@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <ol class="breadcrumb">
                <li>Admission Marks Edit</li>
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
                <div class="top_form">
                    <form action="{{URL::to('admissionmarkentry/edit')}}" method="POST">
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
                       <label class="col-sm-2 control-label" for="groupid">Group</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                           <option value="">SELECT</option>
                          @foreach ($groupList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                        </select>
                      </div>                       
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                      <div class="col-sm-4">
                        <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                           <option value="">SELECT</option>
                           @foreach ($mediumList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                           
                        </select>
                      </div>
                       <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="shiftid" id="shiftid">
                          <option value="">SELECT</option>
                           @foreach ($shiftList as $x)
                             <option value="{{$x->id}}">{{$x->name}}</option>
                           @endforeach
                        </select>
                      </div>                           
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Applicant Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('admissionmarkentry/edit')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($programinfo)&&isset($applicantsmarks))
                <div class="programofferinfo">
                    <div class="programofferinfo_item">
                        <span>Session: {{$programinfo->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class Level: {{$programinfo->levelName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class: {{$programinfo->programName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Medium: {{$programinfo->mediumName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Group: {{$programinfo->groupName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Shift: {{$programinfo->shiftName}}</span>
                    </div>
                </div>
                <div class="bottom_form">
                  <form action="{{URL::to('admissionmarkentry/edit')}}" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="programofferid" value="{{$programinfo->id}}">
                  <table class="table table-striped table-bordered table-hover" id="admissionmark">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Applicant Id</th>
                        <th>Student Name</th>
                        <th>Roll</th>
                        @foreach($subjectinfo as $x)
                        <th>{{$x->name}}(<span class="subjectmarks">{{$x->marks}}</span>)</th>
                        @endforeach
                        <th>Total Marks({{$programinfo->exam_marks}})</th>
                        <th><input id="markcheck" type="checkbox"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $id=0; ?>
                       @foreach($applicantsmarks as $am)
                      <tr>
                        <td>{{++$id}}</td>
                        <td>{{$am['applicants']->applicantid}}</td>
                        <td>{{$am['applicants']->name}}</td>
                        <td>{{$am['applicants']->admssion_roll}}</td>
                        @foreach($am['subjectinfo'] as $x)
                          <td class="item_{{$am['applicants']->applicantid}}">
                            <input type="text" name="marks[{{$am['applicants']->applicantid}}][]"  value="{{$x->marks}}">
                            <input type="hidden" name="subjectid[{{$am['applicants']->applicantid}}][]" value="{{$x->subjectid}}">
                          </td>
                        @endforeach
                        <td class="item_{{$am['applicants']->applicantid}}"><label>{{$am['applicants']->totamarks}}</label></td>
                        <td><input class="markcheck" type="checkbox" name="checkbox[{{$am['applicants']->applicantid}}]"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                     <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="update_btn" value="update_btn">Update</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('admissionmarkentry/edit')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
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
<script src="{{asset('clientAdmin/js/admissionmarkentry.js')}}"></script>
@endsection