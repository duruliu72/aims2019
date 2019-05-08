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
                <h3>Admit Card</h3>
                <button class="print-btn" onclick="Print()">Print</button>
            </div>
            <div class="printarea min-height" id="printarea">
                <div class="row print-row">
                    <div class="col-sm-12 print-col">
                        <div class="institute_name margin_bottom">
                            <div class="institute_logo">
                                <img src="{{asset('clientAdmin/image/logo/school-logo.png')}}">
                            </div>
                            <div class="institute_txt">
                                <h3 class="institute_title">@if($bean['institute']!=null)
                                    {{$bean['institute']->name}}
                                    @else
                                    Secondary High School
                                    @endif
                                </h3>
                                <p class="institute_subtitle">Chouddagram Pourasova, Chauddagram , Comilla</p>
                            </div>
                        </div>
                        <div class="applicant margin_bottom">
                            <div class="applicant_item">
                                <div class="applicant_item_heading margin_bottom">
                                    <h4>Admission Test- Admit Card</h4>
                                </div>
                                <div class="applicant_item_desc">
                                    <div class="photo">
                                    <img src="{{asset('clientAdmin/admission/student/')}}/{{$bean['applicant']->picture}}">
                                    </div>
                                    <div class="info">
                                        <table>
                                            <tr>
                                                <td>Id <span>:</span></td>
                                                <td>{{$bean['applicant']->applicantid}}</td>
                                            </tr>
                                            <tr>
                                                <td>Name <span>:</span></td>
                                                <td>{{sprintf("%s %s %s",$bean['applicant']->firstName,$bean['applicant']->middleName,$bean['applicant']->lastName)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Serial <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->admssion_roll}}</td>
                                            </tr>
                                            <tr>
                                                <?php $dob=date("d/m/Y", strtotime($bean['applicant']->dob)) ?>
                                                <td>Date Of Birth <span>:</span></td>
                                                <td>{{$dob}}</td>
                                            </tr>
                                             <tr>
                                                <td>Gender <span>:</span></td>
                                                <td>{{$bean['applicant']->genderName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Reigion <span>:</span></td>
                                                <td>{{$bean['applicant']->religionName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Blood Group <span>:</span></td>
                                                <td>{{$bean['applicant']->bloodgroupName}}</td>
                                            </tr>
                                        </table>
                                        <div class="exam-details">
                                            <table>
                                                <tr>
                                                <?php $exam_date=date("d-m-Y", strtotime($bean['programofferinfo']->exam_date)) ?>
                                                    <td>Exam Date <span>:</span></td>
                                                    <td>{{$exam_date}}</td>
                                                    <?php
                                                        $dt=new DateTime($bean['programofferinfo']->exam_time);
                                                       ?>
                                                    <td>Exam Time <span>:</span></td>
                                                    <td>{{$dt->format('h:i a')}}</td>
                                                </tr>
                                            </table>
                                            <div class="total_marks">
                                                <p><span>Exam Marks(Total-)</span>{{" : "}}{{$bean['programofferinfo']->exam_marks}}</p>
                                            </div>
                                            <table>
                                                <tr>
                                                    @foreach($bean['subject'] as $x)
                                                        <td>{{$x->admissionSubject}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach($bean['subject'] as $x)
                                                        <td>{{$x->marks}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="classinfo">
                                        <table>
                                            <tr>
                                                <td>Session <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->sessionName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Class <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->programName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Group <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->groupName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Medium <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->mediumName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Shift <span>:</span></td>
                                                <td>{{$bean['programofferinfo']->shiftName}}</td>
                                            </tr>
                                    
                                        </table>
                                    </div>
                                </div>
                            </div>                       
                        </div>
                        <div class="controller_signature">
                            <div class="controller_signature content">
                                <img src="{{asset('clientAdmin/admission/emaxcontroller/')}}/{{'examcontroller.jpg'}}">
                                <p>Exam Controller</p>
                            </div>
                        </div>
                        <div class="print_footer">
                            <p>Admission Test-Applicant Copy generated by :<span>aims</span> || Power by www.adventure-soft.com</p>
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