@extends('admin.admin')
@section('uniqueStyle')

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
          <li><a href="{{URL::to('/gender')}}/{{'create'}}">New</a></li>
          <li>Gender</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <div class="searchbox"">
            <input class="form-control" id="myInput"  type="text" placeholder="Search..">
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th width="10px">Edit</th>
                  <th width="10px">Del</th>
                </tr>
              </thead>
              <tbody id="datalist">
                <tr>
                  <td>01</td>
                  <td>Rinku</td>
                  <td>ICE</td>
                  <td style="text-align: center;">
                    <a href="" class="tooltip-success" data-rel="tooltip" title="Edit">
                      <span class="green">
                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                      </span>
                    </a>
                  </td>
                  <td style="text-align: center;">
                    <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                      <span class="red">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                      </span>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>
@endsection
@section('uniqueScript')
<script type="text/javascript">
   $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#datalist tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>
@endsection
