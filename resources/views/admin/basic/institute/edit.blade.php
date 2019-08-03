@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>{{$institute->name}}</h3>
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
                <form action="{{URL::to('institute')}}/{{$bean->id}}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  {{csrf_field()}}
                  <div class="form-group row">
                    <label class="col-sm-2 control-label">Class Level</label>
                    <div class="col-sm-10">
                       @foreach($pLevel as $pl)
                        <label style="margin-right:10px;" for="programlevelid[{{$pl->id}}]"><input class="form-check-input" type="checkbox" value="{{$pl->id}}" id="programlevelid[{{$pl->id}}]">{{$pl->name}}</label>
                       @endforeach
                    </div>                  
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name" value="{{$bean->name}}">
                    </div> 
                     <label class="col-sm-2 control-label" for="eiin">EIIN</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="eiin" id="eiin" value="{{$bean->ein}}">
                    </div>                    
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label" for="wordno">Word No</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="wordno" id="wordno" value="{{$bean->wordno}}">
                    </div>
                    <label class="col-sm-2 control-label" for="cluster">Cluster</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="cluster" id="cluster" value="{{$bean->cluster}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <level class="col-sm-2 control-label" for="institutetypeid">Institute Type</level>
                    <div class="col-sm-4">
                       <select class="form-control" name="institutetypeid" id="institutetypeid">
                         <option value="">SELECT</option>
                         <option <?php echo ($bean->institutetypeid==1)? "selected":""; ?> value="1">Governmental</option>
                         <option <?php echo ($bean->institutetypeid==2)? "selected":""; ?> value="2">Semi Governmental</option>
                         <option <?php echo ($bean->institutetypeid==3)? "selected":""; ?> value="3">Non Governmental</option>
                      </select>
                    </div>
                    <level class="col-sm-2 control-label" for="categoryid">Institute Category</level>
                    <div class="col-sm-4">
                       <select class="form-control" name="categoryid" id="categoryid">
                         <option value="">SELECT</option>
                         <option <?php echo ($bean->categoryid==1)? "selected":""; ?> value="1">General</option>
                         <option <?php echo ($bean->categoryid==2)? "selected":""; ?> value="2">Madrasa</option>
                         <option <?php echo ($bean->categoryid==3)? "selected":""; ?> value="3">Vocational</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <level class="col-sm-2 control-label" for="subcategoryid">Sub Category</level>
                    <div class="col-sm-4">
                       <select class="form-control" name="subcategoryid" id="subcategoryid">
                         <option  value="">SELECT</option>
                         <option <?php echo ($bean->subcategoryid==1)? "selected":""; ?> value="1">kowami</option>
                         <option <?php echo ($bean->subcategoryid==2)? "selected":""; ?> value="2">Hafiza Madrasa</option>
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
                    <level class="col-sm-2 control-label" for="divisionid">Division</level>
                    <div class="col-sm-4">
                       <select onchange="getChange(this,'divisionToDistrict')" class="form-control" name="divisionid" id="divisionid">
                         <option value="">SELECT</option>
                         @foreach($divisionList as $x)
                          @if($x->id==$bean->divisionid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                    <level class="col-sm-2 control-label" for="districtid">District</level>
                    <div class="col-sm-4">
                       <select onchange="getChange(this,'districtToThana')" class="form-control" name="districtid" id="districtid">
                         <option value="">SELECT</option>
                         @foreach($districtList as $x)
                          @if($x->id==$bean->districtid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <level class="col-sm-2 control-label" for="thanaid">Thana</level>
                    <div class="col-sm-4">
                       <select onchange="getChange(this,'thanaToPostofficeandlocalgov')" class="form-control" name="thanaid" id="thanaid">
                         <option value="">SELECT</option>
                         @foreach($thanaList as $x)
                          @if($x->id==$bean->thanaid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                    <level class="col-sm-2 control-label" for="postofficeid">Post Office</level>
                    <div class="col-sm-4">
                       <select class="form-control" name="postofficeid" id="postofficeid">
                         <option value="">SELECT</option>
                         @foreach($postofficeList as $x)
                          @if($x->id==$bean->postofficeid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <level class="col-sm-2 control-label" for="postcode">Post Code</level>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" name="postcode" id="postcode" value="{{$bean->postcode}}">
                    </div>
                    <level class="col-sm-2 control-label" for="localgovid">Union</level>
                    <div class="col-sm-4">
                       <select class="form-control" name="localgovid" id="localgovid">
                         <option value="">SELECT</option>
                         @foreach($localgovList as $x)
                          @if($x->id==$bean->localgovid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                          @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                          @endif
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 control-label" for="address">Address</label>
                      <div class="col-sm-4">
                          <textarea onchange="" class="form-control" rows="4" id="address" name="address">{{$bean->address}}</textarea>
                      </div>
                  </div>
                  </fieldset>
                  <button ty
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
<script src="{{asset('clientAdmin/js/ajax.js')}}"></script>
@endsection