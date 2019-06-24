@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
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
                <li>Create Grade Point</li>
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
              <div class="panel-body">
                <div class="top_form">
                    <form action="{{URL::to('gradepoint')}}" method="POST">
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
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-container">
                          <button type="submit" class="btn btn-success result-btn" name="search_btn" value="search_btn">Search</button>
                          <a class="btn btn-info refresh-btn" href="{{URL::to('gradepoint')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @if(isset($programofferinfo))
                <div class="programofferinfo">
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
                <div class="bottom_form">
                  <form action="{{URL::to('gradepoint')}}" method="POST">
                  {{csrf_field()}}
                  <input type="hidden" name="programofferid" value="{{$programofferinfo->id}}">
                  <div class="row">
                    <div class="col-md-12 courseoffer">
                        <table class="table table-striped table-bordered table-hover customtable" id="gradepoint">
                        <thead>
                          <tr>
                            <th width="2%">#</th>
                            <th width="27%">Grade letter</th>
                            <th>From Mark</th>
                            <th>To Mark</th>
                            <th width="10%">Grade Point</th>
                            <th width="2%"><input id="markcheckid" type="checkbox"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $id=0; ?>
                          @foreach($gradeList as $x)
                            @if($x->gradeletterid==0)
                              <tr>
                                <td>{{++$id}}</td>  
                                <td><input type="hidden" name="gradeletterid[{{$x->id}}]" value="{{$x->id}}" />{{$x->name}}</td>
                                <td><div class="form-group"><input class="form-control" type="text" name="from_mark[{{$x->id}}]" /></div></td>
                                <td><div class="form-group"><input class="form-control" type="text" name="to_mark[{{$x->id}}]" /></div></td>
                                <td><div class="form-group"><input class="form-control" type="text" name="gradepoint[{{$x->id}}]" /></div></td>
                                <td><input class="markcheck" type="checkbox" name="checkbox[{{$x->id}}]"></td>
                              </tr>
                            @else
                              <tr>
                                <td>{{++$id}}</td>  
                                <td>{{$x->name}}</td>
                                <td>{{$x->from_mark}}</td>
                                <td>{{$x->to_mark}}</td>
                                <td>{{$x->gradepoint}}</td>
                                <td><span style='font-size:18px;'>&#10003;</span></td>
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
                          <a class="btn btn-info refresh-btn" href="{{URL::to('gradepoint')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
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
<script src="{{asset('clientAdmin/js/gradepoint.js')}}"></script>
@endsection