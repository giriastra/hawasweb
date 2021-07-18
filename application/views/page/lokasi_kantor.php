
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
   /*box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);*/
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

<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
                 <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">+ Tambah</button>
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

              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 30px">No</th>
                        <th scope="col"style="width: 100px">Jenis kantor</th>
                        <th scope="col"style="width: 200px">Nama kantor</th>
                        <th scope="col"style="width: 300px">Alamat</th>
                        <th scope="col"style="width: 100px">Telp</th>
                        <th scope="col"style="width: 100px">Latitude</th>
                        <th scope="col"style="width: 170px">Longitude</th>
                        <th scope="col"style="width: 70px">Status</th>

                        <th scope="col" style="width: 150px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_lokasi_kantor')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['jenis_kantor']?></td>
                        <td><?=$row['nama_kantor']?></td>
                        <td><?=$row['alamat']?></td>
                        <td><?=$row['telp']?></td>
                        <td><?=$row['latitude']?></td>
                        <td><?=$row['longitude']?></td>
                        <td>
                          <?php
                            if ($row['status']=='Y') {
                              echo "<b class='success'>Aktif</b>";
                            } else {
                              echo "<b class='danger'>Tidak Aktif</b>";
                            }
                          ?>
                        </td>
                        <td>
                          <center>

                          <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id']?>')"><i class="la la-trash"></i></button>
                        </center>
                        </td>
                        </tr>
                          <?php } ?>

                    </tbody>
                  </table>
              </div>
            </div>


        </div>
</div>



<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi Kantor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Kantor</label>
            <select class="form-control" id="jenis_kantor">
              <option value="">-Pilih-</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Kabupaten">Kabupaten</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kantor</label>
            <input type="text" class="form-control" id="nama_kantor" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat_kantor" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Telp</label>
            <input type="text" class="form-control" id="telp" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>
            <select class="form-control" id="status">
              <option value="">-Pilih-</option>
              <option value="Y">Aktif</option>
              <option value="N">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi</label>
            <div id="map"></div>
            <input type="hidden" name="" id="input_lat">
            <input type="hidden" name="" id="input_lng">
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="TambahLokasiKantor()">Simpan</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ubah Lokasi kantor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
        <input type="hidden" id="id_kantor" name="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Kantor</label>
            <select class="form-control" id="jenis_kantor_update">
              <option value="">-Pilih-</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Kabupaten">Kabupaten</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kantor</label>
            <input type="text" class="form-control" id="nama_kantor_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat_kantor_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Telp</label>
            <input type="text" class="form-control" id="telp_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>
            <select class="form-control" id="status_update">
              <option value="">-Pilih-</option>
              <option value="Y">Aktif</option>
              <option value="N">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi</label>
              <div id="somecomponent" style="height: 400px;"></div>

            <input type="hidden" name="" id="input_lat_update">
            <input type="hidden" name="" id="input_lng_update">
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="UbahLokasiKantor()">Simpan</button>
    </div>
  </div>
</div>
</div>


<!--/ Global settings -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=config_item('MAP_API_KEY')?>&language=id"></script>
<script type="text/javascript">
  var lat_db='<?=$dataCompany->latitude?>';
  var lng_db='<?=$dataCompany->longitude?>';
</script>
<script type="text/javascript">
  window.onload = function() {
    var latlng = new google.maps.LatLng(lat_db, lng_db);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 9,
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



  function UbahLokasiKantor(){
    if ($("#jenis_kantor_update").val()=='') {
      swal("Informasi","Tentukan Jenis Kantor" ,"error");
    } else if ($("#nama_kantor_update").val()=='') {
      swal("Informasi","Masukkan Nama Kantor" ,"error");
    } else if ($("#alamat_kantor_update").val()=='') {
      swal("Informasi","Masukkan Alamat Kantor" ,"error");
    } else if ($("#telp_update").val()=='') {
      swal("Informasi","Masukkan No telp Kantor" ,"error");
    } else if ($("#status_update").val()=='') {
      swal("Informasi","Tentukan Status" ,"error");
    } else if ($("#input_lat_update").val()=='' && $("#input_lng_update").val()=='') {
      swal("Informasi","Tentukan Lokasi Kantor" ,"error");
    } else {
    $("#pageloader").fadeIn();
       setTimeout(function() {
          var datasend = new FormData();
              datasend.append('nama_kantor',$('#nama_kantor_update').val());
              datasend.append('alamat_kantor',$('#alamat_kantor_update').val());
              datasend.append('telp',$('#telp_update').val());
              datasend.append('status',$('#status_update').val());
              datasend.append('input_lat',$('#input_lat_update').val());
              datasend.append('input_lng',$('#input_lng_update').val());
              datasend.append('jenis_kantor',$('#jenis_kantor_update').val());
              datasend.append('id_kantor',$('#id_kantor').val());
              $.ajax({
                  url: '<?=base_url()?>Utility/UbahLokasiKantor',
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
  }

  function TambahLokasiKantor(){
    if ($("#jenis_kantor").val()=='') {
      swal("Informasi","Tentukan Jenis Kantor" ,"error");
    } else if ($("#nama_kantor").val()=='') {
      swal("Informasi","Masukkan Nama Kantor" ,"error");
    } else if ($("#alamat_kantor").val()=='') {
      swal("Informasi","Masukkan Alamat Kantor" ,"error");
    } else if ($("#telp").val()=='') {
      swal("Informasi","Masukkan No telp Kantor" ,"error");
    } else if ($("#status").val()=='') {
      swal("Informasi","Tentukan Status" ,"error");
    } else if ($("#input_lat").val()=='' && $("#input_lng").val()=='') {
      swal("Informasi","Tentukan Lokasi Kantor" ,"error");
    } else {
    $("#pageloader").fadeIn();
       setTimeout(function() {
          var datasend = new FormData();
              datasend.append('nama_kantor',$('#nama_kantor').val());
              datasend.append('alamat_kantor',$('#alamat_kantor').val());
              datasend.append('telp',$('#telp').val());
              datasend.append('status',$('#status').val());
              datasend.append('input_lat',$('#input_lat').val());
              datasend.append('input_lng',$('#input_lng').val());
              datasend.append('jenis_kantor',$('#jenis_kantor').val());
              $.ajax({
                  url: '<?=base_url()?>Utility/TambahLokasiKantor',
                  method: 'POST',
                  contentType: false,
                  processData: false,
                  data: datasend,
                  success: function(data) {
                    console.log(data);
                     $("#pageloader").fadeOut();
                    if (data=='sukses') {
                      swal("Informasi","Data Perusahaan Berhasil Di Tambahkan" ,"success")
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
  }

    function alertdel(id){
     swal({
          title: "Anda Yakin",
          text: "Ingin Menghapus Data Yang Dipilih?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
               AksiHapus(id)
          } else {
            return true;
          }
        });
    }

    function AksiHapus(id) {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('where','id');
        hps.append('tb','tb_lokasi_kantor');
        $.ajax({
            url   :'<?=base_url()?>Utility/DeleteGlobal',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                location.reload();
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }

            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
    }
 function getDataForUpdate(id) {
    var hps = new FormData();
    hps.append('menu','lokasi_kantor');
    hps.append('table','tb_lokasi_kantor');
    hps.append('where','id');
    hps.append('parameter',id);
    $.ajax({
        url   :'<?=base_url()?>Utility/GetDataUpdate2',
        method:'POST',
        contentType: false,
        processData:false,
        data  :hps,
        dataType:'json',
        cache:true,
        success: function(data) {
          console.log(data);
          $("#jenis_kantor_update").val(data[0]['jenis_kantor']);
          $("#nama_kantor_update").val(data[0]['nama_kantor']);
          $("#alamat_kantor_update").val(data[0]['alamat']);
          $("#telp_update").val(data[0]['telp']);
          $("#status_update").val(data[0]['status']);
          $("#input_lat_update").val(data[0]['latitude']);
          $("#input_lng_update").val(data[0]['longitude']);
          $("#id_kantor").val(id);
        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }


</script>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="<?=base_url()?>assets/js/jquery-locationpicker/src/locationpicker.jquery.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=config_item('MAP_API_KEY')?>&language=id"></script>
<script type="text/javascript">
    $(document).ready(function () {

      // $('.search-select').selectize({
      //     sortField: 'text'
      // });
      // var table = $('#myTable').DataTable();
      $.noConflict();
    //$('#somecomponent').locationpicker();

      var lat=$("#input_lat_update").val();
      var lng=$("#input_lng_update").val();
      $('#somecomponent').locationpicker({
        location: {
          latitude: -1.0546279422758742,
          longitude: 115.13671875000016
        },
        radius: 0,
        inputBinding: {
          latitudeInput: $('#input_lat_update'),
          longitudeInput: $('#input_lng_update'),
          radiusInput: $('#us3-radius'),
          locationNameInput: $('#us3-address')
        },
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
          // Uncomment line below to show alert on each Location Changed event
          //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
      });

  });

</script>

<script type="text/javascript">
  $(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
  });
</script>
