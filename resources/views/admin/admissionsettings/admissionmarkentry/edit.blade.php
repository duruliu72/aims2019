@extends('admin.admin')
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
                      <label class="col-sm-2 control-label" for="groupid">Group</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="groupid" id="groupid">
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
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Applicant Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('admissionmarkentry/edit')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($result)&&$result!=null)
                <div class="programofferinfo">
                    <div class="programofferinfo_item">
                      <span>Session: {{$result['programoffer']->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                      <span>Class Level: {{$result['programoffer']->levelName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                      <span>Class: {{$result['programoffer']->programName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                      <span>Medium: {{$result['programoffer']->mediumName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                      <span>Group: {{$result['programoffer']->groupName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                      <span>Shift: {{$result['programoffer']->shiftName}}</span>
                    </div>
                </div>
                <div class="bottom_form">
                  <form action="{{URL::to('admissionmarkentry/edit')}}" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="programofferid" value="{{$result['programoffer']->id}}">
                  <table class="table table-striped table-bordered table-hover" id="admissionmark">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Applicant Id</th>
                        <th>Student Name</th>
                        <th>Roll</th>
                        @foreach($result['subjectinfo'] as $x)
                        <th>{{$x->name}}(<span class="subjectmarks">{{$x->marks}}</span>)</th>
                        @endforeach
                        <th>Total Marks({{$result['admissionprogram']->exam_marks}})</th>
                        <th><input id="markcheck" type="checkbox"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $id=0; ?>
                      @foreach($result['applicants'] as $ap)
                      <tr>
                        <td>{{++$id}}</td>
                        <td>{{$ap->applicantid}}</td>
                        <td>{{$ap->firstName}}</td>
                        <td>{{$ap->admssion_roll}}</td>
                        @foreach($result['subjectinfo'] as $x)
                          <td class="item_{{$ap->applicantid}}">
                            <input type="text" name="marks[{{$ap->applicantid}}][]" value="{{$result['markLst'][$ap->applicantid][$x->subjectid]}}" />
                            <input type="hidden" name="subjectid[{{$ap->applicantid}}][]" value="{{$x->subjectid}}">
                          </td>
                        @endforeach
                        <td class="item_{{$ap->applicantid}}"><label>{{$result['tot_marksList'][$ap->applicantid]->total_marks}}</label></td>
                        <td><input class="markcheck" type="checkbox" name="checkbox[{{$ap->applicantid}}]"></td>
                      </tr>
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
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/admissionmarkentry.js')}}"></script>
@endsection