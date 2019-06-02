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
              <li><a href="{{URL::to('/institute')}}">All</a></li>
              <li>Institute</li>
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
                <form action="{{URL::to('institute')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div> 
                     <label class="col-sm-2 control-label" for="eiin">EIIN</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="eiin" id="eiin">
                    </div>                    
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="wordno">Word No</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="wordno" id="wordno">
                    </div>
                    <label class="col-sm-2 control-label" for="cluster">Cluster</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="cluster" id="cluster">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="institutetypeid">Institute Type</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="institutetypeid" id="institutetypeid">
                         <option value="">SELECT</option>
                         <option value="1">Governmental</option>
                         <option value="2">Semi Governmental</option>
                         <option value="3">Non Governmental</option>
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="categoryid">Institute Category</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="categoryid" id="categoryid">
                         <option value="">SELECT</option>
                         <option value="1">General</option>
                         <option value="2">Madrasa</option>
                         <option value="3">Vocational</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="subcategoryid">Sub Category</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="subcategoryid" id="subcategoryid">
                         <option value="">SELECT</option>
                         <option value="1">kowami</option>
                         <option value="2">Hafiza Madrasa</option>
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="institutelogo">Logo</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control-file" name="institutelogo" id="institutelogo">
                    </div>
                  </div>
                  <fieldset>
                    <legend>Address</legend>
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="divisionid">Division</label>
                    <div class="col-sm-4">
                       <select onchange="changeAddress(this,'division')" class="form-control" name="divisionid" id="divisionid">
                         <option value="">SELECT</option>
                         @foreach($divisionList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="districtid">District</label>
                    <div class="col-sm-4">
                       <select onchange="changeAddress(this,'district')" class="form-control" name="districtid" id="districtid">
                         <option value="">SELECT</option>
                         @foreach($districtList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="thanaid">Thana</label>
                    <div class="col-sm-4">
                       <select onchange="changeAddress(this,'thana')" class="form-control" name="thanaid" id="thanaid">
                         <option value="">SELECT</option>
                         @foreach($thanaList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="postofficeid">Post Office</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="postofficeid" id="postofficeid">
                         <option value="">SELECT</option>
                         @foreach($postofficeList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="postcode">Post Code</label>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" name="postcode" id="postcode">
                    </div>
                    <label class="col-sm-2 control-label" for="localgovid">Union</label>
                    <div class="col-sm-4">
                       <select class="form-control" name="localgovid" id="localgovid">
                         <option value="">SELECT</option>
                         @foreach($localgovList as $x)
                          <option value="{{$x->id}}">{{$x->name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 control-label" for="address">Address</label>
                      <div class="col-sm-4">
                          <textarea onchange="" class="form-control" rows="4" id="address" name="address"></textarea>
                      </div>
                  </div>
                  </fieldset>
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
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/institute.js')}}"></script>
@endsection