@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
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
              <li><a href="{{URL::to('/startend')}}">All</a></li>
              <li>Application Date Time</li>
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
                <form action="{{URL::to('startend')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="sessionid">Session</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="sessionid" id="sessionid">
                         <option value="">SELECT</option>
                         @foreach($sessionList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="app_startDate">Application Start Date</label>
                    <div class="col-sm-4">
                      <input autocomplete="off" type="text" class="form-control" name="app_startDate" id="app_startDate">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="app_endDate">Application End Date</label>
                    <div class="col-sm-4">
                      <input autocomplete="off" type="text" class="form-control" name="app_endDate" id="app_endDate">
                    </div>
                    <label class="col-sm-2 control-label" for="examStartDate">Exam Start Date</label>
                    <div class="col-sm-4">
                      <input autocomplete="off" type="text" class="form-control" name="examStartDate" id="examStartDate">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-default">Save</button>
                </form>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('clientAdmin/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript">
    var Script = function() {
  //date picker
  $(function() {
    $('#app_startDate').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#app_endDate').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#examStartDate').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    // $('#exam_time').timepicker();
  });

}();
</script>
@endsection