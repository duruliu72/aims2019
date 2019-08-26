@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/shift')}}">All</a></li>
              <li>Shifts</li>
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
                <form action="{{URL::to('shift')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group row">
                      <label class="control-label col-sm-2" for="startTime">From</label>
                      <div class="col-sm-4">
                        <input id="startTime" type="text" value="12-12-2019" class="form-control" name="startTime">
                      </div>
                      <label class="control-label col-sm-2" for="endTime">To</label>
                      <div class="col-sm-4">
                        <input id="endTime" type="text" value="12-12-2019" class="form-control" name="endTime">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
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
<script src="{{asset('clientAdmin/js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript">
    var Script = function() {
  $(function() {
    $('#startTime').timepicker();
    $('#endTime').timepicker();
  });

}();
</script>
@endsection