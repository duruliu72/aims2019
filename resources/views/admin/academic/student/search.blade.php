@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
             <a style="position: absolute;top: 25px;right: 50px;" href="{{URL::to('/student')}}">Refresh</a>
              @if ($errors->any())
                   <ol class="breadcrumb">
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
                   </ol>
              @endif
              @if(session()->has('msg'))
              <ol class="breadcrumb">
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              </ol>
              @endif
          </div>
        </div>
        <section class="panel">
            <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{URL::to('student')}}/{{'create'}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="applicantid">Applicant Id</label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" name="applicantid" id="applicantid" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                            <button type="submit" class="btn btn-default" name="find" value="find">Find</button>
                        </div>                           
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>
      </section>
    </section>
@endsection