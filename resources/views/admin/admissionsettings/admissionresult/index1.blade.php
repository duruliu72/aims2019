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
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <ol class="breadcrumb">
                <li>Admission Result</li>
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
                    <form action="{{URL::to('admissionresults')}}" method="POST">
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
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('admissionmarkentry')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($results)&&isset($programinfo))
                  <div class="printarea" id="printarea">
                    <div class="row print-row">
                      <div class="col-sm-12 print-col">
                         <div class="programinfo">
                            <div class="programinfo_item"><span>Session&nbsp:</span> <span>{{$programinfo->sessionName}}</span></div>
                            <div class="programinfo_item"><span>Class&nbsp:</span> <span>{{$programinfo->programName}}</span></div>
                            <div class="programinfo_item"><span>Group&nbsp:</span> <span>{{$programinfo->groupName}}</span></div>
                            <div class="programinfo_item"><span>Medium&nbsp:</span> <span>{{$programinfo->mediumName}}</span></div>
                            <div class="programinfo_item"><span>Shift&nbsp: </span> <span>{{$programinfo->shiftName}}</span></div>
                         </div>
                      </div>
                    </div>
                    <div class="row print-row">
                      <div class="col-sm-12 print-col">
                        <div class="applicant_info">
                            <table>
                              <thead>
                                <tr>
                                  <th>Applicantid</th>
                                  <th>Name</th>
                                  <th>Position</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @foreach($results as $x)
                                  <tr>
                                    <td>{{$x->applicantid}}</td>
                                    <td>{{$x->name}}</td>
                                    <td>{{$x->serialno}}</td>
                                  </tr>
                                 @endforeach
                              </tbody>
                            </table>
                        </div>
                      </div>
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
<script src="{{asset('clientAdmin/js/admissionmarkentry.js')}}"></script>
@endsection