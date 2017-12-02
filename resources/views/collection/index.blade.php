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
                    <a href="{{ URL::to('/collection/create') }}" class="btn btn-success btn-md">
                    <i class="glyphicon glyphicon-plus"></i> New Record</a>
                </div>
            </div>
            <div class="box-body dataTable_wrapper">
                <table id="list" class="table table-striped table-bordered responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Collected By</th>
                            <th>Items</th>
                            <th>Earnings</th>
                            <!-- <th class="text-right">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collections as $collection)
                            @if($collection->request->userId==$userLog->id)
                            <tr>
                                <td>
                                    {{$collection->created_at}}
                                </td>
                                <td>{{$collection->collectorId->detail->firstName}} {{$collection->collectorId->detail->lastName}}</td>
                                <td>
                                    @php $total = 0; @endphp
                                    @foreach($collection->detail as $detail)
                                        <li>{{$detail->item->name}} x {{$detail->quantity}} pcs.</li>
                                    $total += $detail->quantity x $detail->item->rate->where('created_at','<=',$collection->created_at)->first()->rate
                                    @endforeach
                                </td>
                                <td>
                                    {{number_format($total,2)}}
                                </td>
                            </tr>
                            @endif
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
            $('#tCollection').addClass('active');
        });
    </script>
@stop