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
            <div id="map">
            </div>
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
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    <input type="hidden" name="loc" id="loc" value="">
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
            // Listener for click on map
            google.maps.event.addListener(map, 'click', 
            function(event) {


                var location = event.latLng;
                console.log(location);
                if(marker != null)
                {
                    marker.setPosition(location);
                    return;
                }
                // Add marker
                marker = new google.maps.Marker({
                position: location,
                map: map
                });

                // set location variable
                loc = location;
                $('#loc').val(location.lat() + "," + location.lng());
                //Set unique id
                marker.id = uniqueId;
                uniqueId++;
                google.maps.event.addListener(marker, "click", function (e) {
                    var content = 'Latitude: ' + location.lat() + '<br />Longitude: ' + location.lng();
                    content += "<br /><input type = 'button' va;ue = 'Delete' onclick = 'DeleteMarker(" + marker.id + ");' value = 'Delete' />";
                    var infoWindow = new google.maps.InfoWindow({
                        content: content
                    });
                    infoWindow.open(map, marker);
                });
 
                gmarkers.push(marker);

                console.log(gmarkers.length - 1);
            });

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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK-FOiYk3WPwzrZYbqQ8z6m2zW7Ytc2bk&callback=initMap"
    async defer></script>
@endsection