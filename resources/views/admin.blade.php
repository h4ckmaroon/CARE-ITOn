@extends('layouts.master')

@section('title')
    {{"Administrator"}}
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="col-row">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <button type="button" data-toggle="modal" data-target="#createModal"  class="btn btn-success btn-md">
                    <i class="glyphicon glyphicon-plus"></i> New Record</a>
                </div>
            </div>
            <div class="box-body dataTable_wrapper">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="activeTableAdmin">
                        <table id="list" class="table table-striped table-bordered responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Username</th>
                                    <th>Personal Details</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td></td>
                                        <td>{{$admin->username}}</td>
                                        <td>
                                            <li>Name: {{$admin->detail->firstName}} {{$admin->detail->middleName}} {{$admin->detail->lastName}}</li>
                                            <li>Contact: {{$admin->detail->contactNo}}</li>
                                            <li>Email: {{$admin->detail->email}}</li>
                                        </td>
                                        <td class="text-right">
                                            <button onclick="updateModal({{$admin->id}})" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </button>
                                            <button onclick="deactivateShow({{$admin->id}})" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Deactivate record">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                            {!! Form::open(['method'=>'delete','action' => ['AdminController@destroy',$admin->id],'id'=>'del'.$admin->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="inactiveTableAdmin">
                        <table id="dlist" class="table table-striped table-bordered responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Username</th>
                                    <th>Personal Details</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deactivate as $admin)
                                    <tr>
                                        <td></td>
                                        <td>{{$admin->username}}</td>
                                        <td>
                                            <li>Name: {{$admin->detail->firstName}} {{$admin->detail->middleName}} {{$admin->detail->lastName}}</li>
                                            <li>Contact: {{$admin->detail->contactNo}}</li>
                                            <li>Email: {{$admin->detail->email}}</li>
                                        </td>
                                        <td class="text-right">
                                            <button onclick="reactivateShow({{$admin->id}})"type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Reactivate record">
                                                <i class="glyphicon glyphicon-refresh"></i>
                                            </button>
                                            {!! Form::open(['method'=>'patch','action' => ['AdminController@reactivate',$admin->id],'id'=>'reactivate'.$admin->id]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group pull-right">
                    <label class="checkbox-inline"><input type="checkbox" id="showDeactivated"> Show deactivated records</label>
                </div>
                {{-- Create --}}
                <div id="createModal" class="modal fade">
                    <div class="modal-dialog">
                    {!! Form::open(['url' => 'admin']) !!}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">New Record</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    @include('layouts.required')
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="form-group">
                                            {!! Form::label('username', 'Username') !!}<span>*</span>
                                            {!! Form::input('text','username',null,[
                                                'class' => 'form-control',
                                                'id' => 'username',
                                                'placeholder'=>'Username',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('firstName', 'First Name') !!}<span>*</span>
                                            {!! Form::input('text','firstName',null,[
                                                'class' => 'form-control',
                                                'id' => 'firstname',
                                                'placeholder'=>'First Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('middleName', 'Middle Name') !!}
                                            {!! Form::input('text','middleName',null,[
                                                'class' => 'form-control',
                                                'id' => 'middleName',
                                                'placeholder'=>'Middle Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('lastName', 'Last Name') !!}<span>*</span>
                                            {!! Form::input('text','lastName',null,[
                                                'class' => 'form-control',
                                                'id' => 'lastName',
                                                'placeholder'=>'Last Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('contactNo', 'Contact No.') !!}<span>*</span>
                                            {!! Form::input('text','contactNo',null,[
                                                'class' => 'form-control',
                                                'id' => 'contactNo',
                                                'placeholder'=>'Contact No.',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email') !!}<span>*</span>
                                            {!! Form::input('text','email',null,[
                                                'class' => 'form-control',
                                                'id' => 'email',
                                                'placeholder'=>'Email',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                {{-- Update --}}
                <div id="updateModal" class="modal fade">
                    <div class="modal-dialog">
                    {!! Form::open(['method'=>'patch','action' => ['AdminController@update',0]]) !!}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Update Record</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    @include('layouts.required')
                                    <input id="userId" name="id" type="hidden">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="form-group">
                                            {!! Form::label('username', 'Username') !!}<span>*</span>
                                            {!! Form::input('text','username',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-username',
                                                'placeholder'=>'Username',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('firstName', 'First Name') !!}<span>*</span>
                                            {!! Form::input('text','firstName',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-firstName',
                                                'placeholder'=>'First Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('middleName', 'Middle Name') !!}
                                            {!! Form::input('text','middleName',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-middleName',
                                                'placeholder'=>'Middle Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('lastName', 'Last Name') !!}<span>*</span>
                                            {!! Form::input('text','lastName',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-lastName',
                                                'placeholder'=>'Last Name',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('contactNo', 'Contact No.') !!}<span>*</span>
                                            {!! Form::input('text','contactNo',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-contactNo',
                                                'placeholder'=>'Contact No.',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email') !!}<span>*</span>
                                            {!! Form::input('text','email',null,[
                                                'class' => 'form-control',
                                                'id' => 'update-email',
                                                'placeholder'=>'Email',
                                                'maxlength'=>'50']) 
                                            !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
                @include('layouts.deactivateModal')
                @include('layouts.reactivateModal')
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ URL::asset('js/record.js') }}"></script>
    <script>
        $(document).ajaxStart(function() { Pace.restart(); });
        $(document).ready(function (){
            $('#list').DataTable({
                responsive: true,
            });
            $('#dlist').DataTable({
                responsive: true,
            });
            $('#mAdmin').addClass('active');
        });
        function updateModal(id){
            $.ajax({
				type: "GET",
				url: "/admin/"+id+"/edit",
				dataType: "JSON",
				success:function(data){
                    $("#userId").val(data.user.id);
					$("#update-username").val(data.user.username);
					$("#update-firstName").val(data.user.detail.firstName);
                    $("#update-middleName").val(data.user.detail.middleName);
                    $('#update-lastName').val(data.user.detail.lastName);
                    $('#update-contactNo').val(data.user.detail.contactNo);
                    $('#update-email').val(data.user.detail.email);
				}
			});
            $('#updateModal').modal('show');
        }
    </script>
@stop