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
                <th>Applicant Id</th>
                <th>Name</th>
                <th>Payment Status</th>
                <th>Payment Amount</th>
                @if($pList[3]->id==3)
                <th width="10px">Pay</th>
                @endif
              </tr>
            </thead>
            <tbody>
              <?php $id=0; ?>
              @foreach($result as $x)
              <tr>
                <td>{{++$id}}</td>
                <td>{{$x->applicantid}}</td>
                <td>{{$x->name}}</td>
                <td>{{$x->paymentstatus}}</td>
                <td>{{number_format($x->amount, 2, '.', '')}}</td>
                @if($pList[3]->id==3)
                <td> 
                  <a href="{{URL::to('/admissionfee')}}/{{$x->id}}/{{'payment'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="fa fa-paypal" style="font-size:15px"></i>
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
                <th>Applicant Id</th>
                <th>Name</th>
                <th>Payment Status</th>
                <th>Payment Amount</th>
                @if($pList[3]->id==3)
                <th width="10px">Pay</th>
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
