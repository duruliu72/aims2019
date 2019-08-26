@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/menu')}}">All</a></li>
              <li>Menus</li>
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
                <form action="{{URL::to('menu')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <label class="col-sm-2 control-label" for="parentid">Parent</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="parentid" id="parentid">
                         <option value="0">No Parent</option>
                          @foreach($parents as $x)
                          <option  value="{{$x->id}}">{{$x->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="url">Route</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="url" id="url">
                    </div>
                     <label class="col-sm-2 control-label" for="menuorder">Menu Order</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="menuorder" id="menuorder">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-default">Save</button>
                </form>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>
@endsection