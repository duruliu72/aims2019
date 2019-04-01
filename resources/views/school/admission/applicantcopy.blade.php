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
    			<h3>Applicant Copy</h3>
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
                                    <h4>Applicant Copy</h4>
                                </div>
                                <div class="applicant_item_desc">
                                    <div class="photo">
                                        <img src="{{asset('clientAdmin/image/picture/Kalam.png')}}">
                                    </div>
                                    <div class="info">
                                        <table>
                                            <tr>
                                                <td>Id <span>:</span></td>
                                                <td>{{$applicantinfo->applicantid}}</td>
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
                                        </table>
                                    </div>
                                    <div class="classinfo">
                                        <table>
                                            <tr>
                                                <td>Class <span>:</span></td>
                                                <td>{{$applicantinfo->programName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Shift <span>:</span></td>
                                                <td>{{$applicantinfo->shiftName}}</td>
                                            </tr>
                                            <tr>
                                                <td>Group <span>:</span></td>
                                                <td>{{$applicantinfo->groupName}}</td>
                                            </tr>
                                             <tr>
                                                <td>Session <span>:</span></td>
                                                <td>{{$applicantinfo->sessionName}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="applicant_item">
                                <div class="applicant_item_heading margin_bottom">
                                    <h4>Parent's Information</h4>
                                </div>
                                <div class="applicant_item_parentinfo">
                                    <table>
                                        <tr>
                                            <td>Father's Name <span>:</span></td>
                                            <td>{{$applicantinfo->fatherName}}</td>
                                            <td>Mother's Name <span>:</span></td>
                                            <td>{{$applicantinfo->motherName}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone <span>:</span></td>
                                            <td>{{$applicantinfo->father_Phone}}</td>
                                            <td>Phone <span>:</span></td>
                                            <td>{{$applicantinfo->mother_Phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Profession <span>:</span></td>
                                            <td>{{$applicantinfo->f_occupation}}</td>
                                            <td>Profession <span>:</span></td>
                                            <td>{{$applicantinfo->m_occupation}}</td>
                                        </tr>
                                        <tr>
                                            <td>NID <span>:</span></td>
                                            <td>{{$applicantinfo->father_nid}}</td>
                                            <td>NID <span>:</span></td>
                                            <td>{{$applicantinfo->mother_nid}}</td>
                                        </tr>
                                        <tr>
                                            <td>Annual Income <span>:</span></td>
                                            <td>{{$applicantinfo->parent_income}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="applicant_item">
                                <div class="applicant_item_heading margin_bottom">
                                    <h4>Contact information</h4>
                                </div>
                                <div class="applicant_item_contact">
                                    <table>
                                        <tr>
                                            <td>Present Address <span>:</span></td>
                                            <td>{{$presentAddress->address}},{{$presentAddress->localgovName}},<br>{{$presentAddress->thanaName}},{{$presentAddress->districtName}}</td>
                                            <td>Permanent Address <span>:</span></td>
                                            <td>{{$permanentAddress->address}},{{$permanentAddress->localgovName}},<br>{{$permanentAddress->thanaName}},{{$permanentAddress->districtName}}</td>
                                        </tr>
                                    </table>
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