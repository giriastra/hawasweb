
<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css"></link>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    background-image: linear-gradient(to right, #9f78ff, #32cafe);
}

.content-wrapper-before {
    height: 200px !important;
}
.circle_txt {
  border:2px solid #989595;
  padding: 5px;
  border-radius: 50%
}

.table_txt tr td{
  padding: 10px;
}
#map {
  height: 600px;
/*   box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
*/}

.ol-popup {
      position: absolute;
      background-color: white;
      /*--webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));*/
      filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
      padding: 15px;
      border-radius: 10px;
      border: 1px solid #cccccc;
      bottom: 12px;
      left: -50px;
      min-width: 180px;
  }

  .ol-popup:after, .ol-popup:before {
      top: 100%;
      border: solid transparent;
      content: " ";
      height: 0;
      width: 0;
      position: absolute;
      pointer-events: none;
  }

  .ol-popup:after {
      border-top-color: white;
      border-width: 10px;
      left: 48px;
      margin-left: -10px;
  }

  .ol-popup:before {
      border-top-color: #cccccc;
      border-width: 11px;
      left: 48px;
      margin-left: -11px;
  }

</style>
<script>
var straitSource;
  var map;
</script>


      <?php $dataCompany=$this->model_global->getCompanyProfile()->row()?>
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name?></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active"><?=$page_name?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

  <div class="col-xl-12 col-lg-12" style="float:left">
          <div class="card">


            <div class="card-body">

              <div class="alert alert-warning" role="alert" style="background: #48bafe; border-color: #48bafe">
                  <b> <center><i class="la la-map-marker"></i> Lokasi PETUGAS</center></b>
                </div>
                <body >

                  <div id="map"></div>
                   <div id="popup" title="myproject" class="ol-popup"><a href="#" id="popup-closer" class="ol-popup-closer"></a><div id="popup-content"></div></div>

                </body>


            </div>


        </div>
</div>

<script>
var json=<?=$LokasiTerkiniPetugas?>;
var lat=0;
var long=0;
var mapDefaultZoom=<?=$zoom?>;
var obj;
var data;

console.log("lenght "+json.length);
if(json.length>1){

  lat   = parseFloat(<?=$lat?>);
  long  = parseFloat(<?=$long?>);
  data=json;
}else{
  data=json;
  zoom_val=15;
  obj = json[0];
  lat   = parseFloat(obj.latitude);
  long  = parseFloat(obj.longitude);
}
// data=[{"Lon":115.212631,"Lat":-8.670458}];


content = document.getElementById('popup-content');
var center = ol.proj.transform([long, lat], 'EPSG:4326', 'EPSG:3857'); //initial position of map
    var view = new ol.View({
        center: center,
        zoom: mapDefaultZoom
    });

//raster layer on map
   var OSMBaseLayer = new ol.layer.Tile({
        source: new ol.source.OSM()
    });

 straitSource = new ol.source.Vector({ wrapX: true });
    var straitsLayer = new ol.layer.Vector({
        source: straitSource
    });

 map = new ol.Map({
        layers: [OSMBaseLayer, straitsLayer],
        target: 'map',
        view: view,
        controls: [new ol.control.FullScreen(), new ol.control.Zoom()]
    });

   // Popup showing the position the user clicked
    var container = document.getElementById('popup');
    var popup = new ol.Overlay({
        element: container,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    });
    map.addOverlay(popup);

  /* Add a pointermove handler to the map to render the popup.*/
    map.on('pointermove', function (evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel, function (feat, layer) {
            return feat;
        }
        );

        if (feature && feature.get('type') == 'Point') {
            var coordinate = evt.coordinate;    //default projection is EPSG:3857 you may want to use ol.proj.transform

            content.innerHTML = feature.get('desc');
            popup.setPosition(coordinate);
        }
        else {
            popup.setPosition(undefined);

        }
    });

    // var mapLat = -8.670458;
    // var mapLng = 115.212631;



function addPointGeom(data) {


        data.forEach(function(item) { //iterate through array...

            var longitude = parseFloat(item.longitude),latitude = parseFloat(item.latitude),
                iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform([longitude, latitude], 'EPSG:4326',
                        'EPSG:3857')),
                   type: 'Point',
                    desc: '<pre> <b>Nama: '+item.nama_petugas+' </b> ' + '<br>' + 'Latitude : '
                    + latitude + '<br>Longitude: ' + longitude + '</pre>'
                  }),
                iconStyle = new ol.style.Style({
                    // image: new ol.style.Circle({
                    //     radius: 5,
                    //     stroke: new ol.style.Stroke({
                    //         color: 'blue'
                    //     }),
                    //     fill: new ol.style.Fill({
                    //         color: [57, 228, 193, 0.84]
                    //     }),
                    // })

                    image: new ol.style.Icon({
                      anchor: [0.5, 0.5],
                      anchorXUnits: "fraction",
                      anchorYUnits: "fraction",
                      src: "https://upload.wikimedia.org/wikipedia/commons/0/0a/Marker_location.png"
                    })

                });

            iconFeature.setStyle(iconStyle);
            straitSource.addFeature(iconFeature);
        });
    }// End of function showStraits()

addPointGeom(data);


</script>
