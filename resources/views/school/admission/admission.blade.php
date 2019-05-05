@extends('school.layouts.main')
@section('title')
 <title>Admission-2019 </title>
@endsection
@section('uniqueStyle')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="{{asset('school/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div id="admission">
    	<div class="container">
    		<div class="heading">
    			<h3>Apply For Admission</h3>
    			<div class="massage">	
	    			@if ($errors->any())
	                  	<span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
	              	@endif
	              	@if(session()->has('msg'))
	              		<span style="float: right;font-size: 15px;">{{ session()->get('msg') }}</span>
	              	@endif
	            </div>
    		</div>
    		<div class="row">
    			<div class="col-sm-12">
    				 <form action="{{URL::to('admission')}}"  method="post" class="form-horizontal" id="regForm" enctype="multipart/form-data">
    				 	{{csrf_field()}}
    				 	<!-- <div class="formsegment"> -->
    				 		 <div class="form-group row">
                            	<label class="col-sm-2 control-label" for="programid">Class</label>
	                            <div class="col-sm-4">
	                                <select onchange="getChange(this,'program')"  class="form-control" name="programid" id="programid">
	                                    <option value="">SELECT</option>
	                                     @foreach ($programList as $x)
				                           <option <?php echo (old('programid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
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
    				 	<!-- </div> -->
    				 	<!-- <div class="formsegment"> -->
	    				 	<div class="form-group row">
	                            <label class="col-md-2 control-label" for="name">Name</label>
	                            <div class="col-md-4">
	                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{old('name')}}">
	                            </div>                      
	                        </div>
	                        <div class="form-group row">
		                         <label class="col-md-2 control-label" for="fatherName">Father Name</label>
		                         <div class="col-md-4">
		                            <input type="text" class="form-control" placeholder="Father Name" id="fatherName" name="fatherName">
		                        </div>    
		                        <label class="col-md-2 control-label" for="motherName">Mother Name</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" placeholder="Mother Name" id="motherName" name="motherName">
		                        </div>                         
                    		</div>
                    		<div class="form-group row">
		                         <label class="col-md-2 control-label" for="f_occupation">Father's Occupation</label>
		                         <div class="col-md-4">
		                            <input type="text" class="form-control" id="f_occupation" name="f_occupation">
		                        </div>    
		                        <label class="col-md-2 control-label" for="m_occupation">Mother' Occupation</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control"  id="m_occupation" name="m_occupation">
		                        </div>                         
                    		</div>
                    			<div class="form-group row">
		                         <label class="col-md-2 control-label" for="father_nid">Father's NID</label>
		                         <div class="col-md-4">
		                            <input type="text" class="form-control"  id="father_nid" name="father_nid">
		                        </div>    
		                        <label class="col-md-2 control-label" for="mother_nid">Mother' NID</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control"  id="mother_nid" name="mother_nid">
		                        </div>                         
                    		</div>
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="father_Phone">Father's Phone</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" placeholder="Phone" id="father_Phone" name="father_Phone">
		                        </div>
		                        <label class="col-md-2 control-label" for="father_Phone">Mother's Phone</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" placeholder="Phone" id="father_Phone" name="father_Phone">
		                        </div>
                    		</div>
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="dob">Date of Birth</label>
		                        <div class="col-md-4 date" id="datetimepicker1">
		                            <input autocomplete="off" onchange="agecalculate(this)" type="text" class="form-control" id="dob" name="dob" value="">
		                        </div>
		                        <label class="col-md-2 control-label" for="age">Age</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" id="age" name="age">
		                        </div>
                    		</div>
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="birthregno">Birth Reg. No</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control"  id="birthregno" name="birthregno">
		                        </div>
		                        <label class="col-md-2 control-label" for="birthpalace">Palace Of Birth</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control"  id="birthpalace" name="birthpalace">
		                        </div>
                    		</div>
                    		<div class="form-group row">
                    			<label class="col-md-2 control-label" for="genderid">Gender</label>
	                            <div class="col-md-4">
	                            	 @foreach ($genderList as $x)
				                        <label><input type="radio" name="genderid" value="{{$x->id}}">{{$x->name}}</label>
				                     @endforeach
	                            </div>   
		                        <label class="col-md-2 control-label" for="bloodgroupid">Blood Group</label>
		                        <div class="col-md-4">
		                            <select class="form-control" name="bloodgroupid" id="bloodgroupid">
		                                <option value="0">SELECT</option>
		                                @foreach ($bloodgroupLst as $x)
				                           <option value="{{$x->id}}">{{$x->name}}</option>
				                        @endforeach
		                            </select>
		                        </div>
		                    </div>
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="marital_status">Student's Marital Status</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control"  id="marital_status" name="marital_status">
		                        </div>
		                        <label class="col-md-2 control-label" for="religionid">Religion</label>
		                        <div class="col-md-4">
		                            <select class="form-control" name="religionid" id="religionid">
		                                <option value="">SELECT</option>
		                                @foreach ($religionList as $x)
				                           <option value="{{$x->id}}">{{$x->name}}</option>
				                        @endforeach
		                            </select>
		                        </div>
                    		</div>                    		
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="nationalityid">Nationality</label>
		                        <div class="col-md-4">
		                            <select class="form-control" name="nationalityid" id="nationalityid">
		                                @foreach ($nationaityList as $x)
				                           <option value="{{$x->id}}">{{$x->name}}</option>
				                        @endforeach
		                            </select>
		                        </div>
		                        <label class="col-md-2 control-label" for="ethnicty">Ethnicty</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" id="ethnicty" name="ethnicty">
		                        </div>
                    		</div>
                    		<div class="form-group row">
		                        <label class="col-md-2 control-label" for="quotaid">Quota</label>
		                        <div class="col-md-4">
		                            <select class="form-control" name="quotaid" id="quotaid">
		                                <option value="0">SELECT</option>
		                                @foreach ($quotaList as $x)
				                           <option value="{{$x->id}}">{{$x->name}}</option>
				                        @endforeach
		                            </select>
		                        </div>
		                        <label class="col-md-2 control-label" for="abled">Differently Abled</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" id="abled" name="abled">
		                        </div>
                    		</div>
                    		<div class="form-group row">
		                       	<label class="col-md-2 control-label" for="email">Student Email</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" id="email" name="email">
		                        </div>
		                        <label class="col-md-2 control-label" for="parent_income">Annual Income(Parent)</label>
		                        <div class="col-md-4">
		                            <input type="text" class="form-control" id="parent_income" name="parent_income">
		                        </div>
                    		</div>
    				 	<!-- </div> -->
    				 	<!-- <div class="formsegment"> -->
    				 		<div class="row">
    				 			<div class="col-sm-6">
    				 				<fieldset>
    				 					<legend>Present Address</legend>
    				 					<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_divisionid">Division</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'pre_division')" class="form-control" name="pre_divisionid" id="pre_divisionid">
		                                            <option value="">SELECT</option>
		                                            @foreach ($divisionList as $x)
				                           				<option value="{{$x->id}}">{{$x->name}}</option>
				                        			@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_districtid">District</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'pre_district')" class="form-control" name="pre_districtid" id="pre_districtid">
													<option value="">SELECT</option>
													@foreach ($districtList as $x)
				                           				<option value="{{$x->id}}">{{$x->name}}</option>
				                        			@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_thanaid">Thana</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'pre_thana')" class="form-control" name="pre_thanaid" id="pre_thanaid">
													<option value="">SELECT</option>
													@foreach ($thanaList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_postofficeid">Post Office</label>
		                                    <div class="col-sm-8">
		                                        <select class="form-control" name="pre_postofficeid" id="pre_postofficeid">
													<option value="">SELECT</option>
													@foreach ($postofficeList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_postcode">Post Code</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" id="pre_postcode" name="pre_postcode">
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="pre_localgovid">Union</label>
		                                    <div class="col-sm-8">
		                                        <select class="form-control" name="pre_localgovid" id="pre_localgovid">
													<option value="">SELECT</option>
													@foreach ($localgovList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-md-4 control-label" for="pre_address">Address</label>
		                                    <div class="col-md-8">
		                                        <textarea onchange="txtChange(this)" class="form-control" rows="4" id="pre_address" name="pre_address"></textarea>
		                                    </div>
		                                </div>
    				 				</fieldset>
    				 			</div>
    				 			<div class="col-sm-6">
    				 				<fieldset style="position: relative;">
    				 					<div style="position: absolute;top: 5px;right: 5px;"><input id="isChecked" name="isChecked" onclick="check(this)" type="checkbox">&nbsp;&nbsp;<span>Same As Present Address</span></div>
    				 					<legend>Permanent Address</legend>
    				 					<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_divisionid">Division</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'per_division')" class="form-control" name="per_divisionid" id="per_divisionid">
		                                            <option value="">SELECT</option>
		                                            @foreach ($divisionList as $x)
				                           				<option value="{{$x->id}}">{{$x->name}}</option>
				                        			@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_districtid">District</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'per_district')" class="form-control" name="per_districtid" id="per_districtid">
													<option value="">SELECT</option>
													@foreach ($districtList as $x)
				                           				<option value="{{$x->id}}">{{$x->name}}</option>
				                        			@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_thanaid">Thana</label>
		                                    <div class="col-sm-8">
		                                        <select onchange="changeAddress(this,'per_thana')" class="form-control" name="per_thanaid" id="per_thanaid">
													<option value="">SELECT</option>
													@foreach ($thanaList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_postofficeid">Post Office</label>
		                                    <div class="col-sm-8">
		                                        <select class="form-control" name="per_postofficeid" id="per_postofficeid">
													<option value="">SELECT</option>
													@foreach ($postofficeList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_postcode">Post Code</label>
		                                    <div class="col-sm-8">
		                                        <input type="text" class="form-control" id="per_postcode" name="per_postcode">
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                    <label class="col-sm-4 control-label" for="per_localgovid">Union</label>
		                                    <div class="col-sm-8">
		                                        <select class="form-control" name="per_localgovid" id="per_localgovid">
													<option value="">SELECT</option>
													@foreach ($localgovList as $x)
													<option value="{{$x->id}}">{{$x->name}}</option>
													@endforeach
		                                        </select>
		                                    </div>
                                		</div>
                                		<div class="form-group row">
		                                    <label class="col-md-4 control-label" for="per_address">Address</label>
		                                    <div class="col-md-8">
		                                        <textarea onchange="txtChange(this)" class="form-control" rows="4" id="per_address" name="per_address"></textarea>
		                                    </div>
		                                </div>
    				 				</fieldset>
    				 			</div>
    				 		</div>
    				 		<fieldset>
    				 			<legend>Parents/Legal Guardian Information</legend>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="guardianName">Guardian Name</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="guardianName" name="guardianName">
						            </div>
						            <label class="col-md-2 control-label" for="g_religion">Relegion</label>
						           <div class="col-md-4">
			                            <select class="form-control" name="g_religion" id="g_religion">
			                                <option value="0">SELECT</option>
			                                @foreach ($religionList as $x)
					                           <option value="{{$x->id}}">{{$x->name}}</option>
					                        @endforeach
			                            </select>
		                        	</div>
    				 			</div>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="g_contactno">Contact No</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="g_contactno" name="g_contactno">
						            </div>
						            <label class="col-md-2 control-label" for="g_occupation">Occupation</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="g_occupation" name="g_occupation">
						            </div>
    				 			</div>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="g_income">Guardian Income</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="g_income" name="g_income">
						            </div>
    				 			</div>
    				 			<div class="form-group row">
		                            <label class="col-sm-2 control-label" for="g_divisionid">Division</label>
		                            <div class="col-sm-4">
		                               <select onchange="changeAddress(this,'g_division')" class="form-control" name="g_divisionid" id="g_divisionid">
		                                    <option value="">SELECT</option>
		                                        @foreach ($divisionList as $x)
				                           			<option value="{{$x->id}}">{{$x->name}}</option>
				                        		@endforeach
		                                </select>
		                            </div>
		                            <label class="col-sm-2 control-label" for="g_districtid">District</label>
		                            <div class="col-sm-4">
		                               <select onchange="changeAddress(this,'g_district')" class="form-control" name="g_districtid" id="g_districtid">
											<option value="">SELECT</option>
												@foreach ($districtList as $x)
				                           			<option value="{{$x->id}}">{{$x->name}}</option>
				                        		@endforeach
		                                </select>
		                            </div>
                                </div>
                                <div class="form-group row">
		                            <label class="col-sm-2 control-label" for="g_thanaid">Thana</label>
		                            <div class="col-sm-4">
		                               <select onchange="changeAddress(this,'g_thana')" class="form-control" name="g_thanaid" id="g_thanaid">
											<option value="">SELECT</option>
											@foreach ($thanaList as $x)
				                           	<option value="{{$x->id}}">{{$x->name}}</option>
				                        	@endforeach
		                                </select>
		                            </div>
		                            <label class="col-sm-2 control-label" for="g_postofficeid">Post Offce</label>
		                            <div class="col-sm-4">
		                               <select onchange="" class="form-control" name="g_postofficeid" id="g_postofficeid">
											<option value="">SELECT</option>
											@foreach ($postofficeList as $x)
												<option value="{{$x->id}}">{{$x->name}}</option>
											@endforeach
		                                </select>
		                            </div>
                                </div>
                                <div class="form-group row">
		                            <label class="col-sm-2 control-label" for="g_postcode">Post Code</label>
		                            <div class="col-sm-4">
		                               <input type="text" class="form-control" id="g_postcode" name="g_postcode">
		                            </div>
		                            <label class="col-sm-2 control-label" for="g_localgovid">Union</label>
		                            <div class="col-sm-4">
		                               <select onchange="" class="form-control" name="g_localgovid" id="g_localgovid">
											<option value="">SELECT</option>
											@foreach ($localgovList as $x)
											<option value="{{$x->id}}">{{$x->name}}</option>
											@endforeach
		                                </select>
		                            </div>
                                </div>
                                <div class="form-group row">
		                            <label class="col-md-2 control-label" for="g_address">Address</label>
		                            <div class="col-md-4">
		                                <textarea onchange="" class="form-control" rows="4" id="g_address" name="g_address"></textarea>
		                             </div>
		                        </div>		
    				 		</fieldset>
    				 		<fieldset>
    				 			<legend>Previous Information</legend>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="prevschool">School Name</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="prevschool" name="prevschool">
						            </div>
						            <label class="col-md-2 control-label" for="lastclass">Last Class</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="lastclass" name="lastclass">
						            </div>
    				 			</div>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="result">Result</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="result" name="result">
						            </div>
						            <label class="col-md-2 control-label" for="passing_year">Passing Year</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="passing_year" name="passing_year">
						            </div>
    				 			</div>
    				 			<div class="form-group row">
    				 				<label class="col-md-2 control-label" for="tcno">TC NO</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="tcno" name="tcno">
						            </div>
						            <label class="col-md-2 control-label" for="tcissueddate">T.C Issued Date</label>
						            <div class="col-md-4">
						                <input type="text" class="form-control" id="tcissueddate" name="tcissueddate">
						            </div>
    				 			</div>
    				 		</fieldset>
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
					        <div class="form-group row">
					            <label class="col-md-2 control-label" for="father_picture">Father Picture</label>
					            <div class="col-md-4">
					                <input type="file" class="form-control-file" id="father_picture" name="father_picture">
					            </div>
					            <label class="col-md-2 control-label" for="mother_picture">Mother Picture</label>
					            <div class="col-md-4">
					                <input type="file" class="form-control-file" name="mother_picture" id="mother_picture">
					            </div>
					        </div>
    				 	<!-- </div> -->
    				 	<!-- <div class="form-group row">
					        <div class="offset-md-2 col-md-4">
					            <button type="button" id="prevBtn" class="btn btn-info waves-effect waves-light" onclick="nextPrev(-1)">Previous</button>
					            <button type="button" id="nextBtn" class="btn btn-info waves-effect waves-light" onclick="nextPrev(1)">Next</button>
					        </div>
					    </div> -->
					     <button type="submit" class="btn btn-default">Submit</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
@section('uniqueScript')
<!-- for admission form -->
<script src="{{asset('school/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('school/js/studentReg.js')}}"></script>
<script src="{{asset('school/js/app.js')}}"></script>
<script src="{{asset('school/js/baseUrl.js')}}"></script>
<script src="{{asset('school/js/admission.js')}}"></script>
<script type="text/javascript">
    var Script = function() {
  //date picker
  $(function() {
    $('#dob').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
    $('#tcissueddate').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
    });
  });

}();
</script>
@endsection