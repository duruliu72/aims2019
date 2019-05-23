@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
@endsection
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
              <li>Child Exam</li>
              @if($pList[2]->id==2 && $editBean!=null)
              <li><a href="{{URL::to('/childexam')}}">New</a></li>
              @endif
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
        <section class="panel margin-bottom-zero">
          <div class="master-exam">
            @if($editBean==null)
            <form action="{{URL::to('childexam')}}" method="POST">
              {{csrf_field()}}
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="programid">Program</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                    <option  value="">SELECT</option>
                    @foreach ($programList as $x)
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                    <option  value="">SELECT</option>
                    @foreach ($mediumList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                                   
              </div>
              <div class="form-group row">
                
                <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'shift')" class="form-control" name="shiftid" id="shiftid">
                    <option  value="">SELECT</option>
                    @foreach ($shiftList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="groupid">Group</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                  <option  value="">SELECT</option>
                  @foreach ($groupList as $x)
                      <option value="{{$x->id}}">{{$x->name}}</option>
                  @endforeach
                  </select>
                </div>                          
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="masterexamid">Master Exam</label>
                <div class="col-sm-4">
                  <select class="form-control" name="masterexamid" id="masterexamid">
                    <option  value="">SELECT</option>
                    @foreach ($masterExamNameList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="examnameid">Child Name</label>
                <div class="col-sm-4">
                  <select class="form-control" name="examnameid" id="examnameid">
                    <option  value="">SELECT</option>
                    @foreach ($childExamNameList as $x)
                        <option value="{{$x->id}}">{{$x->name}}</option>
                    @endforeach
                  </select>
                </div>                  
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="cxm_in_percentage">Exam in(%) of 100%</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="cxm_in_percentage" id="cxm_in_percentage">
                </div>  
              </div>
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-striped table-bordered table-hover customtable">
                    <thead>
                      <tr>
                        <th>SL.NO</th>
                        <th>Subject Name</th>
                        <th>Code</th>
                        <th width="15%%">Marks</th>
                      </tr>
                    </thead>
                    <tbody id="childexamcourse">
                    </tbody>
                  </table>
                </div>
              </div>
              <div style="text-align:right;">
                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn" value="save_btn">Save</button>
              </div>
            </form>
            @else
            <form action="{{URL::to('childexam')}}" method="POST">
              <input type="hidden" name="hiddenid" value="{{$editBean->id}}">
              {{csrf_field()}}
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="programid">Program</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                    <option  value="">SELECT</option>
                    @foreach ($programList as $x)
                      @if($editBean->programid==$x->id)
                      <option selected value="{{$x->id}}">{{$x->name}}</option>
                      @else
                      <option value="{{$x->id}}">{{$x->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="mediumid">Medium</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'medium')" class="form-control" name="mediumid" id="mediumid">
                    <option  value="">SELECT</option>
                    @foreach ($mediumList as $x)
                    @if($editBean->mediumid==$x->id)
                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                    @else
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>                    
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="shiftid">Shift</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'shift')" class="form-control" name="shiftid" id="shiftid">
                    <option  value="">SELECT</option>
                    @foreach ($shiftList as $x)
                    @if($editBean->shiftid==$x->id)
                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                    @else
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="groupid">Group</label>
                <div class="col-sm-4">
                  <select onchange="getChange(this,'group')" class="form-control" name="groupid" id="groupid">
                  <option  value="">SELECT</option>
                  @foreach ($groupList as $x)
                    @if($editBean->groupid==$x->id)
                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                    @else
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endif
                  @endforeach
                  </select>
                </div>                      
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="masterexamid">Master Exam</label>
                <div class="col-sm-4">
                  <select class="form-control" name="masterexamid" id="masterexamid">
                    <option  value="">SELECT</option>
                    @foreach ($masterExamNameList as $x)
                    @if($editBean->mxm_examnameid==$x->id)
                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                    @else
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label" for="examnameid">Child Exam</label>
                <div class="col-sm-4">
                  <select class="form-control" name="examnameid" id="examnameid">
                    <option  value="">SELECT</option>
                    @foreach ($childExamNameList as $x)
                    @if($editBean->cxm_examnameid==$x->id)
                    <option selected value="{{$x->id}}">{{$x->name}}</option>
                    @else
                    <option value="{{$x->id}}">{{$x->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>                   
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label" for="cxm_in_percentage">Exam in(%) of 100%</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="cxm_in_percentage" value="{{$editBean->cxm_in_percentage}}" id="cxm_in_percentage">
                </div> 
              </div>
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-striped table-bordered table-hover customtable">
                    <thead>
                      <tr>
                        <th>SL.NO</th>
                        <th>Subject Name</th>
                        <th>Code</th>
                        <th width="15%%">Marks</th>
                      </tr>
                    </thead>
                    <tbody id="childexamcourse">
                      <?php 
                        $sino=0;
                      ?>
                      @foreach($courseofferList as $x)
                      <tr>
                        <td>{{++$sino}}<input type="hidden" name="courseofferid[{{$x->id}}]" value="{{$x->id}}"></td>
                        <td>{{$x->courseName}}</td>
                        <td>{{$x->courseCode}}</td>
                        <td class="no-padding" ><input  class="form-control" type="text" name="marks[{{$x->id}}]" value="{{$x->marks}}"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div style="text-align:right;">
                <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn" value="update_btn">Update</button>
              </div>
            </form>
            @endif
          </div>
        </section>
      </div>
      <div class="col-lg-12">
        <section class="panel">
          <div class="table-responsive">
           <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>SL NO</th>
                <th>Program Name</th>
                <th>Master Name</th>
                <th>Child Exam</th>
                <th>Marks(%)</th>
                @if($pList[3]->id==3)
                <th width="10px">Edit</th>
                @endif
                @if($pList[4]->id==4)
                <th width="10px">Del</th>
                @endif
              </tr>
            </thead>
            <tbody>
              <?php $id=0; ?>
              @foreach($result as $x)
              <tr>
                <td>{{++$id}}</td>
                <td>{{$x->sessionName." "}}{{$x->programName." "}}{{$x->groupName." "}}{{$x->mediumName." "}}{{$x->shiftName." "}}</td>
                <td>{{$x->masterexamName}}</td>
                <td>{{$x->childexamName}}</td>
                <td>{{$x->cxm_in_percentage}}</td>
                @if($pList[3]->id==3)
                <td> 
                  <a href="{{URL::to('/childexam')}}/{{$x->id}}/{{'edit'}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                  </a>
                </td>
                @endif
                @if($pList[4]->id==4)
                <td>
                  <a href="" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                  </a>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>SL NO</th>
                <th>Program Name</th>
                <th>Master Name</th>
                <th>Child Exam</th>
                <th>Marks(%)</th>
                @if($pList[3]->id==3)
                <th width="10px">Edit</th>
                @endif
                @if($pList[4]->id==4)
                <th width="10px">Del</th>
                @endif
              </tr>
            </tfoot>
          </table>
        </div>
      </section>
    </div>
  </div>
</section>
</section>
@endsection
@section('uniqueScript')
<script src="{{asset('clientAdmin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('clientAdmin/js/baseUrl.js')}}"></script>
<script src="{{asset('clientAdmin/js/childexam.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function() {
  var table = $('#example').DataTable( {
    responsive: true
  } );
  new $.fn.dataTable.FixedHeader( table );
} );
</script>
@endsection
