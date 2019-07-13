@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-laptop"></i>
        @if($institute!=null)
              {{$institute->name}}
            @else
              Dashboard
            @endif
      </h3>
        <ol class="breadcrumb">
              <li>Child Exam</li>
              @if($pList[2]->id==2)
              <li><a href="{{URL::to('/childexam')}}">Edit</a></li>
              @endif
              @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!='')
              <span style="float: right;font-size: 15px;">
                {{ $msg }}
              </span>
              @endif
          </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel margin-bottom-zero">
          <div class="master-exam">
            @if($masterExamNameList==null)
            <form action="{{URL::to('childexam')}}" method="POST">
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
                    <option  value="">SELECT</option>
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
                    <option  value="">SELECT</option>
                    @foreach ($shiftList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="groupid">Group</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                  <option  value="">SELECT</option>
                  @foreach ($groupList as $x)
                      <option value="{{$x->id}}">{{$x->name}}</option>
                  @endforeach
                  </select>
                </div>                          
              </div>
              <div style="text-align:right;">
                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="next" value="next">Next</button>
              </div>
            </form>
            @else
            <div class="row">
              <form action="{{URL::to('childexam')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="programofferid" value="{{$programoffer->id}}">
                <div class="col-md-8">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SL.NO</th>
                        <th>Subject Name</th>
                        <th>Code</th>
                        <th width="15%%">Marks</th>
                      </tr>
                    </thead>
                    <tbody id="childexamcourse">
                      <?php 
                        $sino=0;
                      ?>
                      @foreach($courseofferList as $x)
                      <tr>
                        <td>{{++$sino}}<input type="hidden" name="coursecodeid[{{$x->id}}]" value="{{$x->id}}"></td>
                        <td>{{$x->courseName}}</td>
                        <td>{{$x->courseCode}}</td>
                        <td class="no-padding" ><input  class="form-control" type="text" name="marks[{{$x->id}}]" value=""></td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                </div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <label class="col-sm-4 control-label" for="masterexamid">Master Exam</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="masterexamid" id="masterexamid">
                        <option  value="">SELECT</option>
                        @foreach ($masterExamNameList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                      </select>
                    </div>                 
                  </div>
                  <div class="from-group row">
                    <label class="col-sm-4 control-label" for="examnameid">Child Name</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="examnameid" id="examnameid">
                        <option  value="">SELECT</option>
                        @foreach ($childExamNameList as $x)
                            <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                      </select>
                    </div> 
                  </div>
                </div>
              </div>
              <div style="text-align:right;">
                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn_save" value="btn_save">Save</button>
              </div>
              </form>
            @endif
          </div>
        </section>
      </div>
  </div>
</section>
</section>
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/childexam.js')}}"></script>
<script type="text/javascript">
</script>
@endsection
