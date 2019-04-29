@extends('admin.admin')
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
              <li><a href="{{URL::to('/user')}}">All</a></li>
              <li>User</li>
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
                <form action="{{URL::to('user')}}/{{$bean->id}}" method="POST">
                  @method('PUT')
                  {{csrf_field()}}
                   <div class="col-md-6 col-sm-offset-3">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" for="roleid">Role</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="roleid" id="roleid">
                            <option value="">SELECT</option>
                            @foreach($roleList as $x)
                              @if($x->id==$bean->roleid)
                                <option selected value="{{$x->id}}">{{$x->name}}</option>
                              @else
                                <option value="{{$x->id}}">{{$x->name}}</option>
                              @endif
                            @endforeach
                      </select>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" for="name">User Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" id="name" value="{{$bean->userName}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="email" id="email" value="{{$bean->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" for="password">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="password" id="password">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-default pull-right">Update</button>
                   </div>
                </form>
              </div>
            </section>
          </div><!--/.col-->
        </div><!--/.row-->
      </section>
    </section>

@endsection