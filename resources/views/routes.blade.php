@extends('layouts.master')

@section('title')
    {{"Request"}}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}">
    <style type="text/css">
    #map {
        height: 500px;
        width: 100%;
    }
    </style>
@endsection

@section('content')
    <div class="col-row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    {!! Form::open(['url' => 'request']) !!}
                    <div class="col-md-12">
                        {!! Form::label('requestId', 'Request') !!}
                        <div class="row">
                            <div class="col-md-4">
                                <select name="requestId" class="select2 form-control" id="requestId">
                                <option value="0">Choose a Request</option>
                                    @foreach($requests as $request)
                                        <option value="{{$request->id}}" id="request{{$request->id}}" data-location="{{ $request->location }}">{{$request->user->detail->firstName . ' ' . $request->user->detail->lastName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="collectorId" class="select2 form-control" id="collectorId">
                                <option value="0">Choose a Collector</option>
                                    @foreach($collectors as $collector)
                                        <option value="{{$collector->id}}" id="collector{{$collector->id}}">{{$collector->detail->firstName . ' ' . $collector->detail->lastName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="add">Add</button>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br>
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    <input type="hidden" name="loc" id="loc" value="">
                    <table id="list" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th>Requestor</th>
                                <th>Collector</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="map">
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


   <script type="text/javascript">
        var map;
        var marker;
        var gmarkers = [];
        var uniqueId = 1;
        var geocoder;
        var map;
        var request;

        var loc;

        var directionsService;
        var directionsDisplay;
        
        function initMap()
        {
            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer;
            request = {
                travelMode: google.maps.TravelMode.DRIVING
              };
            var geocoder;
            // var directionsDisplay new google.maps.DirectionsRenderer();
            // var directionsService = new google.maps.DirectionsService();

            // Create the search box and link it to the UI element.
            
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: 14.6760, lng: 121.0437}
            });
            directionsDisplay.setMap(map);
            // $.get("https://maps.googleapis.com/maps/api/geocode/json?address=quezon+city&key=AIzaSyCK-FOiYk3WPwzrZYbqQ8z6m2zW7Ytc2bk", function(data, status){
            //     alert("Data: " + data + "\nStatus: " + status);
            // });

            
            var i = 0;
            var marker = null;
           

        };

        function MakeRoute()
        {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        for (var i = 1; i < gmarkers.length - 1; i++) {
            waypts.push({
              location: gmarkers[i].getPosition(),
              stopover: true
            });
        }

        directionsService.route({
          origin: gmarkers[0].getPosition(),
          destination: gmarkers[gmarkers.length - 1].getPosition(),
          waypoints: waypts,
          travelMode: 'DRIVING'
        }, function(response, status) {
         if (status == google.maps.DirectionsStatus.OK) {

                  directionsDisplay.setDirections(response);
                }
        });

        }

        function DeleteMarker(id) {
        //Find and remove the marker from the Array
        for (var i = 0; i < gmarkers.length; i++) {
            if (gmarkers[i].id == id) {
                //Remove the marker from Map                  
                gmarkers[i].setMap(null);
 
                //Remove the marker from array.
                gmarkers.splice(i, 1);
                return;
            }
        }
    }
       

    </script>
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
                var name = $('option:selected', '#requestId').text();
                var c_name = $('option:selected', '#collectorId').text();
                var r_location = $('option:selected', '#requestId').attr('data-location');
                var id = "#item" + $('#itemId').val();
                var code = $('#itemId').val();


                $('#list').DataTable().row.add([
                    name,
                    c_name,
                    r_location,
                    "<button class='btn btn-danger btnRemove' id='rem"+ code +"' value='"+ code +"'>Remove</button>"
                ]).draw();

                $(id).prop('disabled', true);
                $('.select2').val(0);
                $('.select2').select2();

                var latLng = r_location.split(",");
                var marker = new google.maps.Marker({
                position: {lat: parseFloat(latLng[0]), lng: parseFloat(latLng[1])},
                map: map
                });
                gmarkers.push(marker);
                calculateAndDisplayRoute(directionsService, directionsDisplay);
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK-FOiYk3WPwzrZYbqQ8z6m2zW7Ytc2bk&libraries=places&callback=initMap"
    async defer></script>
@endsection