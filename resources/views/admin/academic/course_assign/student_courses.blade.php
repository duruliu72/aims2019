@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li> Assign Subject Information</li>
              @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!=null)
              <span style="float: right;font-size: 15px;">
                {{ $msg }}
              </span>
              @endif
            </ol>
          </div>
        </div>
        <div class="row" style="background:#fff;">
          <div class="col-md-4" style="padding-top:15px;padding-bottom:15px;">
            <div class="widget-box">
              <div class="widget-heading">
                <h4><i class="fa fa-user"></i>&nbsp;Student Short Profile</h4>
              </div>
              <ul class="course_assign">
                <li><span></span><span>Student ID :</span><span>{{$student->r_studentid}}</span></li>
                <li><span></span><span>Student Name :</span><span>{{$student->firstName}} {{$student->middleName}} {{$student->lastName}}</span></li>
                <li><span></span><span>Class :</span><span>{{$programofferinfo->programName}}</span></li>
                <li><span></span><span>Medium :</span><span>{{$programofferinfo->mediumName}}</span></li>
                <li><span></span><span>Shift :</span><span>{{$programofferinfo->shiftName}}</span></li>
                <li><span></span><span>Group :</span><span>{{$programofferinfo->groupName}}</span></li>
                <li><span></span><span>Section :</span><span>{{$programofferinfo->sessionName}}</span></li>
                <li><span></span><span>Roll No:</span><span>{{$student->classroll}}</span></li>
              </ul>
            </div>
          </div><!--/.col-->
          <div class="col-md-8" style="padding-top:15px;padding-bottom:15px;">
            <div class="widget-box">
              <div class="widget-heading">
                <h4><i class="fa fa-external-link"></i>&nbsp;Subject List By Category</h4>
              </div>
              <form action="{{URL::to('editassigncourse')}}/{{$student->programofferid}}/{{$student->sectionid}}/{{$student->id}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="programofferid" value="{{$student->programofferid}}">
                <input type="hidden" name="sectionid" value="{{$student->sectionid}}">
                <input type="hidden" name="studentid" value="{{$student->id}}">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                            <th>SL NO</th>
                            <th>Subject Category</th>
                            <th>Subject Name</th>
                            <th>Assign Teacher</th>
                            <th>Mark</th>
                            <th>Select</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $id=0; ?>
                          @foreach($student->courses as $course)
                            <tr>
                              <td>{{++$id}}</td>
                              <td>
                                <select class="form-control" name="coursetypeid[{{$course->courseid}}]" id="coursetypeid">
                                @foreach ($courseTypeList as $x)
                                  @if($x->id==$course->coursetypeid)
                                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                                  @else
                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                              </td>
                              <td>{{$course->courseName}} {{$course->courseCode}}</td>
                              <td>{{$course->first_name}} {{$course->middle_name}} {{$course->last_name}}</td>
                              <td>{{$course->coursemark}}</td>
                              @if($course->coursetypeid!=0)
                              <td><input checked type="checkbox" name="coursecheck[{{$course->courseid}}]" value="{{$course->courseid}}"></td>
                              @else
                              <td><input type="checkbox" name="coursecheck[{{$course->courseid}}]" value="{{$course->courseid}}"></td>
                              @endif
                            </tr>
                          @endforeach
                        </form>
                      </tbody>
                  </table>
                </div>
                <button type="submit" class="btn btn-danger" name="btn_update" value="btn_update">
                      <i class="ace-icon fa fa-pencil-square-o align-top bigger-125"></i>
                      Update Subject Assign
              </button>
              </form>
            </div>
          </div>
        </div><!--/.row-->
      </section>
    </section>

@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/studentlist.js')}}"></script>
@endsection