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
                <form action="{{URL::to('role')}}" method="POST">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Role</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <label class="col-sm-2 control-label" for="parentid">Role Creator</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="parentid" id="parentid">
                        @foreach($roleList as $x)
                          <option  value="{{$x->id}}">{{$x->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                       <fieldset class="permission">
                          <legend>Permission</legend>
                          <label><input type="checkbox" name="" value="">Read &nbsp;&nbsp;</label>
                          <label><input type="checkbox" name="" value="">Create &nbsp;&nbsp;</label>
                          <label><input type="checkbox" name="" value="">Up &nbsp;&nbsp;</label>
                          <label><input type="checkbox" name="" value="">Del &nbsp;&nbsp;</label>
                        </fieldset>
                    </div>
                  </div>
                  <div class="row" id="output">
                    <div class="col-md-12">
                      <fieldset class="menu">
                        <legend>Menu</legend>
                        <ul class="role_menu">
                          @foreach($menuList as $x)
                          @if($x->parentid==0)
                          <li><label><input type="checkbox" onclick="" name="menuid[]" value="">RoleSetting</label>
                            <ul>
                              <li>
                                <label><input type="checkbox" name="menuid[]" value="">Role</label>
                              </li>
                              <li>
                                <label><input type="checkbox" name="menuid[]" value="">Role1</label>
                              </li>
                            </ul>
                          </li>
                          @endif
                          @endforeach
                        </ul>
                      </fieldset>
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