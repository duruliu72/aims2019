@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/examname')}}">All</a></li>
              <li>Exam</li>
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
              <div class="panel-body">
                <form action="{{URL::to('examname')}}/{{$bean->id}}" method="POST">
                  @method('PUT')
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name" value="{{$bean->name}}">
                    </div>
                    <label class="col-sm-2 control-label" for="examptypeid">Exam Type</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="examtypeid" id="examtypeid">
                          <option @if($bean->examtypeid==1) selected @endif value="1">Master</option>
                          <option @if($bean->examtypeid==2) selected @endif  value="2">Chlid</option>
                      </select>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-default">Update</button>
                </form>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection
