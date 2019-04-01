@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/imageupload')}}">All</a></li>
              <li>Image Upload</li>
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
                <form action="{{URL::to('imageupload')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                   <div class="form-group row">
                    <label class="col-sm-2 control-label" for="name">Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <label class="col-sm-2 control-label" for="imageurl">Picture</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control-file" name="imageurl" id="imageurl">
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
<script type="text/javascript">
      function validateForm(){
        console.log("Hello");
    let picture=document.getElementById('imageurl');
    if(picture.files.length!=0){
        let fileSize = picture.files[0].size;
        let x="";
        if(fileSize>20){
            x=" your file size too learge";
            confirm(x);
            picture.value="";
            return false;
        }else{
            return true;
        }
    }
    return true;
}
</script>
@endsection