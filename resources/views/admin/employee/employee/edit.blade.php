@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<!-- <link href="{{asset('clientAdmin/css/bootstrap-timepicker.min.css')}}" rel="stylesheet"> -->
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/employees')}}">All</a></li>
              <li>Employees</li>
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
          <div class="col-md-12">
            <section class="panel">
              <div class="panel-body">
                <form action="{{URL::to('employees')}}" method="POST">
                  @method('PUT')
                  {{csrf_field()}}
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label class="control-label" for="programid">Employee Type</label>
                      <select class="form-control" name="programid" id="programid">
                          <option value="">SELECT</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="programid">Designation</label>
                      <select class="form-control" name="programid" id="programid">
                          <option value="">SELECT</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="programid">Department</label>
                      <select class="form-control" name="programid" id="programid">
                          <option value="">SELECT</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="programid">Employment Status</label>
                      <select class="form-control" name="programid" id="programid">
                          <option value="">SELECT</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="programid">Employee Status</label>
                      <select class="form-control" name="programid" id="programid">
                          <option value="">SELECT</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Employee Position</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Joining Date</label>
                        <input autocomplete="off"  type="text" class="form-control" name="name" id="joining_date">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Retirement Date</label>
                        <input autocomplete="off" type="text" class="form-control" name="name" id="retirement_date">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">First Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Middle Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Last Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Father Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Mother Name </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Gender</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Mobile Number</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Date of Birth</label>
                        <input autocomplete="off" type="text" class="form-control" name="name" id="dob">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Birth Registration Number  </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Nationality</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">National ID Number</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Blood Group  </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Marital Status </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Email Address</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Present Address  </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Employee Image  </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Employee Signature  </label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="name">Index No</label>
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
<script src="{{asset('clientAdmin/js/bootstrap-datepicker.js')}}"></script>
<!-- <script src="{{asset('clientAdmin/js/bootstrap-timepicker.min.js')}}"></script> -->
<script type="text/javascript">
    var Script = function() {
  //date picker
  $(function() {
    $('#dob').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#joining_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#retirement_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    // $('#exam_time').timepicker();
  });

}();
</script>
@endsection