@extends('layouts.app')

@section('content')

@endsection

@section('wed-host-script')

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1vfhqHr3ukWp1q55-YObQ1LdWlhTTC5k&callback=initMap&libraries=&v=weekly" async></script>
<!-- <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> -->
<script>
  $(document).ready(function() {

    function initialize() {

      // Define the latitude and longitude positions

      var latitude = parseFloat("<?php echo $lat; ?>"); // Latitude get from above variable    
      var longitude = parseFloat("<?php echo $long; ?>"); // Longitude from same     
      var latlngPos = new google.maps.LatLng(latitude, longitude);



      // Set up options for the Google map

      var myOptions = {
        zoom: 13,
        center: latlngPos,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControlOptions: true,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.LARGE
        }

      };

      // Define the map

      map = new google.maps.Map(document.getElementById("display_map"), myOptions);
      addMarker(latlngPos, 'Default Marker', map);

      google.maps.event.addListener(map, 'dragstart', function(event) {
        addMarker(event.latlngPos, 'Click Generated Marker', map);

        var lat, lng, address;

      });

    }


    function addMarker(latlng, title, map) {

      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: title,
        icon: 'map-red.png',
        draggable: true,
        animation: google.maps.Animation.DROP
      });

      google.maps.event.addListener(marker, 'drag', function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();

      });



      google.maps.event.addListener(marker, 'dragend', function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
        alert(marker.getPosition());
      });

      google.maps.event.addListener(map, 'zoom_changed', function() {
        document.getElementById('zoom').value = map.getZoom();
      });

    }

    google.maps.event.addDomListener(window, 'load', initialize);

  });
</script>


@endsection