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
              <li><a href="{{URL::to('/gender')}}">All</a></li>
              <li>Gender</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">
                <form action="{{URL::to('gender')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <!--  <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control">
                    </div> -->
                  </div>
                  <div class="form-group row">
                      <label class="control-label col-sm-2">Birth Date</label>
                      <div class="col-sm-4">
                        <input id="dp1" type="text" value="12-12-2019"  class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="control-label col-sm-2">Current Date</label>
                      <div class="col-sm-4">
                        <input id="dp2" type="text" value="12-12-2019" class="form-control">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="sessionid">Session</label>
                    <div class="col-sm-4">
                      <select class="form-control">
                         <option value="">SELECT</option>
                      </select>
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
<!-- custom form component script for this page-->
<script src="{{asset('clientAdmin/js/custom-form.js')}}"></script>
@endsection