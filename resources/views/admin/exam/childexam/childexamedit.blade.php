@extends('admin.admin')
@section('uniqueStyle')
<link href="{{asset('clientAdmin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('clientAdmin/css/custom.css')}}" rel="stylesheet">
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
              @if($pList[2]->id==2)
              <li><a href="{{URL::to('/childexam')}}">Create</a></li>
              @endif
              @if ($errors->any())
                  <span style="float: right;font-size: 15px;">{{$errors->all()[0] }}</span>
              @endif
              @if(session()->has('msg'))
              <span style="float: right;font-size: 15px;">
                {{ session()->get('msg') }}
              </span>
              @endif
              @if($msg!='')
              <span style="float: right;font-size: 15px;">
                {{ $msg }}
              </span>
              @endif
          </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel margin-bottom-zero">
          <div class="child-exam-wrapper">
            <div class="child-exam__item">
              <form action="{{URL::to('childexam')}}/{{$bean->id}}/{{'edit'}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                  <label class="col-sm-2 control-label" for="programid">Program</label>
                  <div class="col-sm-4">
                    <select onchange="getChange(this,'program')" class="form-control" name="programid" id="programid">
                      <option  value="">SELECT</option>
                      @foreach ($programList as $x)
                        @if($x->id==$bean->programid)
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
                        @if($x->id==$bean->mediumid)
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
                        @if($x->id==$bean->shiftid)
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
                        @if($x->id==$bean->groupid)
                            <option selected value="{{$x->id}}">{{$x->name}}</option>
                        @else
                            <option value="{{$x->id}}">{{$x->name}}</option>
                        @endif
                    @endforeach
                    </select>
                  </div>                          
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label" for="mst_examnameid">Master Exam</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="mst_examnameid" id="mst_examnameid">
                        <option  value="">SELECT</option>
                        @foreach ($masterExamNameList as $x)
                            @if($x->id==$bean->mst_examnameid)
                                <option selected value="{{$x->id}}">{{$x->name}}</option>
                            @else
                                <option value="{{$x->id}}">{{$x->name}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label" for="child_examnameid">Child Name</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="child_examnameid" id="child_examnameid">
                        <option  value="">SELECT</option>
                        @foreach ($childExamNameList as $x)
                            @if($x->id==$bean->child_examnameid)
                                <option selected value="{{$x->id}}">{{$x->name}}</option>
                            @else
                                <option value="{{$x->id}}">{{$x->name}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>                 
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label" for="hld_marks">Marks</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="hld_marks" id="hld_marks" value="{{$bean->hld_marks}}">
                  </div>
                </div>
                <div style="text-align:right;">
                  <button type="submit" class="btn btn-success result-btn result-btn-margin-zero" name="btn_update" value="btn_update">Update</button>
                </div>
              </form>
            </div>
            <div class="child-exam__item">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>SL NO</th>
                      <th>Class</th>
                      <th>Master Exam</th>
                      <th>Child Exam</th>
                      <th>Marks</th>
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
                    @foreach($child_exam_list as $x)
                      <tr>
                        <td>{{++$id}}</td>
                        <td>{{sprintf("%s %s %s %s %s",$x->sessionName,$x->programName,$x->mediumName,$x->shiftName,$x->groupName)}}</td>
                        <td>{{$x->mstEaxmName}}</td>
                        <td>{{$x->childExamName}}</td>
                        <td>{{$x->hld_marks}}</td>
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
                      <th>Class</th>
                      <th>Master Exam</th>
                      <th>Child Exam</th>
                      <th>Marks</th>
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
            </div>
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
