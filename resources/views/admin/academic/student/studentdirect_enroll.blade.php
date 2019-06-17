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
            <h3 class="page-header"><i class="fa fa-laptop"></i>
              @if($institute!=null)
                {{$institute->name}}
              @else
                Dashboard
              @endif
            </h3>
             <ol class="breadcrumb">
                <li>Direct Student Registration</li>
                @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                @endif
                @if(session()->has('msg'))
                <span style="float: right;font-size: 15px;">
                  {{ session()->get('msg') }}
                </span>
                @endif
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
                <div class="notprint">
                    <form action="{{URL::to('directenroll')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @if($programofferinfo==null)
                      <div class="form-group row">
                        <label class="col-sm-2 control-label" for="programid">Class<span class="star">*</span></label>
                        <div class="col-sm-4">
                            <select onchange="getChange(this,'program')"  class="form-control" name="programid" id="programid">
                              <option value="">SELECT</option>
                                  @foreach ($programList as $x)
                                  <option <?php echo (old('programid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                                  @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="mediumid">Medium <span class="star">*</span></label>
                        <div class="col-sm-4">
                          <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                            <option value="">SELECT</option>
                            @foreach ($mediumList as $x)
                              <option <?php echo (old('mediumid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>
    				 		      </div>
                       <div class="form-group row">
                        <label class="col-sm-2 control-label" for="shiftid">Shift<span class="star">*</span></label>
                        <div class="col-sm-4">
                            <select onchange="getChange(this,'shift')"  class="form-control" name="shiftid" id="shiftid">
                              <option value="">SELECT</option>
                                  @foreach ($shiftList as $x)
                                  <option <?php echo (old('shiftid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                                  @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" for="groupid">Group <span class="star">*</span></label>
                        <div class="col-sm-4">
                          <select class="form-control" name="groupid" id="groupid">
                            <option value="">SELECT</option>
                            @foreach ($groupList as $x)
                              <option <?php echo (old('groupid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>
    				 		      </div>
                      <div class="form-group row">
                          <label class="col-md-2 control-label" for="firstName">First Name<span class="star">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName" value="{{old('firstName')}}">
								         </div>  
								          <label class="col-md-2 control-label" for="middleName">Middle Name</label>
	                        <div class="col-md-4">
	                          <input type="text" class="form-control" placeholder="First Name" id="middleName" name="middleName" value="{{old('middleName')}}">
								          </div>                     
							        </div>
                      <div class="form-group row">
	                      <label class="col-md-2 control-label" for="lastName">Last Name</label>
	                      <div class="col-md-4">
									        <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName" value="{{old('lastName')}}">
								        </div> 
								        <label class="col-md-2 control-label" for="phone">Phone<span class="star">*</span></label>
	                      <div class="col-md-4">
									        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" value="{{old('phone')}}">
								        </div>                    
							        </div>
                      <div class="form-group row">
                          <label class="col-md-2 control-label" for="fatherName">Father Name<span class="star">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Father Name" id="fatherName" name="fatherName" value="{{old('fatherName')}}">
                          </div>    
                          <label class="col-md-2 control-label" for="motherName">Mother Name<span class="star">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Mother Name" id="motherName" name="motherName" value="{{old('motherName')}}">
                          </div>                         
                    	</div>
                      <div class="form-group row">
                        <label class="col-md-2 control-label" for="dob">Date of Birth<span class="star">*</span></label>
		                    <div class="col-md-4 date" id="datetimepicker1">
		                      <input autocomplete="off" onchange="agecalculate(this)" type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}">
								        </div>
                        <label class="col-md-2 control-label" for="genderid">Gender<span class="star">*</span></label>
                          <div class="col-md-4">
                            <?php
                            $check=true;
                            ?>
                            @foreach ($genderList as $x)
                              <label><input @if($check) checked <?php $check=false; ?> @endif type="radio" name="genderid" value="{{$x->id}}">{{$x->name}}</label>
                            @endforeach
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-2 control-label" for="religionid">Religion<span class="star">*</span></label>
                        <div class="col-md-4">
                          <select class="form-control" name="religionid" id="religionid">
                              <option value="">SELECT</option>
                                @foreach ($religionList as $x)
                                <option <?php echo (old('religionid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                                @endforeach
                          </select>
                        </div>
                        <label class="col-md-2 control-label" for="quotaid">Quota<span class="star">*</span></label>
		                    <div class="col-md-4">
                            <select class="form-control" name="quotaid" id="quotaid">
                                <option value="0">SELECT</option>
                                @foreach ($quotaList as $x)
                                <option <?php echo (old('quotaid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-2 control-label" for="picture">Picture</label>
                        <div class="col-md-4">
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <label class="col-md-2 control-label" for="signature">Signature</label>
                        <div class="col-md-4">
                            <input type="file" class="form-control-file" name="signature" id="signature">
                        </div>
					            </div>
                      <div style="text-align:right;">
                          <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="next_btn" value="next_btn">Next</button>
                      </div>
                    </form>
                      @else
                      <div class="row print-row">
                        <div class="col-sm-12 print-col">
                          <div class="programinfo">
                              <div class="programinfo_item"><span>Session&nbsp:</span> <span>{{$programofferinfo->sessionName}}</span></div>
                              <div class="programinfo_item"><span>Class&nbsp:</span> <span>{{$programofferinfo->programName}}</span></div>
                              <div class="programinfo_item"><span>Group&nbsp:</span> <span>{{$programofferinfo->groupName}}</span></div>
                              <div class="programinfo_item"><span>Medium&nbsp:</span> <span>{{$programofferinfo->mediumName}}</span></div>
                              <div class="programinfo_item"><span>Shift&nbsp: </span> <span>{{$programofferinfo->shiftName}}</span></div>
                          </div>
                        </div>
                      </div>
                      <div class="row print-row" style="margin-top:25px;">
                        <form action="{{URL::to('directenroll')}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <input type="hidden" name="programofferid" value={{$field_data['programofferid']}}>
                          <input type="hidden" name="firstName" value={{$field_data['firstName']}}>
                          <input type="hidden" name="middleName" value={{$field_data['middleName']}}>
                          <input type="hidden" name="lastName" value={{$field_data['lastName']}}>
                          <input type="hidden" name="phone" value={{$field_data['phone']}}>
                          <input type="hidden" name="fatherName" value={{$field_data['fatherName']}}>
                          <input type="hidden" name="motherName" value={{$field_data['motherName']}}>
                          <input type="hidden" name="dob" value={{$field_data['dob']}}>
                          <input type="hidden" name="genderid" value={{$field_data['genderid']}}>
                          <input type="hidden" name="religionid" value={{$field_data['religionid']}}>
                          <input type="hidden" name="quotaid" value={{$field_data['quotaid']}}>
                          <input type="hidden" name="picture" value={{$field_data['picture']}}>
                          <input type="hidden" name="signature" value={{$field_data['signature']}}>
                          <div class="col-md-12">
                            <div class="course_info">
                              <table class="table table-striped table-bordered table-hover customtable" id="studentcourse">
                                <thead>
                                    <tr>
                                        <th width="2%">#</th>
                                        <th>Course</th>
                                        <th>Course Type</th>
                                        <th width="2%"><input id="coursecheckid" type="checkbox"></th>
                                    </tr>
                                </thead>
                                <tbody>
                               <?php $id=0; ?>
                                  @foreach($courseList as $course)
                                    <tr>
                                      <td>{{++$id}}</td>
                                      <td>{{$course->courseNameWithCode}}</td>
                                      <td>
                                          <select class="form-control" name="coursetypeid[{{$course->coursecodeid}}]" id="coursetypeid">
                                          @foreach($courseTypeList as $x)
                                          <option value="{{$x->id}}">{{$x->name}}</option>
                                          @endforeach
                                          </select>
                                      </td>
                                      <td><input class="coursecheck" type="checkbox" name="coursecheck[{{$course->coursecodeid}}]"></td>
                                    </tr>
                                  @endforeach
                              </tbody>
                              </table>
                            </div>
                            <div class="from-group row" style="margin-bottom:15px;">
                                <label class="col-sm-2 control-label" for="sectionid">Section</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="sectionid" id="sectionid">
                                      @foreach($sectionList as $x)
                                          <option value="{{$x->id}}">{{$x->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="classroll">Class Roll</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" placeholder="class Roll" id="classroll" name="classroll" value="{{old('classroll')}}">
                              </div> 
                            </div>
                              <div style="text-align:right;">
                                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="save_btn" value="save_btn">Save</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      @endif
                  </div>
                </div>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/student.js')}}"></script>
<script type="text/javascript">
    var Script = function() {
  //date picker
  $(function() {
    $('#dob').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
  });

}();
</script>
@endsection