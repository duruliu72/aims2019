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
        <h3 class="page-header"><i class="fa fa-laptop"></i>{{$instituteName->name}}</h3>
        <ol class="breadcrumb">
          @if($pList[2]->id==2)
            <li><a href="{{URL::to('/masterexam')}}/{{'create'}}">New</a></li>
          @endif
          <li>Master Exam</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel margin-bottom-zero">
          <div class="master-exam">
            <form action="{{URL::to('masterexam')}}" method="POST">
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
                  <option  value="">SELECT</option>
                  @foreach ($groupList as $x)
                      <option value="{{$x->id}}">{{$x->name}}</option>
                  @endforeach
                  </select>
                </div>                       
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'program')" class="form-control" name="mediumid" id="mediumid">
                    <option  value="">SELECT</option>
                    @foreach ($mediumList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'group')" class="form-control" name="shiftid" id="shiftid">
                    <option  value="">SELECT</option>
                    @foreach ($shiftList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>                       
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="examnameid">Exam Name</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'program')" class="form-control" name="examnameid" id="examnameid">
                    <option  value="">SELECT</option>
                    @foreach ($masterExamNameList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="markinpercentage">Exam in(%) of 100%</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="markinpercentage" id="markinpercentage">
                </div>                    
              </div>
              <div style="text-align:right;">
                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="save_btn" value="save_btn">Save</button>
              </div>
            </form>
          </div>
        </section>
      </div>
      <div class="col-lg-12">
        <section class="panel">
          <div class="table-responsive">
           <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>SL NO</th>
                <th>Program Name</th>
                <th>Exam Name</th>
                @if($pList[3]->id==3)
                <th width="10px">Edit</th>
                @endif
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
                <td>{{$x->name}}</td>
                <td>{{$x->name}}</td>
                @if($pList[3]->id==3)
                <td> 
                  <a href="{{URL::to('/masterexam')}}/{{$x->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                  </a>
                </td>
                @endif
                @if($pList[4]->id==4)
                <td>
                  <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                  </a>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>SL NO</th>
                <th>Program Name</th>
                <th>Exam Name</th>
                @if($pList[3]->id==3)
                <th width="10px">Edit</th>
                @endif
                @if($pList[4]->id==4)
                <th width="10px">Del</th>
                @endif
              </tr>
            </tfoot>
          </table>
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
<script type="text/javascript">
 $(document).ready(function() {
  var table = $('#example').DataTable( {
    responsive: true
  } );

  new $.fn.dataTable.FixedHeader( table );
} );
</script>
@endsection
