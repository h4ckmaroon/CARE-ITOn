@extends('layouts.master')

@section('title')
    {{"Request"}}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="col-row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                {!! Form::label('itemId', 'Item') !!}
                <select name="itemId" class="select2 form-control" id="itemId">
                    @foreach($items as $item)
                        <option value="{{$item->id}},{{$item->rate}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Add</button>
            </div>
            <table id="list" class="table table-striped table-bordered responsive">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Rate</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ajaxStart(function() { Pace.restart(); });
        $(document).ready(function(){
            $('#list').DataTable({
                responsive: true,
            });
            $('.select2').select2();
        })
    </script>
@endsection