<?php $dataCompany=$this->model_global->getCompanyProfile()->row()?>


 <div id="map"></div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0YIK8MlBcc8GGQANjBKMBzI8LhLWgYBw&language=id"></script>
<script type="text/javascript">
  var lat_db='<?=$dataCompany->latitude?>';
  var lng_db='<?=$dataCompany->longitude?>';
</script>
<script type="text/javascript">
  window.onload = function() {
    var latlng = new google.maps.LatLng(lat_db, lng_db);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    google.maps.event.addListener(marker, 'dragend', function(a) {
        //swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        var latitude=a.latLng.lat().toFixed(4);
        var langitude=a.latLng.lng().toFixed(4);
        document.getElementById('input_lat').value=latitude;
        document.getElementById('input_lng').value=langitude;

        // var div = document.getElementById('lokasi');
        // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        // document.getElementById('penampung')[0].appendChild(div);
    });
};  

function Test(){
    var latlng = new google.maps.LatLng(lat_db, lng_db);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    google.maps.event.addListener(marker, 'dragend', function(a) {
        //swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        var latitude=a.latLng.lat().toFixed(4);
        var langitude=a.latLng.lng().toFixed(4);
        document.getElementById('input_lat').value=latitude;
        document.getElementById('input_lng').value=langitude;

        // var div = document.getElementById('lokasi');
        // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        // document.getElementById('penampung')[0].appendChild(div);
    });
}
</script>

