@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <a style="position: absolute;top: 25px;right: 50px;" href="{{URL::to('/student')}}">Refresh</a>
              @if ($errors->any())
                   <ol class="breadcrumb">
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                   </ol>
              @endif
              @if(session()->has('msg'))
              <ol class="breadcrumb">
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              </ol>
              @endif
              @if($msg!="")
              <ol class="breadcrumb">
              <span style="float: right;font-size: 15px;">
                {{ $msg }}
              </span>
              </ol>
              @endif
          </div>
        </div>
        <section class="panel">
            <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="student">
                        <div class="student__photo">
                            <img src="{{asset('clientAdmin/admission/student')}}/{{$bean['applicant'][0]->picture}}">
                        </div>
                        <div class="student__info">
                        <table>
                                <tr>
                                    <td>Id <span>:</span></td>
                                    <td>{{$bean['applicant'][0]->applicantid}}</td>
                                </tr>
                                <tr>
                                    <td>Name <span>:</span></td>
                                    <td>{{$bean['applicant'][0]->firstName}}</td>
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
                                    <td>Shift <span>:</span></td>
                                    <td>{{$bean['programofferinfo']->shiftName}}</td>
                                </tr>
                                <tr>
                                    <td>Class <span>:</span></td>
                                    <td>{{$bean['programofferinfo']->mediumName}}</td>
                                </tr>
                                 <tr>
                                    <td>Session <span>:</span></td>
                                    <td>{{$bean['programofferinfo']->sessionName}}</td>
                                </tr>
                                <tr>
                                    <td>Merit Position <span>:</span></td>
                                    <td>{{$bean['applicant'][2]}}</td>
                                </tr>
                               
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="student">
                       <div class="student__form">
                        <form action="{{URL::to('student')}}/{{'create'}}" method="POST">
                            {{csrf_field()}}
                               <div class="from-group row" style="margin-bottom:15px;">
                                    <label class="col-sm-2 control-label" for="sectionid">Section</label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="programofferid" value="{{$bean['programofferinfo']->id}}">
                                        <input type="hidden" name="applicantid" value="{{$bean['applicant'][0]->applicantid}}">
                                        <select class="form-control" name="sectionid" id="sectionid">
                                            @foreach($sectionList as $x)
                                            <option value="{{$x->id}}">{{$x->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 control-label" for="classroll">Roll No:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="classroll" id="classroll">
                                    </div>
                               </div>
                                <table class="table table-striped table-bordered table-hover customtable" id="studentcourse">
                                    <thead>
                                        <tr>
                                            <th width="2%">#</th>
                                            <th>Course</th>
                                            <th>Course Type</th>
                                            <th width="2%"><input id="markcheckid" type="checkbox"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $id=0; ?>
                                    @foreach($courseList as $courseCode)
                                        <tr>
                                            <td>{{++$id}}</td>
                                            <td>{{$courseCode->courseNameWithCode}}</td>
                                            <td>
                                            <select class="form-control" name="coursetypeid[{{$courseCode->coursecodeid}}]" id="coursetypeid">
                                            @foreach($courseTypeList as $x)
                                            <option value="{{$x->id}}">{{$x->name}}</option>
                                            @endforeach
                                            </select>
                                            </td>
                                            <!-- <td><span style='font-size:18px;'>&#10003;</span></td>     -->
                                            <td><input class="markcheck" type="checkbox" name="checkbox[{{$courseCode->coursecodeid}}]"></td>
                                           
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-default pull-right" name="save" value="student_save">Save</button>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/student.js')}}"></script>
@endsection