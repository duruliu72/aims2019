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
            <li><a href="{{URL::to('/studentimport')}}/{{'export'}}">Export to Excel</a></li>
          @endif
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
                <th>Applicantid</th>
                <th>pin_code</th>
                <th>firstName</th>
                <th>middleName</th>
                <th>LastName</th>
                <th>phone</th>
              </tr>
            </thead>
            <tbody>
              <?php $id=0; ?>
              @foreach($applicant_data as $x)
              <tr>
                <td>{{$x->applicantid}}</td>
                <td>{{$x->pin_code}}</td>
                <td>{{$x->firstName}}</td>
                <td>{{$x->middleName}}</td>
                <td>{{$x->lastName}}</td>
                <td>{{$x->phone}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</section>
</section>
@endsection
