@extends('school.layouts.main')
@section('title')
 <title>Admission-Applicant view </title>
@endsection
@section('uniqueStyle')
<link href="{{asset('school/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
    <div id="admission">
    	<div class="container">
    		<div class="heading">
    			<h3>Applicant Copy</h3>
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
    			<div class="col-sm-12 min-height">
                    <form action="{{URL::to('admission/applicantcopy')}}"  method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group row">
                        <label class="col-sm-2 control-label" for="applicantid">Applicant ID</label>
                        <div class="col-sm-4">
                             <input type="text" class="form-control" placeholder="Applicant Id" id="applicantid" name="applicantid" value="{{ old('applicantid') }}">
                        </div>
                         <label class="col-sm-2 control-label" for="pin_code">PIN Code</label>
                        <div class="col-sm-4">
                             <input autocomplete="off" type="text" class="form-control" placeholder="Pin Code" id="pin_code" name="pin_code" value="{{ old('pin_code') }}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 offset-sm-2">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
@section('uniqueScript')
<!-- for admission form -->
<script src="{{asset('school/js/print.js')}}"></script>
<script type="text/javascript">

</script>
@endsection