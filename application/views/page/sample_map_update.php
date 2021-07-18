<!DOCTYPE html>
<html>
<head>
<title>Autocomplete search address form using google map and get data into form example </title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8-oOXmKNQrxbp22AkoinGCACesoVoGeU&language=id&sensor=false&libraries=places"></script>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQFJaeC-XsLgEBgbWRW0CJWo1J6eeqvSo&language=id&sensor=false&libraries=places"></script> -->

<style type="text/css">
    .input-controls2 {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput2 {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 50%;
    }
    #searchInput2:focus {
      border-color: #4d90fe;
    }
    .pac-container { z-index: 100000 !important; }

</style>

</head>
<body>
 <input id="searchInput2" class="input-controls2" type="text" placeholder="Enter a location">
 <div class="map_update" id="map_update" style="width: 100%; height: 300px;"></div>
 <div class="form_area">
     <span id="location_update" style="color: #333;font-weight: bold;"></span>
     <input type="hidden" name="lat_update" id="lat_update">
     <input type="hidden" name="lng_update" id="lng_update">
 </div>
<script>
/* script */
function initialize2() {
   var latlng = new google.maps.LatLng(-8.670458,115.212631);
    var map = new google.maps.Map(document.getElementById('map_update'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput2');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        bindDataToForm2(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);

    });
    // this function will work on marker move event into map
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
              bindDataToForm2(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm2(address,lat,lng){
   document.getElementById('location_update').innerHTML = address;
   document.getElementById('lat_update').value = lat;
   document.getElementById('lng_update').value = lng;
}
//google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
