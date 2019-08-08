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
          <li>Mark Distribution &nbsp;&nbsp;&nbsp;<a href="{{URL::to('markdistribution')}}">Create</a></li>
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
                    <label class="col-sm-2 control-label" for="sessionid">Session</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'session')" class="form-control" name="sessionid" id="sessionid">
                          <option  value="">SELECT</option>
                         @foreach ($sessionList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="programlabelid">Class Label</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'programlabel')" class="form-control" name="programlabelid" id="programlabelid">
                         <option value="">SELECT</option>
                         @foreach ($plabelList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                     
                  </div>
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
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('markdistribution')}}/{{'edit'}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
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
                        <span>Class Level: {{$programofferinfo->programLabel}}</span>
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
                              <th>Tot Mark</th>
                              <th width="2%"><input id="markcheckid" type="checkbox"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $id=0; ?>
                        @foreach($courseList as $key=>$course)
                          <tr id="subject_mark{{$key}}" class="subject_mark">
                            <td>{{++$id}}</td>         
                            <td>
                              {{$course->courseName}}<br>(<span class="coursemark">{{$course->coursemark}}</span>)
                            </td>
                            <?php
                              $displayList=array();
                            ?>
                            @foreach($selectedlist[$course->id] as $cat)
                                <td>
                                  <div data-raw="subject_mark{{$key}}" class="course_subcat">
                                    <input  class="percent" style="width:40px;" type="hidden" name="mark_in_percentage[{{$course->id}}][{{$cat->id}}]" value="{{$cat->mark_in_percentage}}">                                
                                    <input class="inputfield input1" style="width:40px;"  type="text" name="cat_hld_mark[{{$course->id}}][{{$cat->id}}]" value="{{$cat->cat_hld_mark}}" placeholder="Mark" />
                                    <input class="inputfield input2" style="width:60px;" type="text" name="percentage_mark[{{$course->id}}][{{$cat->id}}]" value="{{$cat->percentage_mark}}" placeholder="% Mark" />
                                    <input class="resultfield input3" style="width:50px;" type="text" name="" value="" />
                                  </div>
                                  <div style="text-align:center;">
                                    <input type="radio" <?php echo ($cat->mark_group_id==1) ? 'checked':''; ?> name="mark_group_id[{{$course->id}}][{{$cat->id}}]" value="1">1
                                    <input type="radio" <?php echo ($cat->mark_group_id==2) ? 'checked':''; ?> name="mark_group_id[{{$course->id}}][{{$cat->id}}]" value="2">2
                                    <input type="radio" <?php echo ($cat->mark_group_id==3) ? 'checked':''; ?> name="mark_group_id[{{$course->id}}][{{$cat->id}}]" value="3">3
                                    <input type="radio" <?php echo ($cat->mark_group_id==4) ? 'checked':''; ?> name="mark_group_id[{{$course->id}}][{{$cat->id}}]" value="4">4
                                  </div>
                                </td>
                            @endforeach
                            <td><input class="tot_mark" style="width:50px;" type="text" name="" value="" /></td>
                            @if($course->mdcourseid==0)
                            <td><input class="markcheck" type="checkbox" name="checkbox[{{$course->id}}]"></td>
                            @else
                            <td><span style='font-size:18px;'>&#10003;</span></td>    
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="save_btn" value="save_btn">Save</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('markdistribution')}}/{{'edit'}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
              </form>
          </div>
          @endif
        </div>
      </section>
    </div>
  </div>
</section>
</section>
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/markdistribution.js')}}"></script>
@endsection
