@extends('layouts.master')

@section('title')
    {{"Request"}}
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
                    <a href="{{ URL::to('/request/create') }}" class="btn btn-success btn-md">
                    <i class="glyphicon glyphicon-plus"></i> New Record</a>
                </div>
            </div>
            <div class="box-body dataTable_wrapper">
                <table id="list" class="table table-striped table-bordered responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Items</th>
                            <!-- <th class="text-right">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>
                                    <img width="100px" height="100px" src = "data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->generate("$request->qrCode")) !!}">
                                    {{$request->qrCode}} 
                                </td>
                                <td>{{$request->created_at}}</td>

                                <td>
                                    @foreach($request->detail as $detail)
                                        <li>{{$detail->item->name}} - {{$detail->description}}</li>
                                    @endforeach
                                </td>
                                <!-- <td class="text-right">
                                    <a href="{{url('/request/'.$request->id.'/edit')}}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update record">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script>
        $(document).ajaxStart(function() { Pace.restart(); });
        $(document).ready(function (){
            $('#list').DataTable({
                responsive: true,
            });
            $('#tRequest').addClass('active');
        });
    </script>
@stop