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
                <h3>Admit Card</h3>
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
                    <form action="{{URL::to('admission/admitcard')}}"  method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group row">
                        <label class="col-sm-2 control-label" for="username">User Name</label>
                        <div class="col-sm-4">
                             <input type="text" class="form-control" placeholder="User Name" id="username" name="username">
                        </div>
                         <label class="col-sm-2 control-label" for="password">Password</label>
                        <div class="col-sm-4">
                             <input type="text" class="form-control" placeholder="password" id="password" name="password">
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