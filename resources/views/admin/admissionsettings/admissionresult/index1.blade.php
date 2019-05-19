@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row notprint">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>
            @if($institute!=null)
                {{$institute->name}}
              @else
                Dashboard
              @endif
            </h3>
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
                        <select class="form-control" name="shiftid" id="shiftid">
                          <option value="">SELECT</option>
                           @foreach ($shiftList as $x)
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
                @if(isset($result)&&$result!=null)
                  <div class="printarea" id="printarea">
                    <div class="row print-row">
                      <div class="col-sm-12 print-col">
                         <div class="programinfo">
                         <div class="programofferinfo_item">
                          <span>Session: {{$result['admissionprogram']->sessionName}}</span>
                        </div>
                        <div class="programofferinfo_item">
                            <span>Class Level: {{$result['admissionprogram']->levelName}}</span>
                        </div>
                        <div class="programofferinfo_item">
                            <span>Class: {{$result['admissionprogram']->programName}}</span>
                        </div>
                        <div class="programofferinfo_item">
                            <span>Medium: {{$result['admissionprogram']->mediumName}}</span>
                        </div>
                        <div class="programofferinfo_item">
                            <span>Group: {{$result['admissionprogram']->groupName}}</span>
                        </div>
                        <div class="programofferinfo_item">
                            <span>Shift: {{$result['admissionprogram']->shiftName}}</span>
                        </div>
                         </div>
                      </div>
                    </div>
                    <div class="row print-row">
                      <div class="col-sm-12 print-col">
                        <div class="table-responsive applicant_info">
                            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                              <thead>
                                <tr>
                                  <th>Applicantid</th>
                                  <th>Name</th>
                                  <th>Position</th>
                                  <th>Marks</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @foreach($result['applicants'] as $x)
                                  <tr>
                                    <td>{{$x[0]->applicantid}}</td>
                                    <td>{{sprintf('%s %s %s',$x[0]->firstName,$x[0]->middleName,$x[0]->lastName)}}</td>
                                    <td>{{$x[1]}}</td>
                                    <td>{{$x[0]->tot_marks}}</td>
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
<script src="{{asset('clientAdmin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/responsive.bootstrap.min.js')}}"></script>
<!-- ==== -->
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/admissionmarkentry.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function() {
  var table = $('#example').DataTable( {
    responsive: true
  } );
  new $.fn.dataTable.FixedHeader( table );
} );
</script>
@endsection