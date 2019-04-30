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
              <li><a href="{{URL::to('/admissionprogram')}}">All</a></li>
              <li>Admission Program</li>
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
                <form action="{{URL::to('admissionprogram')}}" method="POST">
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
                      <select class="form-control" name="groupid" id="groupid">
                         <option value="">SELECT</option>
                         @foreach ($groupList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                          
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="required_gpa">Required GPA</label>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" name="required_gpa" id="required_gpa">
                    </div>
                     <label class="col-sm-2 control-label" for="exam_marks">Exam Marks</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="exam_marks" id="exam_marks">
                    </div>                           
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="exam_date">Exam Date</label>
                    <div class="col-sm-4">
                       <input autocomplete="off" type="text" class="form-control" name="exam_date" id="exam_date">
                    </div>
                     <label class="col-sm-2 control-label" for="exam_time">Exam Time</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="exam_time" id="exam_time">
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
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/admissionprogram.js')}}"></script>
<script type="text/javascript">
    var Script = function() {
  //date picker
  $(function() {
    $('#exam_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#exam_time').timepicker();
  });

}();
</script>
@endsection