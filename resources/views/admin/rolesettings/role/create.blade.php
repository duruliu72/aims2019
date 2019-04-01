@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/role')}}">All</a></li>
              <li>Role</li>
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
                <form action="{{URL::to('role')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="rolecreatorid">Role Creator</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'RcreatorToRole')" class="form-control" name="rolecreatorid" id="rolecreatorid">
                        @foreach($roleList as $x)
                          <option  value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                      </select>
                    </div>
                     <label class="col-sm-2 control-label" for="name">Role</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" id="output">
                      <ul class="role_menu">
                        @foreach($menuList as $x)
                          @if($x->parentid==0)
                          <li><label><input type="checkbox" onclick="clickMenu(this)" name="menuid[]" value="{{$x->id}}">{{$x->name}}</label><input  type="checkbox" hidden="" checked="" name="permissionid_{{$x->id}}[]" value="0">
                            <ul>
                              @foreach($permissionList as $y)
                                @if($y['menuitem']->parentid==$x->id)
                                  <li>
                                    <div class="menu">
                                      <label><input type="checkbox" name="menuid[]" value="{{$y['menuitem']->id}}">{{$y['menuitem']->name}}</label>
                                    </div>
                                    <div class="permission">
                                      @foreach($y['permissionList'] as $p)
                                        <label><input type="checkbox" name="permissionid_{{$y['menuitem']->id}}[]" value="{{$p->permissionid}}">{{$p->name}} &nbsp;&nbsp;</label>
                                      @endforeach
                                    </div>
                                  </li>
                                @endif
                              @endforeach
                            </ul>
                          </li>
                          @endif
                        @endforeach
                      </ul>
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
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/role.js')}}"></script>
<script src="{{asset('clientAdmin/js/ajax.js')}}"></script>
@endsection