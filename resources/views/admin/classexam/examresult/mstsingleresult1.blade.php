@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet" media="all">
<link href="{{asset('clientAdmin/css/print.css')}}" rel="stylesheet" media="print">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper no-padding no-margin">
        <div class="row no-print">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>
            @if($institute!=null)
              {{$institute->name}}
            @else
              Dashboard
            @endif</h3>
             <ol class="breadcrumb">
                <li>Academic Result</li>
                @if($msg!="")
                  <span style="float: right;font-size: 15px;">
                  {{ $msg }}
                  </span>
                @endif
                @if ($errors->any())
                <span style="float: right;font-size: 15px;">{{$errors->all()[0]}}</span>
                @endif
                @if(session()->has('msg'))
                <span style="float: right;font-size: 15px;">
                  {{ session()->get('msg') }}
                </span>
                @endif
                <button class="print-btn" onclick="Print()">Print</button>
            </ol>
          </div>
        </div>
        <div class="row no-margin">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body no-border">
                <div class="academic-transcript">
                  <div class="academic-transcript__heading">
                      <div class="institute-logo">
                        <img src="{{asset('clientAdmin/image/logo/institute_logo.png')}}">
                      </div>
                      <div class="institute-title">
                        <h2 class="institute-name">{{$instituteObj->name}}</h2>
                        <p class="institute-add">{{sprintf("%s, %s, %s",$instituteObj->localgovName,$instituteObj->thanaName,$instituteObj->districtName)}}</p>
                        <h3 class="std-transcript">ACADEMIC TRANSCRIPT</h3>
                        <h3 class="exam-name">{{$exam->name."' ".$programofferinfo->sessionName}}</h3>
                      </div>
                  </div>
                  <div class="academic-transcript__student">
                    <div class="student-img item">
                      <img src="{{asset('clientAdmin/admission/student/')}}/{{$student->picture}}">
                    </div>
                    <div class="student-info item">
                      <table>
                        <tr>
                          <td>Student ID</td>
                          <td><span>:</span> <span>{{$student->applicantid}}</span></td>
                        </tr>
                        <tr class="name">
                          <td>Name</td>
                          <td><span>:</span> <span>{{sprintf("%s %s %s",$student->firstName,$student->middleName,$student->lastName)}}</span></td>
                        </tr>
                        <tr>
                          <td>Roll No.</td>
                          <td><span>:</span> <span>{{$student->classroll}}</span></td>
                        </tr>
                        <tr>
                          <td>Class</td>
                          <td><span>:</span> <span>{{$programofferinfo->programName}}</span></td>
                        </tr>
                        <tr>
                          <td>Medium</td>
                          <td><span>:</span> <span>{{$programofferinfo->mediumName}}</span></td>
                        </tr>
                        <tr>
                          <td>Group</td>
                          <td><span>:</span> <span>{{$programofferinfo->groupName}}</span></td>
                        </tr>
                        <tr>
                          <td>Shift</td>
                          <td><span>:</span> <span>{{$programofferinfo->shiftName}}</span></td>
                        </tr>
                      </table>
                    </div>
                    <div class="grade-letter item">
                        <table>
                            <thead>
                                <tr>
                                  <th>GL</th>
                                  <th>Marks</th>
                                  <th>GP</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($point_letters as $x)
                              <tr>
                                <td>{{$x->name}}</td>
                                <td>{{$x->from_mark."-".$x->to_mark}}</td>
                                <td>{{$x->gradepoint}}</td>
                              <tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="academic-transcript__result">
                    <div class="compulsory">
                        <table>
                        <thead>
                          <tr>
                            <th>Sl No.</th>
                            <th>Subject Name</th>
                            <th>Code</th>
                            <th>Full Marks</th>
                            <th>Marks Obtained</th>
                            <th>Marks</th>
                            <th>L.G.</th>
                            <th>GP</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $id=0; ?>
                            @foreach($student->meargeCourseList as $key=>$m_course)
                            @if($m_course->coursetypeid==1)
                            <tr>
                                <td>{{++$id}}</td>
                                <td>{{$m_course->courseName}}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{$m_course->mearge_point}}</td>
                                <td>{{$m_course->mearge_letter}}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                            <td colspan="8" style="text-align: left;">Optional Subject:</td>
                            </tr>
                            @foreach($student->meargeCourseList as $key=>$m_course)
                            @if($m_course->coursetypeid==2)
                            <tr>
                                <td>{{++$id}}</td>
                                <td>{{$m_course->courseName}}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{$m_course->mearge_point}}</td>
                                <td>{{$m_course->mearge_letter}}</td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="academic-transcript__grand-result">
                    <div class="academic-transcript__grand-result__left">
                        <table>
                          <thead>
                            <tr>
                              <th>Description</th>
                              <th>Tot Marks</th>
                              <th>Tot Obt Marks</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Total Common Marks</td>
                              <td>{{$student->common_marks}}</td>
                              <td>{{$student->obt_common_marks}}</td>
                            </tr>
                            <tr>
                              <td>Grand Total Marks</td>
                              <td>{{$student->grand_marks}}</td>
                              <td>{{$student->grand_obt_marks}}</td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="position">
                            <p>{{sprintf("%s %s","Position :",$student->position)}}</p>
                        </div>
                    </div>
                    <div class="academic-transcript__grand-result__right">
                    <table>
                          <tbody>
                            <tr>
                              <td>GPA</td>
                              <td>{{$student->std_gpa}}</td>
                            </tr>
                            <tr>
                              <td>Letter Grade</td>
                              <td>{{$student->std_letter}}</td>
                            </tr>
                            <tr>
                              <td>Percentage Marks</td>
                              <td>{{sprintf("%.2f",100)}}%</td>
                            </tr>
                            <tr>
                              <td>Failed Subject</td>
                              <td>{{$student->common_fail_sub}}</td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="academic-transcript__signature">
                      <div class="class_tacher-signature">
                        <img src="{{asset('clientAdmin/admission/emaxcontroller/')}}/{{'examcontroller.jpg'}}">
                        <p>Class Teacher</p>
                      </div>
                      <div class="authorized-signature">
                        <img src="{{asset('clientAdmin/admission/emaxcontroller/')}}/{{'examcontroller.jpg'}}">
                        <p>Authorized Signature</p>
                      </div>
                  </div>
                  <div class="academic-transcript__footer">
                      <p>Result generated by:   aims  ||  Powerd by:  www.adventure-soft.com</p>
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
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/examresult.js')}}"></script>
<script src="{{asset('clientAdmin/js/print.js')}}"></script>
@endsection