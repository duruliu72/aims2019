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
        <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
        <ol class="breadcrumb">
           @if($pList[2]->id==2)
            <li><a href="{{URL::to('/quota')}}/{{'create'}}">New</a></li>
          @endif
          <li>Quota</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <div class="table-responsive">
           <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>SL NO</th>
                <th>Name</th>
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
                @if($pList[3]->id==3)
                <td> 
                  <a href="{{URL::to('/quota')}}/{{$x->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
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
                <th>Name</th>
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
