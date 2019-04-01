@extends('admin.admin')
@section('content')
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>Horinagor High School</h3>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/sectionoffer')}}">All</a></li>
              <li>Section Offer</li>
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
                <form action="{{URL::to('sectionoffer')}}/{{$bean->id}}" method="POST">
                 @method('PUT')
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group row">
                        <label class="col-sm-5 control-label">Program</label>
                        <label class="col-sm-5 control-label">                   
                            @foreach ($programList as $x)
                              @if($x->id==$bean->programid)
                                {{$x->name}}
                              @endif
                            @endforeach
                        </label>          
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 control-label" for="groupid">Group</label>
                        <label class="col-sm-5 control-label">                   
                            @foreach ($groupList as $x)
                              @if($x->id==$bean->groupid)
                                {{$x->name}}
                              @endif
                            @endforeach
                        </label>                      
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 control-label" for="mediumid">Medium</label>
                        <label class="col-sm-5 control-label">                   
                            @foreach ($mediumList as $x)
                              @if($x->id==$bean->mediumid)
                                {{$x->name}}
                              @endif
                            @endforeach
                        </label>                
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-5 control-label" for="shiftid">Shift</label>
                        <label class="col-sm-5 control-label">                   
                            @foreach ($shiftList as $x)
                              @if($x->id==$bean->shiftid)
                                {{$x->name}}
                              @endif
                            @endforeach
                        </label>                           
                      </div>
                    </div>
                    <div class="col-md-6">
                      <table class="table table-striped table-bordered table-hover customtable sectionoffer" id="sectionoffer">
                        <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th width="27%">Section</th>
                              <th width="69%">Number of Student</th>
                              <th width="2%"><input id="markcheckid" checked type="checkbox" name="check" /></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($sectionList as $x)
                             @if($x->sectionid!=0)
                            </tr>
                              <td>{{$x->id}}<input type="hidden" name="sectionid[{{$x->id}}]" value="{{$x->id}}" /></td>
                              <td>{{$x->name}} <input type="hidden" name="name[{{$x->id}}]" value="{{$x->name}}" /></td>
                              <td class="no-padding"><input class="form-control" type="text" name="section_student[{{$x->id}}]" value="{{$x->section_student}}"/></td>
                              <td><input class="markcheck" checked type="checkbox" name="checkbox[{{$x->id}}]"></td>
                            </tr>
                            @else
                            </tr>
                              <td>{{$x->id}}<input type="hidden" name="sectionid[{{$x->id}}]" value="{{$x->id}}" /></td>
                              <td>{{$x->name}} <input type="hidden" name="name[{{$x->id}}]" value="{{$x->name}}" /></td>
                              <td class="no-padding"><input class="form-control" type="text" name="section_student[{{$x->id}}]" /></td>
                              <td><input class="markcheck"  type="checkbox" name="checkbox[{{$x->id}}]"></td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                      </table>
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
<script src="{{asset('clientAdmin/js/sectionoffer.js')}}"></script>
@endsection