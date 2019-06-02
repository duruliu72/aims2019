@extends('school.layouts.main')
@section('title')
 <title>Admission-Applicant view </title>
@endsection
@section('uniqueStyle')
<link href="{{asset('school/css/print.css')}}" rel="stylesheet" media="print">
<link href="{{asset('school/css/screen.css')}}" rel="stylesheet" media="screen">
@endsection
@section('content')
    <div id="admission">
        <div class="container">
            <div class="heading">
                <h3>Admission result</h3>
                <button class="print-btn" onclick="Print()">Print</button>
            </div>
            <div class="printarea min-height" id="printarea">
                <div class="row print-row">
                    <div class="col-sm-12 print-col">
                        <div class="institute_name margin_bottom">
                            <div class="institute_logo">
                                <img src="{{asset('clientAdmin/image/logo/institute_logo.png')}}">
                            </div>
                            <div class="institute_txt">
                                <h3 class="institute_title"> 
                                    @if($institute!=null)
                                        {{$institute->name}}
                                    @else
                                        Default Institute Name
                                    @endif
                                </h3>
                                <p class="institute_subtitle">Chouddagram Pourasova, Chauddagram , Comilla</p>
                            </div>
                        </div>
                        <div class="applicant margin_bottom">
                            <div class="applicant_item">
                                <div class="applicant_item_heading margin_bottom">
                                    <h4>Admission Test- Result</h4>
                                </div>
                                <div class="applicant_item_desc">
                                    <div class="photo">
                                    <img src="{{asset('clientAdmin/admission/student/')}}/{{$result['applicant'][0]->picture}}">
                                    </div>
                                    <div class="info">
                                        <table>
                                            <tr>
                                                <td>Alpplicantid <span>:</span></td>
                                                <td>{{$result['applicant'][0]->applicantid}}</td>
                                            </tr>
                                            <tr>
                                                <td>Roll <span>:</span></td>
                                                <td>{{$result['admissionApplicant']->admssion_roll}}</td>
                                            </tr>
                                            <tr>
                                                <td>Name <span>:</span></td>
                                                <td>{{sprintf("%s %s %s",$result['applicant'][0]->firstName,$result['applicant'][0]->middleName,$result['applicant'][0]->lastName)}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Merit Position <span>:</span></td>
                                                <td>{{$result['applicant'][2]}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="classinfo">
                                        <table>
                                            <tr>
                                                <td>Session <span>:</span></td>
                                                <td>{{$result['programofferinfo']->sessionName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Class <span>:</span></td>
                                                <td>{{$result['programofferinfo']->programName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Group <span>:</span></td>
                                                <td>{{$result['programofferinfo']->groupName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Medium <span>:</span></td>
                                                <td>{{$result['programofferinfo']->mediumName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Shift <span>:</span></td>
                                                <td>{{$result['programofferinfo']->shiftName}}</td>
                                            </tr>
                                    
                                        </table>
                                    </div>
                                </div>
                            </div>                       
                        </div>
                        <div class="controller_signature">
                            <div class="controller_signature content">
                                <!-- <img src=""> -->
                                <p>Exam Controller</p>
                            </div>
                        </div>
                        <div class="print_footer">
                            <p>Admission Test-Result Copy generated by :<span>aims</span> || Power by www.adventure-soft.com</p>
                        </div>
                    </div>
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