@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i>{{$institute->name}}</h3>
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
                <form action="{{URL::to('role')}}/{{$bean->id}}" method="POST">
                  @method('PUT')
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="rolecreatorid">Role Creator</label>
                    <div class="col-sm-4">
                      <select onchange="getChange(this,'editRcreatorToRole')" class="form-control" name="rolecreatorid" id="rolecreatorid">
                        @foreach($roleList as $x)
                           @if($x->id==$bean->rolecreatorid)
                           <option selected=""  value="{{$x->id}}">{{$x->name}}</option>
                           @else
                           <option  value="{{$x->id}}">{{$x->name}}</option>
                           @endif
                        @endforeach
                      </select>
                    </div>
                     <label class="col-sm-2 control-label" for="name">Role</label>
                    <div class="col-sm-4">
                      <input type="hidden" class="form-control" id="id" name="id" value="{{$bean->id}}">
                      <input type="text" class="form-control" name="name" id="name" value="{{$bean->name}}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" id="output">
                      <ul class="role_menu">
                        @foreach($parentlist as $x)
                          @if($x->child_menuid!=0)
                            <li><label><input type="checkbox" checked>{{$x->name}}</label>
                          @else
                            <li><label><input type="checkbox">{{$x->name}}</label>
                          @endif
                              <ul>
                              @foreach($list[$x->menuid] as $item)
                                  <li>
                                      @if($item[0]->child_menuid!=0)
                                      <div class="menu">
                                          <label><input type="checkbox" checked>{{$item[0]->name}}</label>
                                      </div>
                                      @else
                                      <div class="menu">
                                          <label><input type="checkbox">{{$item[0]->name}}</label>
                                      </div>
                                      @endif
                                      <div class="permission">
                                        @foreach($item[1] as $permission_item)
                                          @if($permission_item->child_permissionid!=0)
                                            <label><input type="checkbox" checked>{{$permission_item->name}} &nbsp;&nbsp;</label>
                                          @else
                                            <label><input type="checkbox">{{$permission_item->name}} &nbsp;&nbsp;</label>
                                          @endif
                                        @endforeach
                                      </div>
                                  </li>                              
                              @endforeach
                              </ul>
                            </li>
                        @endforeach
                      </ul>
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
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/role.js')}}"></script>
@endsection