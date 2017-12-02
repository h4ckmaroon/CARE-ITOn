@extends('layouts.master')

@section('title')
    {{"Dashboard"}}
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
    <style type="text/css">
    #map {
        height: 500px;
        width: 100%;
    }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Item Rates</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="listRates" class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Rate/kg (PhP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{number_format($item->rate,2)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <div id="map">
          </div>
        </div>

         <img class="selector" id="webcamimg" src="../pics/vidcam.png" onclick="setwebcam()" align="left" style="opacity: 1;">
  <img class="selector" id="qrimg" src="../pics/cam.png" onclick="setimg()" align="right" style="opacity: 0.2;">
  <div id = "outdiv">
  <video id="v" autoplay></video>
  </div>
  <div id = "result">- scanning -</div>

 

</div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-responsive/js/dataTables.responsive.js') }}"></script>
     <script src = "{{ URL::asset('/qrcodes/webqr.js') }} " ></script>
    <script>
        $(document).ready(function (){
            $('#listRates').DataTable({
                responsive: true,
            });
            $('#dashboard').addClass('active');
           
        });
    </script>
    <script type="text/javascript">
        var requests = {!!  ($requests) !!};
        var map;
        var marker;
        var gmarkers = [];
        var uniqueId = 1;
        var geocoder;
        var map;
         var request;

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

            for(var j = 0; j < requests.length; j++)
            {
                var latLng = requests[j].location.split(",");
                var marker = new google.maps.Marker({
                position: {lat: parseFloat(latLng[0]), lng: parseFloat(latLng[1])},
                map: map
                });
                google.maps.event.addListener(marker, "click", function (e) {
                var content = 'Latitude: ' + latLng[0] + '<br />Longitude: ' + latLng[1];
                    var infoWindow = new google.maps.InfoWindow({
                        content: content
                    });
                infoWindow.open(map, marker);
                gmarkers.push(marker);
            });
            }

            

            // $.ajax({
            //     type: 'GET',
            //     url: 'https://maps.googleapis.com/maps/api/geocode/json?address=manila',
            //     dataType: 'json',
            //     success: function (data) {
            //     var marker = new google.maps.Marker({
            //         position: { lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng},
            //         map: map
            //     });

            //     gmarkers.push(marker);
                
            //     },
            //     error: function (data) {
            //         console.log(data);
            //     }
            // });



            // Listener for click on map
            // google.maps.event.addListener(map, 'click', 
            // function(event) {

            //     var location = event.latLng;
            //     // Add marker
            //     var marker = new google.maps.Marker({
            //     position: location,
            //     map: map
            //     });
            //     //Set unique id
            //     marker.id = uniqueId;
            //     uniqueId++;
            //     google.maps.event.addListener(marker, "click", function (e) {
            //         var content = 'Latitude: ' + location.lat() + '<br />Longitude: ' + location.lng();
            //         content += "<br /><input type = 'button' va;ue = 'Delete' onclick = 'DeleteMarker(" + marker.id + ");' value = 'Delete' />";
            //         var infoWindow = new google.maps.InfoWindow({
            //             content: content
            //         });
            //         infoWindow.open(map, marker);
            //     });
 
            //     gmarkers.push(marker);

            //     console.log(gmarkers.length - 1);

            // });

        };

        function MakeRoute()
        {
            // directionsService.route(request, function(result, status) {
            //     if (status == google.maps.DirectionsStatus.OK) {
            //       directionsDisplay.setDirections(result);
            //     }
            //   });
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

    <script type="text/javascript" src="{{ URL::asset('/qrcodes/jsqrcode-combined.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/qrcodes/html5-qrcode.min.js') }}"></script>
    <script type="text/javascript">
          //qr reader


   

       
    </script>
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/datatables/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/datatables/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script>
        $(document).ready(function (){
            $('#listRates').DataTable({
                responsive: true,
            });
            $('#dashboard').addClass('active');
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

            $.ajax({
                type: 'GET',
                url: 'https://maps.googleapis.com/maps/api/geocode/json?address=quezon city',
                dataType: 'json',
                success: function (data) {
                var marker = new google.maps.Marker({
                    position: { lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng},
                    map: map
                });

                gmarkers.push(marker);

                },
                error: function (data) {
                    console.log(data);
                }
            });

            $.ajax({
                type: 'GET',
                url: 'https://maps.googleapis.com/maps/api/geocode/json?address=manila',
                dataType: 'json',
                success: function (data) {
                var marker = new google.maps.Marker({
                    position: { lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng},
                    map: map
                });

                gmarkers.push(marker);
                
                },
                error: function (data) {
                    console.log(data);
                }
            });



            // Listener for click on map
            google.maps.event.addListener(map, 'click', 
            function(event) {

                var location = event.latLng;
                // Add marker
                var marker = new google.maps.Marker({
                position: location,
                map: map
                });
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
                // if (i == 0) request.origin = marker.getPosition();
                // else if (i == gmarkers.length - 1) request.destination = marker.getPosition();
                // else {
                //   if (!request.waypoints) request.waypoints = [];
                //   request.waypoints.push({
                //     location: marker.getPosition(),
                //     stopover: true
                //   });
                // }
                // i++;
                // console.log(marker.getPosition());

            });

        };

        function MakeRoute()
        {
            // directionsService.route(request, function(result, status) {
            //     if (status == google.maps.DirectionsStatus.OK) {
            //       directionsDisplay.setDirections(result);
            //     }
            //   });
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