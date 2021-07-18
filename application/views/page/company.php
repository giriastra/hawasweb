<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
   /* background-image: url('<?=base_url()?>assets/img/company.jpg');*/
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
  height: 400px;
   box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
</style>

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

<div class="col-xl-12 col-lg-12" style="float:left;">
  <p style="text-align: center; color: #fff; font-size: 25px;font-weight: bold;"><?=$dataCompany->company_name?></p>
</div>


<div class="col-xl-12 col-lg-12" style="float:left; margin-top: 50px">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Company profile</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
              <div class="col-xl-8 col-lg-12">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nama perusahaan</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->company_name?>" id="namaPerusahaan">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Alamat</label>
                  <textarea class="form-control" id="alamat"><?=$dataCompany->address?></textarea>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Email</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->email?>" id="email">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Phone</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->phone?>" id="phone">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Phone 2</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->phone2?>" id="phone2">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Website</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->website?>" id="website">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Pc name</label>
                  <input type="text" class="form-control" value="<?=$dataCompany->pc_name?>" id="pc_name">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Visi</label>
                  <textarea class="form-control" rows="3" id="visi"><?=$dataCompany->visi?></textarea>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Misi</label>
                  <textarea class="form-control" rows="12" id="misi"><?=$dataCompany->misi?></textarea>
                  <input type="hidden" id="input_lat">
                  <input type="hidden" id="input_lng">
                  <input type="hidden" value="<?=$dataCompany->id_company?>" id="id_company">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Lokasi</label>

                  <body onload="initialize_map(); ">
                  	<div id="map"></div>
                  </body>

                </div>
                <hr>
                <div class="form-group">
                  <button class="btn btn-primary" onclick="EditCompany()"><i class="la la-edit"></i> Ubah data</button>
                </div>
              </div>
            </div>


        </div>
</div>
<!--/ Global settings -->
<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css"></link>
<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>


<script type="text/javascript">
  var lat_db='<?=$dataCompany->latitude?>';
  var lng_db='<?=$dataCompany->longitude?>';
</script>
<script >

var map;
var mapLat = parseFloat(<?=$dataCompany->latitude?>);
var mapLng = parseFloat(<?=$dataCompany->longitude?>);
var mapDefaultZoom = 16;

function initialize_map() {
  map = new ol.Map({
    target: "map",
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM({
                  url:"https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"

            })
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([mapLng, mapLat]),
        zoom: mapDefaultZoom,
    })
  });

  addMarker(mapLat, mapLng);
  map.on('click', onMapClick);


  function onMapClick(e) {
    var data = ol.proj.transform(e.coordinate, 'EPSG:3857', 'EPSG:4326');
    console.log(data[0] + " "+data[1]);
    add_map_point(data[1], data[0]);

    document.getElementById('input_lat').value=data[1];
    document.getElementById('input_lng').value=data[0];

  }
}

var vectorLayer_new;
function add_map_point(lat, lng) {
  if(vectorLayer_new==null){
    addMarker(lat, lng);
  }else{
    this.map.removeLayer(vectorLayer_new);
    addMarker(lat, lng);
  }

}

function addMarker(lat, lng){
  var vectorLayer = new ol.layer.Vector({
    source:new ol.source.Vector({
      features: [new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),

        })]
    }),
    style: new ol.style.Style({
      image: new ol.style.Icon({
        anchor: [0.5, 0.5],
        anchorXUnits: "fraction",
        anchorYUnits: "fraction",
        src: "https://upload.wikimedia.org/wikipedia/commons/0/0a/Marker_location.png"
      })
    })
  });
  map.addLayer(vectorLayer);
  vectorLayer_new = vectorLayer;
}


  function EditCompany(){
    $("#pageloader").fadeIn();
     setTimeout(function() {
        var datasend = new FormData();
            datasend.append('id_company',$('#id_company').val());
            datasend.append('namaPerusahaan',$('#namaPerusahaan').val());
            datasend.append('email',$('#email').val());
            datasend.append('website',$('#website').val());
            datasend.append('visi',$('#visi').val());
            datasend.append('misi',$('#misi').val());
            datasend.append('phone',$('#phone').val());
            datasend.append('phone2',$('#phone2').val());
            datasend.append('pc_name',$('#pc_name').val());
            datasend.append('lat',$('#input_lat').val());
            datasend.append('long',$('#input_lng').val());
            datasend.append('alamat',$('#alamat').val());
            $.ajax({
                url: '<?=base_url()?>Utility/UpdateDataPerusahaan',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                   $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Data Perusahaan Berhasil Di Ubah" ,"success")
                    .then((value) => {
                      window.location.reload();
                    });
                  } else {
                    swal("Informasi","Terjadi Kesalahan Mohon Coba Beberapa Saat Lagi" ,"error");
                  }
                },
                error: function(data) {
                  console.log(data);
                  $("#pageloader").hide();
                    swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
      }, 300);
  }

</script>
