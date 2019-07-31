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
            <li>Academic Transcript</li>
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
        <section class="panel no_border">
          <div class="panel-body no-border no_border">
            @if($transcripts==null)
              <div class="top_form">
                  <form action="{{URL::to('transcripts')}}" method="POST">
                  {{csrf_field()}}
                  <div class="form-group row">
                  <label class="col-sm-2 control-label" for="programid">Program</label>
                  <div class="col-sm-4">
                    <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                        <option  value="">SELECT</option>
                        @foreach ($programList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
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
                    <select  class="form-control" name="groupid" id="groupid">
                        <option value="">SELECT</option>
                        @foreach ($groupList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                    </select>
                  </div>                              
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="examnameid">Exam</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="examnameid" id="examnameid">
                        <option value="">SELECT</option>
                        @foreach ($examNameList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                    </select>
                  </div>                           
                </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="btn-container">
                        <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search Student</button>
                        <a class="btn btn-info refresh-btn" href="{{URL::to('transcripts')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            @else
              @foreach($transcripts as $student)
              <div class="row no_margin">
                <div class="col-lg-12">
                  <section class="panel no_border no_margin">
                    <div class="panel-body no_border no_padding">
                      <div class="academic-transcripts">
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
                                  <!-- Start compalsary subject -->
                                  @foreach($student->mearge_courses as $key=>$mc)
                                    <?php 
                                      $courseSpan=false;
                                      $grade_latterSpan=false;
                                      if($mc->course_frequency>1){
                                        $courseSpan=true;
                                        $grade_latterSpan=true;
                                      }
                                    ?>
                                    @if($mc->coursetypeid==1)
                                      @foreach($mc->courses as $c)
                                      <tr>
                                        <td>{{++$id}}</td>
                                        <?php 
                                        if($courseSpan && $mc->course_frequency>1){ ?>
                                            <td rowspan="2">{{$mc->mearge_courseName}}</td>
                                        <?php   $courseSpan=false;
                                        }elseif($mc->course_frequency==1){ ?>
                                          <td>{{$mc->mearge_courseName}}</td>
                                        <?php }
                                        ?>
                                        <td>{{$c->courseCode}}</td>
                                        <td>{{$c->coursemark}}</td>
                                        <td>
                                          @foreach($c->marks_cats as $mark_c)
                                            @if($mark_c->cat_pass_status==1)
                                              <span>{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @else
                                              <span style="color:red;">{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @endif
                                          @endforeach
                                        </td>
                                        <td>{{sprintf('%.2f',$c->std_obt_mark)}}</td>
                                        <?php 
                                          if($grade_latterSpan && $mc->course_frequency>1){ ?>
                                              <td rowspan="2">{{$mc->gradeletter}}</td>
                                              <td rowspan="2">{{$mc->gradepoint}}</td>
                                        <?php   $grade_latterSpan=false;
                                          }elseif($mc->course_frequency==1){ ?>
                                                <td>{{$mc->gradeletter}}</td>
                                                <td>{{$mc->gradepoint}}</td>
                                          <?php }
                                        ?>
                                      </tr>
                                      @endforeach
                                    @endif
                                  @endforeach
                                  <!-- End compalsary subject -->
                                  <tr>
                                    <td colspan="8" style="text-align: left;">Optional Subject:</td>
                                  </tr>
                                  <!-- Start Optional subject -->
                                  @foreach($student->mearge_courses as $key=>$mc)
                                    <?php 
                                      $courseSpan=false;
                                      $grade_latterSpan=false;
                                      if($mc->course_frequency>1){
                                        $courseSpan=true;
                                        $grade_latterSpan=true;
                                      }
                                    ?>
                                    @if($mc->coursetypeid==2)
                                      @foreach($mc->courses as $c)
                                      <tr>
                                        <td>{{++$id}}</td>
                                        <?php 
                                        if($courseSpan && $mc->course_frequency>1){ ?>
                                            <td rowspan="2">{{$mc->mearge_courseName}}</td>
                                        <?php   $courseSpan=false;
                                        }elseif($mc->course_frequency==1){ ?>
                                          <td>{{$mc->mearge_courseName}}</td>
                                        <?php }
                                        ?>
                                        <td>{{$c->courseCode}}</td>
                                        <td>{{$c->coursemark}}</td>
                                        <td>
                                          @foreach($c->marks_cats as $mark_c)
                                            @if($mark_c->cat_pass_status==1)
                                              <span>{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @else
                                              <span style="color:red;">{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @endif
                                          @endforeach
                                        </td>
                                        <td>{{sprintf('%.2f',$c->std_obt_mark)}}</td>
                                        <?php 
                                          if($grade_latterSpan && $mc->course_frequency>1){ ?>
                                              <td rowspan="2">{{$mc->gradeletter}}</td>
                                              <td rowspan="2">{{$mc->gradepoint}}</td>
                                        <?php   $grade_latterSpan=false;
                                          }elseif($mc->course_frequency==1){ ?>
                                                <td>{{$mc->gradeletter}}</td>
                                                <td>{{$mc->gradepoint}}</td>
                                          <?php }
                                        ?>
                                      </tr>
                                      @endforeach
                                    @endif
                                  @endforeach
                                  <!-- End Optional subject -->
                                  <tr>
                                    <td colspan="8" style="text-align: left;">Additional Subject:</td>
                                  </tr>
                                  <!-- Start Additional subject -->
                                  @foreach($student->mearge_courses as $key=>$mc)
                                    <?php 
                                      $courseSpan=false;
                                      $grade_latterSpan=false;
                                      if($mc->course_frequency>1){
                                        $courseSpan=true;
                                        $grade_latterSpan=true;
                                      }
                                    ?>
                                    @if($mc->coursetypeid==3)
                                      @foreach($mc->courses as $c)
                                      <tr>
                                        <td>{{++$id}}</td>
                                        <?php 
                                        if($courseSpan && $mc->course_frequency>1){ ?>
                                            <td rowspan="2">{{$mc->mearge_courseName}}</td>
                                        <?php   $courseSpan=false;
                                        }elseif($mc->course_frequency==1){ ?>
                                          <td>{{$mc->mearge_courseName}}</td>
                                        <?php }
                                        ?>
                                        <td>{{$c->courseCode}}</td>
                                        <td>{{$c->coursemark}}</td>
                                        <td>
                                          @foreach($c->marks_cats as $mark_c)
                                            @if($mark_c->cat_pass_status==1)
                                              <span>{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @else
                                              <span style="color:red;">{{$mark_c->markcatName}}{{":"}} {{$mark_c->std_obt_mark}}</span>
                                            @endif
                                          @endforeach
                                        </td>
                                        <td>{{sprintf('%.2f',$c->std_obt_mark)}}</td>
                                        <?php 
                                          if($grade_latterSpan && $mc->course_frequency>1){ ?>
                                              <td rowspan="2">{{$mc->gradeletter}}</td>
                                              <td rowspan="2">{{$mc->gradepoint}}</td>
                                        <?php   $grade_latterSpan=false;
                                          }elseif($mc->course_frequency==1){ ?>
                                                <td>{{$mc->gradeletter}}</td>
                                                <td>{{$mc->gradepoint}}</td>
                                          <?php }
                                        ?>
                                      </tr>
                                      @endforeach
                                    @endif
                                  @endforeach
                                  <!-- End Additional subject -->
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
                                    <td>{{sprintf('%.2f',$student->common_marks)}}</td>
                                    <td>{{sprintf('%.2f',$student->obt_common_marks)}}</td>
                                  </tr>
                                  <tr>
                                    <td>Grand Total Marks</td>
                                    <td>{{$student->tot_marks}}</td>
                                    <td>{{sprintf('%.2f',$student->tot_obt_marks)}}</td>
                                  </tr>
                                </tbody>
                              </table>
                              <div class="position">
                                  <p>{{sprintf("%s %s","Position :",$student->class_position)}}</p>
                                  <p>{{sprintf("%s %s","Position :",$student->section_position)}}</p>
                              </div>
                          </div>
                          <div class="academic-transcript__grand-result__right">
                          <table>
                                <tbody>
                                  <tr>
                                    <td>GPA</td>
                                    <td>{{sprintf("%.2f",$student->gpa)}}</td>
                                  </tr>
                                  <tr>
                                    <td>Letter Grade</td>
                                    <td>{{$student->letter}}</td>
                                  </tr>
                                  <tr>
                                    <td>Percentage Marks</td>
                                    <td>{{sprintf("%.2f",$student->percentage_mark)}}%</td>
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
              @endforeach
            @endif
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