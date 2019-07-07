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
          <li>Subject Mearging</li>
          @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <div class="top-section top_form row">
            <form action="{{URL::to('meargeoffer')}}" method="POST">
                {{csrf_field()}}
                  <div class="col-sm-4 form-group">
                    <label class="control-label" for="programid">Program</label>
                    <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                        <option  value="">SELECT</option>
                        @foreach ($programList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4 form-group">
                    <label class="control-label" for="mediumid">Medium</label>
                      <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                         <option value="">SELECT</option>
                         @foreach ($mediumList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <div class="col-sm-4 form-group">
                    <label class="control-label" for="shiftid">Shift</label>
                      <select onchange="getChange(this,'shift')" class="form-control" name="shiftid" id="shiftid">
                         <option value="">SELECT</option>
                         @foreach ($shiftList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>  
                    <div class="col-sm-4 form-group">
                    <label class="control-label" for="groupid">Group</label>
                      <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                         <option value="">SELECT</option>
                         @foreach ($groupList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                 
                    <div class="col-sm-3 form-group">
                      <label class="control-label" for="firstsubjectcodeid">First Subject</label>
                      <select class="form-control" name="firstsubjectcodeid" id="firstsubjectcodeid">
                         <option value="">SELECT</option>
                         @foreach ($courseCodeList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <div class="col-sm-2 form-group">
                      <label class="control-label mearge" for="meargeid">Mearge With</label>
                    </div>
                    <div class="col-sm-3 form-group">
                      <label class="control-label" for="secondsubjectcodeid">Second Subject</label>
                      <select class="form-control" name="secondsubjectcodeid" id="secondsubjectcodeid">
                         <option value="">SELECT</option>
                         @foreach ($courseCodeList as $x)
                           <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>                           
                    <div class="col-sm-4 form-group">
                      <label class="control-label" for="mearge_name">Mearge Name</label>
                      <input type="text" class="form-control" name="mearge_name" id="mearge_name">
                    </div>      
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="btn-container">
                        <button type="submit" class="btn btn-success result-btn" name="save_btn" value="save_btn">Save</button>
                        <a class="btn btn-info refresh-btn" href="{{URL::to('meargeoffer')}}"><i class="ace-icon fa fa-refresh bigger-120"></i>Refresh</a>
                      </div>
                    </div>
                  </div>
            </form>
          </div>
          <div class="bottom-section bottom_form">
              <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Class Information</th>
                    <th>mearge Subjects</th>
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
                    <td>{{sprintf("%s %s %s %s %s",$x->sessionName,$x->programName,$x->mediumName,$x->shiftName,$x->groupName)}}</td>
                    <td>
                    @foreach($x->meargesubjects as $k=>$v)
                      {{$x->meargesubjects[$k][0]->courseName}}-{{$x->meargesubjects[$k][1]->courseName}},
                    @endforeach
                    </td>
                    @if($pList[4]->id==4)
                    <td>
                        <form  action="{{URL::to('/meargeoffer')}}/{{'deleteMerge'}}" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
                            @method('DELETE')
                            {!! csrf_field() !!}
                            <input type="hidden" name="programofferid" value="{{$x->programofferid}}">
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
                    <th>SL NO</th>
                    <th>Class Information</th>
                    <th>mearge Subjects</th>
                    @if($pList[4]->id==4)
                    <th width="10px">Del</th>
                    @endif
                  </tr>
                </tfoot>
              </table>
          </div>
          
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
<script src="{{asset('clientAdmin/js/meargeoffer.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function() {
  var table = $('#example').DataTable( {
    responsive: true
  } );

  new $.fn.dataTable.FixedHeader( table );
} );
</script>
@endsection
