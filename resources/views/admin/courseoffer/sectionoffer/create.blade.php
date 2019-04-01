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
                <form action="{{URL::to('sectionoffer')}}" method="POST">
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-2 control-label" for="programid">Program</label>
                        <div class="col-sm-10">
                          <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                              <option  value="">SELECT</option>
                            @foreach ($programList as $x)
                              <option <?php echo (old('programid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>              
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label" for="groupid">Group</label>
                        <div class="col-sm-10">
                          <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                            <option value="">SELECT</option>
                            @foreach ($groupList as $x)
                              <option <?php echo (old('groupid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>                       
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                        <div class="col-sm-10">
                          <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                            <option value="">SELECT</option>
                            @foreach ($mediumList as $x)
                              <option <?php echo (old('mediumid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>                      
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                        <div class="col-sm-10">
                          <select onchange="getChange(this,'shift')" class="form-control" name="shiftid" id="shiftid">
                            <option value="">SELECT</option>
                            @foreach ($shiftList as $x)
                              <option <?php echo (old('shiftid')==$x->id)? 'selected':''; ?> value="{{$x->id}}">{{$x->name}}</option>
                            @endforeach
                          </select>
                        </div>                           
                      </div>
                    </div>
                    <div class="col-md-6">
                      <table class="table table-striped table-bordered table-hover customtable sectionoffer" id="sectionoffer">
                        <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th width="27%">Section</th>
                              <th width="69%">Number of Student</th>
                              <th width="2%"><input id="markcheckid" type="checkbox" name="check" /></th>
                            </tr>
                          </thead>
                          <tbody id="output">
                            @foreach($sectionList as $x)
                            <tr>
                              <td>{{$x->id}}<input type="hidden" name="sectionid[{{$x->id}}]" value="{{$x->id}}" /></td>
                              <td>{{$x->name}} <input type="hidden" name="name[{{$x->id}}]" value="{{$x->name}}" /></td>
                              <td class="no-padding"><input class="form-control" type="text" name="section_student[{{$x->id}}]" value="{{ old('section_student.'.$x->id) }}" /></td>
                              <td><input class="markcheck" <?php echo (old('checkbox.'.$x->id)=='on')? 'checked':''; ?> type="checkbox" name="checkbox[{{$x->id}}]"></td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
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
<script src="{{asset('clientAdmin/js/sectionoffer.js')}}"></script>
@endsection