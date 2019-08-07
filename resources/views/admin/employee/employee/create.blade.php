@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
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
                <form action="{{URL::to('employees')}}" onsubmit="return validate();" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label class="control-label">Class Level</label>
                      <div>
                        @foreach($pLevel as $pl)
                          <label style="margin-right:10px;" for="programlabelid[{{$pl->id}}]"><input class="form-check-input" type="checkbox" name="programlabelid[{{$pl->id}}]" value="{{$pl->id}}" id="programlabelid[{{$pl->id}}]">{{$pl->name}}</label>
                        @endforeach
                      </div>                  
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label class="control-label" for="employeetypeid">Employee Type</label>
                      <select class="form-control" name="employeetypeid" id="employeetypeid">
                          <option value="">SELECT</option>
                          @foreach($employeetypeList as $x)
                           <option <?php echo (old('employeetypeid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="designationid">Designation</label>
                      <select class="form-control" name="designationid" id="designationid">
                          <option value="">SELECT</option>
                          @foreach($designationList as $x)
                           <option <?php echo (old('designationid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="departmentid">Department</label>
                      <select class="form-control" name="departmentid" id="departmentid">
                          <option value="">SELECT</option>
                          @foreach($departmentList as $x)
                           <option <?php echo (old('departmentid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="employmentstatusid">Employment Status</label>
                      <select class="form-control" name="employmentstatusid" id="employmentstatusid">
                          <option value="">SELECT</option>
                          @foreach($employmentStatusList as $x)
                           <option <?php echo (old('employmentstatusid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="control-label" for="employeestatusid">Employee Status</label>
                      <select class="form-control" name="employeestatusid" id="employeestatusid">
                          <option value="">SELECT</option>
                          @foreach($employeeStatusList as $x)
                           <option <?php echo (old('employeestatusid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="employeeposition">Employee Position</label>
                        <input type="text" value="{{old('employeeposition')}}" class="form-control" name="employeeposition" id="employeeposition">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="joining_date">Joining Date</label>
                        <input autocomplete="off" value="{{old('joining_date')}}"  type="text" class="form-control" name="joining_date" id="joining_date">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="retirement_date">Retirement Date</label>
                        <input autocomplete="off" value="{{old('retirement_date')}}" type="text" class="form-control" name="retirement_date" id="retirement_date">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-4">
                        <label class="control-label" for="first_name">First Name</label>
                        <input type="text" value="{{old('first_name')}}" class="form-control" name="first_name" id="first_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="middle_name">Middle Name</label>
                        <input type="text" value="{{old('middle_name')}}" class="form-control" name="middle_name" id="middle_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="last_name">Last Name</label>
                        <input type="text" value="{{old('last_name')}}" class="form-control" name="last_name" id="last_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="father_name">Father Name</label>
                        <input type="text" value="{{old('father_name')}}" class="form-control" name="father_name" id="father_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="mother_name">Mother Name </label>
                        <input type="text" value="{{old('mother_name')}}" class="form-control" name="mother_name" id="mother_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="genderid">Gender</label>
                        <select class="form-control" name="genderid" id="genderid">
                          <option value="">SELECT</option>
                          @foreach($genderList as $x)
                           <option <?php echo (old('genderid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="mobileno">Mobile Number</label>
                        <input type="text" value="{{old('mobileno')}}" class="form-control" name="mobileno" id="mobileno">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="dob">Date of Birth</label>
                        <input autocomplete="off" value="{{old('dob')}}" type="text" class="form-control" name="dob" id="dob">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="birthregno">Birth Registration Number  </label>
                        <input type="text" value="{{old('birthregno')}}" class="form-control" name="birthregno" id="birthregno">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="nationalityid">Nationality</label>
                        <select class="form-control" name="nationalityid" id="nationalityid">
                          <option value="">SELECT</option>
                          @foreach($nationalityList as $x)
                           <option <?php echo (old('nationalityid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="nationalidno">National ID Number</label>
                        <input type="text" value="{{old('nationalidno')}}" class="form-control" name="nationalidno" id="nationalidno">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="bloodgroupid">Blood Group  </label>
                        <select class="form-control" name="bloodgroupid" id="bloodgroupid">
                          <option value="">SELECT</option>
                          @foreach($bloodGroupList as $x)
                           <option <?php echo (old('bloodgroupid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="marital_statusid">Marital Status </label>
                        <select class="form-control" name="marital_statusid" id="marital_statusid">
                          <option value="">SELECT</option>
                          @foreach($maritalStatusList as $x)
                           <option <?php echo (old('marital_statusid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="email">Email</label>
                        <input type="text" value="{{old('email')}}" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="present_addressid">Present Address  </label>
                        <input type="text" value="{{old('present_addressid')}}" class="form-control" name="present_addressid" id="present_addressid">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="picture">Employee Image</label>
                        <input data-width="176" data-height="200" data-size="19046.4" type="file" value="{{old('picture')}}" class="form-control-file" name="picture" id="picture">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="signature">Employee Signature  </label>
                        <input data-width="341" data-height="91" data-size="50293" type="file" value="{{old('signature')}}" class="form-control-file" name="signature" id="signature">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="indexno">Index No</label>
                        <input type="text" value="{{old('indexno')}}" class="form-control" name="indexno" id="indexno">
                    </div>
                  </div>
                  <label style="display:none;" id="dd">{{($bloodGroupList)}}</label>
                  <div class="row">
                     <div class="col-md-12">
                        <label class="control-label" >Education Information</label>
                        <table class="table table-striped table-bordered table-hover customtable educationinfo plushbtn">
                          <thead>
                            <th width="20%">Program Type</th>
                            <th width="20%">Discipline</th>
                            <th width="20%">Grade</th>
                            <th width="19%">Passing Year</th>
                            <th width="19%">Board/Institution</th>
                            <th width="2%"><span id="education"></span></th>
                          </thead>
                          <tbody id="tbody">
                          </tbody>
                        </table>
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

    <table style="display:none;">
      <tbody id="hiddenContent">
      <tr>
          <td>
            <div class="form-group">
              <select  class="form-control" name="educationdegreeid[]">
              <option value="">SELECT</option>
                  @foreach($educationDegreeList as $x)
                    <option value="{{$x->id}}">{{$x->name}}</option>
                  @endforeach
              </select>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control" type="text" name="discipline[]" />
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control" type="text" name="grade[]" />
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control" type="text" name="passingyear[]" />
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control" type="text" name="board[]" />
            </div>
          </td>
          <td><span></span></td>
        </tr>
        <tbody>
    </table>
    
                    
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('clientAdmin/js/employee.js')}}"></script>
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