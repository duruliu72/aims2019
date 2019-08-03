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
                      <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
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
                    <label class="col-sm-2 control-label" for="cordinator">Coordinator</label>
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
                    <label class="col-sm-2 control-label" for="number_of_courses">Number of courses</label>
                    <div class="col-sm-4">
                    <input type="text" class="form-control" name="number_of_courses" id="number_of_courses" value="{{$bean->number_of_courses}}">
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover customtable sectionoffer" id="sectionoffer">
                            <thead>
                                <tr>
                                <th width="2%">#</th>
                                <th width="20%">Section</th>
                                <th width="38%">Number of Student</th>
                                <th width="38%">Section Teacher</th>
                                <th width="2%"><input id="markcheckid" type="checkbox" name="check" /></th>
                                </tr>
                            </thead>
                            <tbody id="output">
                                @foreach($sectionList as $x)
                                <tr>
                                <td>{{$x->id}}<input type="hidden" name="sectionid[{{$x->id}}]" value="{{$x->id}}" /></td>
                                <td>{{$x->name}} <input type="hidden" name="section_name[{{$x->id}}]" value="{{$x->name}}" /></td>
                                <td class="no-padding"><input class="form-control" type="text" name="section_student_number[{{$x->id}}]" value="{{$x->section_std_num}}" /></td>
                                <td class="no-padding">
                                    <select class="form-control" name="section_teacher[{{$x->id}}]">
                                        <option value="">SELECT</option>
                                        @foreach ($employeeList as $emp)
                                            @if($emp->id==$bean->section_teacher)
                                                <option selected value="{{$emp->id}}">{{$emp->name}}</option>
                                            @else
                                                <option value="{{$emp->id}}">{{$emp->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                @if($x->sectionid!=0)
                                <td><input class="markcheck" checked type="checkbox" name="checkbox[{{$x->id}}]"></td>
                                @else
                                <td><input class="markcheck"  type="checkbox" name="checkbox[{{$x->id}}]"></td>
                                @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/programoffer.js')}}"></script>
@endsection