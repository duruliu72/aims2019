@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/programoffer')}}">All</a></li>
              <li>Program Offer</li>
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
                <form action="{{URL::to('programoffer')}}/{{$bean->id}}" method="POST">
                  @method('PUT')
                  {{csrf_field()}}
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="sessionid">Session</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="sessionid" id="sessionid">
                         <option value="">SELECT</option>
                         @foreach ($sessionList as $x)
                           @if($x->id==$bean->sessionid)
                               <option selected value="{{$x->id}}">{{$x->name}}</option>
                            @else
                              <option value="{{$x->id}}">{{$x->name}}</option>
                            @endif
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="programid">Program</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'programtogroup')" class="form-control" name="programid" id="programid">
                          <option  value="">SELECT</option>
                         @foreach ($programList as $x)
                           @if($x->id==$bean->programid)
                               <option selected value="{{$x->id}}">{{$x->name}}</option>
                            @else
                              <option value="{{$x->id}}">{{$x->name}}</option>
                            @endif
                         @endforeach
                      </select>
                    </div>                         
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="groupid">Group</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="groupid" id="groupid">
                         <option value="">SELECT</option>
                         @foreach ($groupList as $x)
                          @if($x->id==$bean->groupid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="mediumid" id="mediumid">
                         <option value="">SELECT</option>
                         @foreach ($mediumList as $x)
                          @if($x->id==$bean->mediumid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
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
                          @if($x->id==$bean->shiftid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="cordinator">Cordiantor</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="cordinator" id="cordinator">
                         <option value="">SELECT</option>
                         @foreach ($employeeList as $x)
                         @if($x->id==$bean->cordinator)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>                        
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="seat">Seat</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="seat" id="seat" value="{{$bean->seat}}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-default">Update</button>
                </form>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/ajax.js')}}"></script>
@endsection