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
                                <h3 class="institute_title">{{$instituteinfo->name}}</h3>
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
                                        <img src="{{asset('clientAdmin/image/picture/Kalam.png')}}">
                                    </div>
                                    <div class="info">
                                        <table>
                                            <tr>
                                                <td>Alpplicantid <span>:</span></td>
                                                <td>{{$admissionresult->applicantid}}</td>
                                            </tr>
                                            <tr>
                                                <td>Roll <span>:</span></td>
                                                <td>{{$applicantinfo->admssion_roll}}</td>
                                            </tr>
                                            <tr>
                                                <td>Name <span>:</span></td>
                                                <td>{{$applicantinfo->name}}</td>
                                            </tr>
                                            <tr>
                                                <?php $dob=date("d/m/Y", strtotime($applicantinfo->dob)) ?>
                                                <td>Date Of Birth <span>:</span></td>
                                                <td>{{$dob}}</td>
                                            </tr>
                                             <tr>
                                                <td>Gender <span>:</span></td>
                                                <td>{{$applicantinfo->genderName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Reigion <span>:</span></td>
                                                <td>{{$applicantinfo->religionName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Blood Group <span>:</span></td>
                                                <td>{{$applicantinfo->bloodgroupName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Merit Position <span>:</span></td>
                                                <td>{{$admissionresult->serialno}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="classinfo">
                                        <table>
                                            <tr>
                                                <td>Session <span>:</span></td>
                                                <td>{{$applicantinfo->sessionName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Class <span>:</span></td>
                                                <td>{{$applicantinfo->programName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Group <span>:</span></td>
                                                <td>{{$applicantinfo->groupName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Medium <span>:</span></td>
                                                <td>{{$applicantinfo->mediumName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Shift <span>:</span></td>
                                                <td>{{$applicantinfo->shiftName}}</td>
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