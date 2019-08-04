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
          @if($pList[2]->id==2)
            <li><a href="{{URL::to('/program')}}">New</a></li>
          @endif
            @if($errors->any())
                <span style="float: right;font-size: 15px;color:red;">{{$errors->all()[0] }}</span>
            @endif
            @if(session()->has('msg'))
            <span style="float: right;font-size: 15px;color:green;">
            {{ session()->get('msg') }}
            </span>
            @endif
            <li>Program Level</li>
        </ol>
      </div>
    </div>
    <div class="row-wrapper bg-white">
        @if($bean==null)
        <div class="row" style="margin:0px;padding:25px 0px;">
            <div class="col-md-12">
                <form action="{{URL::to('program')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="name">Class</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="programsign">Class ID</label>
                            <input type="text" class="form-control" name="programsign" id="programsign">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="programlabelid">Class/Program Lavel</label>
                            <select class="form-control" name="programlabelid" id="programlabelid">
                                <option value="">SELECT</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">Group</label>
                            <div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-12">
                            <button type="submit" class="btn btn-default" name="btn_save" value="btn_save">Save</button>
                       </div>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="row" style="margin:0px;padding:25px 0px;">
            <div class="col-md-12">
                <form action="{{URL::to('program')}}/{{$bean->id}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="name">Class</label>
                            <input type="text" class="form-control" name="name" value="{{$bean->name}}" id="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="programsign">Class ID</label>
                            <input type="text" class="form-control" name="programsign" value="{{$bean->programsign}}" id="programsign">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="programlabelid">Class/Program Leve</label>
                            <select class="form-control" name="programlabelid" id="programlabelid">
                                <option value="">SELECT</option>
                                @foreach($plabelList as $x)
                                    @if($x->id==$bean->programlabelid)
                                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                                    @else
                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">Group</label>
                            <div>
                                @foreach($groupList as $g)
                                    <label style="margin-right:10px;" for="groupid[{{$g->id}}]"><input class="form-check-input" type="checkbox" @if($g->groupid!=0) checked @endif name="groupid[{{$g->id}}]" value="{{$g->id}}" id="groupid[{{$g->id}}]">{{$g->name}}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-12">
                            <button type="submit" class="btn btn-default" name="btn_update" value="btn_update">Update</button>
                       </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Class</th>
                                <th>Program Sign</th>
                                <th>Group</th>
                                <th>Label</th>
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
                           
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>SL NO</th>
                                <th>Class</th>
                                <th>Program Sign</th>
                                <th>Group</th>
                                <th>Label</th>
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
