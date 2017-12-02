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
            <div class="box">
                <div class="box-header with-border">
                    {!! Form::open(['url' => 'request']) !!}
                    <div class="col-md-12">
                        {!! Form::label('itemId', 'Item') !!}
                        <div class="row">
                            <div class="col-md-10">
                                <select name="itemId" class="select2 form-control" id="itemId">
                                <option value="0">Choose an Item</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}" data-rate="{{ $item->rate }}" data-desc="{{ $item->desc }}" id="item{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="add">Add</button>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br>
                    <input type="hidden" name="userId" value="{{$user->id}}">
                    <table id="list" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
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

        $('#add').on('click', function(){
            if($('#itemId').val()!=0){
                var rate = $('option:selected', '#itemId').attr('data-rate');
                var desc = $('option:selected', '#itemId').attr('data-desc');
                var name = $('option:selected', '#itemId').text();
                var id = "#item" + $('#itemId').val();
                var code = $('#itemId').val();


                $('#list').DataTable().row.add([
                    name + '<input type="hidden" name="itemId[]" value="'+code+'">',
                    '<input type="text" name="description[]">',
                    'Php ' + parseInt(rate).toFixed(2),
                    "<button class='btn btn-danger btnRemove' id='rem"+ code +"' value='"+ code +"'>Remove</button>"
                ]).draw();

                $(id).prop('disabled', true);
                $('.select2').val(0);
                $('.select2').select2();
            }
        });

        $('#list').on("click", "button", function(){
            var val = $(this).val();

            console.log($(this).parent());
            $('#list').DataTable().row($(this).parents('tr')).remove().draw(false);

            $("#item" + val).prop('disabled', false);
            $('.select2').select2();
        });
    </script>
@endsection