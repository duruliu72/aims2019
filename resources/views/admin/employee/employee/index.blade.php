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
        <ol class="breadcrumb">
          @if($pList[2]->id==2)
            <li><a href="{{URL::to('/employees')}}/{{'create'}}">New</a></li>
          @endif
          <li>Employee</li>
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
                <th>Gender</th>
                <th>Contact</th>
                <th>Department/Designation</th>
                <th>Emp. Type/Job Status</th>
                <th>Image</th>
                @if(($pList[3]->id==3) || ($pList[4]->id==4))
                <th width="10px">Act</th>
                @endif
              </tr>
            </thead>
            <tbody>
              <?php $id=0; ?>
              @foreach($result as $x)
              <tr>
                <td>{{++$id}}</td>
                <td><span>{{$x->name}}</span><br><span>{{$x->employeeidno}}</span></td>
                <td>{{$x->genderName}}</td>
                <td>{{$x->mobileno}}</td>
                <td><span>{{$x->designationName}}</span><br><span>{{$x->departmentName}}</span></td>
                <td><span>{{$x->employeeName}}</span><br><span>{{$x->employmentstatusName}}</span></td>
                <th style="text-align:center;position:relative;height:49px;width:49px"><img style="width:77px;height:65px;position:absolute;top:0px;left:0px;" alt="{{$x->name}}" src="{{asset('clientAdmin./image/employee/')}}/{{$x->picture}}"></th>
                <td style="text-align:center"> 
                  @if($pList[3]->id==3)
                  <a href="{{URL::to('/employees')}}/{{$x->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                  </a>
                  @endif
                  @if($pList[4]->id==4)
                  <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                  </a>
                  @endif
                </td>
              
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>SL NO</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Department/Designation</th>
                <th>Emp. Type/Job Status</th>
                <th>Image</th>
                @if(($pList[3]->id==3) || ($pList[4]->id==4))
                <th width="10px">Act</th>
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
