@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
        <ol class="breadcrumb">
          <!-- @if($pList[2]->id==2)
            <li><a href="{{URL::to('/meargeoffer')}}/{{'create'}}">New</a></li>
          @endif -->
          <li>Mark Distribution</li>
          @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!="")
                <span style="float: right;font-size: 15px;">
                  {{ $msg }}
                </span>
               @endif
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <div class="top-section">
          <form action="{{URL::to('markdistribution')}}" method="POST">
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
                     <label class="col-sm-2 control-label" for="groupid">Group</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                         <option value="">SELECT</option>
                         @foreach ($groupList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                       
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                         <option value="">SELECT</option>
                         @foreach ($mediumList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                     <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="shiftid" id="shiftid">
                         <option value="">SELECT</option>
                         @foreach ($shiftList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                           
                  </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('markdistribution')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
          </div>
          @if(isset($programofferinfo))
          <div class="programofferinfo programofferinfo--markdistribution">
                    <div class="programofferinfo_item">
                        <span>Session: {{$programofferinfo->sessionName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class Level: {{$programofferinfo->levelName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Class: {{$programofferinfo->programName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Medium: {{$programofferinfo->mediumName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Group: {{$programofferinfo->groupName}}</span>
                    </div>
                    <div class="programofferinfo_item">
                        <span>Shift: {{$programofferinfo->shiftName}}</span>
                    </div>
                </div>
          <div class="middle-section middle-section--markdistribution">
          <form action="{{URL::to('markdistribution')}}" method="POST">
              {{csrf_field()}}
              <input type="hidden" name="programofferid" value="{{$programofferinfo->id}}">
              <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-striped table-bordered table-hover customtable" id="courseoffer">
                        <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th>Subject Name</th>
                              @foreach($markCategoryList as $x)
                              <th>{{$x->name}}(Marks)</th>
                              @endforeach
                              <th width="2%"><input id="markcheckid" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $id=0; ?>
                        @foreach($courseCodeList as $course)
                          @if($course->mcoursecodeid!=0)
                          <tr>
                            <td>{{++$id}}</td>         
                            <td>
                              {{$course->name}}<br>Marks({{$course->coursemark}})
                            </td>
                            <?php
                              $displayList=array();
                            ?>
                            @foreach($selectedlist[$course->id] as $cat)
                                <td>
                                  <div class="form-group">                                 
                                      <input class="form-control" type="text" name="distribution_mark[{{$course->id}}][{{$cat->id}}]" value="{{$cat->distribution_mark}}" />
                                  </div>
                                  <div style="text-align:center;">
                                    <input type="radio" <?php echo ($cat->passtypeid==1) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="1">1
                                    <input type="radio" <?php echo ($cat->passtypeid==2) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="2">2
                                    <input type="radio" <?php echo ($cat->passtypeid==3) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="3">3
                                    <input type="radio" <?php echo ($cat->passtypeid==4) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="4">4
                                  </div>
                                </td>
                            @endforeach
                            <td><span style='font-size:18px;'>&#10003;</span></td>    
                          </tr>
                          @else
                          <tr>
                            <td>{{++$id}}</td>         
                            <td>
                              {{$course->name}}<br>Marks({{$course->coursemark}})
                            </td>
                            <?php $passid=1; ?>
                            @foreach($markCategoryList as $cat)
                            <td>
                              <div class="form-group">
                                <input class="form-control" type="text" name="distribution_mark[{{$course->id}}][{{$cat->id}}]" />
                              </div>
                              <div style="text-align:center;">
                                <input type="radio" <?php echo ($passid==1) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="1">1
                                <input type="radio" <?php echo ($passid==2) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="2">2
                                <input type="radio" <?php echo ($passid==3) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="3">3
                                <input type="radio" <?php echo ($passid==4) ? 'checked':''; ?> name="passtypeid[{{$course->id}}][{{$cat->id}}]" value="4">4
                              </div>
                            </td>
                            <?php $passid++; ?>
                            @endforeach
                            <td><input class="markcheck" type="checkbox" name="checkbox[{{$course->id}}]"></td>
                            </tr>
                          @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="save_btn" value="save_btn">Save</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('markdistribution')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
              </form>
          </div>
          @endif
          <!-- <div class="bottom-section bottom_form bottom-section--markdistribution">
              <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th width="10px">SL NO</th>
                    <th>Class Information</th>
                    <th>Course</th>
                    <th>Total Marks</th>
                    <th>Mark Category</th>
                    @if($pList[4]->id==4)
                    <th width="10px">Del</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  <?php $id=0; ?>
                  @foreach($result as $x)
                  <tr>
                    <td>{{++$id}}</td>
                    <td>{{$x->programdetails}}</td>
                    <td>{{$x->meargeName}}</td>
                    <td>{{$x->meargeCourseCode}}</td>
                    <td>{{$x->meargeCourseName}}</td>
                    @if($pList[4]->id==4)
                    <td>
                        <form  action="{{URL::to('/markdistribution')}}/{{'deleteMerge'}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
                            @method('DELETE')
                            {!! csrf_field() !!}
                            <input type="hidden" name="programofferid" value="{{$x->programofferid}}">
                            <input type="hidden" name="meargeCourseCodeid" value="{{$x->meargeCourseCodeid}}">
                            <button class="delete_btn"> <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span></button>
                        </form>
                    </td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th width="10px">SL NO</th>
                    <th>Class Information</th>
                    <th>Course</th>
                    <th>Total Marks</th>
                    <th>Mark Category</th>
                    @if($pList[4]->id==4)
                    <th width="10px">Del</th>
                    @endif
                  </tr>
                </tfoot>
              </table>
          </div>
           -->
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
<script src="{{asset('clientAdmin/js/markdistribution.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function() {
  var table = $('#example').DataTable( {
    responsive: true
  } );

  new $.fn.dataTable.FixedHeader( table );
} );
</script>
@endsection
