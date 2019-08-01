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
            <li><a href="{{URL::to('/coursecode')}}">New</a></li>
          @endif
            @if($errors->any())
                <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
            @endif
            @if(session()->has('msg'))
            <span style="float: right;font-size: 15px;">
            {{ session()->get('msg') }}
            </span>
            @endif
          <li>All Subject Info</li>
        </ol>
      </div>
    </div>
    <div class="row-wrapper bg-white">
        @if($bean==null)
        <div class="row" style="margin:0px;padding:25px 0px;">
            <div class="col-md-12">
                <form action="{{URL::to('coursecode')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="name">Subject Code</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="courseid">Course</label>
                            <select class="form-control" name="courseid" id="courseid">
                                <option value="">SELECT</option>
                                @foreach($courseList as $x)
                                <option value="{{$x->id}}">{{$x->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="programlevelid">Class/Program Leve</label>
                            <select class="form-control" name="programlevelid" id="programlevelid">
                                <option value="">SELECT</option>
                                @foreach($plevelList as $x)
                                <option value="{{$x->id}}">{{$x->name}}</option>
                                @endforeach
                            </select>
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
                <form action="{{URL::to('coursecode')}}/{{$bean->id}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class=" control-label" for="name">Subject Code</label>
                            <input type="text" class="form-control" name="name" value="{{$bean->name}}" id="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="courseid">Course</label>
                            <select class="form-control" name="courseid" id="courseid">
                                <option value="">SELECT</option>
                                @foreach($courseList as $x)
                                    @if($x->id==$bean->courseid)
                                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                                    @else
                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="programlevelid">Class/Program Leve</label>
                            <select class="form-control" name="programlevelid" id="programlevelid">
                                <option value="">SELECT</option>
                                @foreach($plevelList as $x)
                                    @if($x->id==$bean->programlevelid)
                                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                                    @else
                                    <option value="{{$x->id}}">{{$x->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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
                                <th>Course Code</th>
                                <th>Course</th>
                                <th>Program Level</th>
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
                                <td>{{$x->courseName}}</td>
                                <td>{{$x->programlevel}}</td>
                                @if($pList[3]->id==3)
                                <td> 
                                <a href="{{URL::to('/coursecode')}}/{{$x->id}}" class="tooltip-success" data-rel="tooltip" title="Edit">
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
                                <th>Course Code</th>
                                <th>Course</th>
                                <th>Program Level</th>
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
