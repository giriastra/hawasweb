<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #9f78ff, #32cafe);    
}

.content-wrapper-before {

    height: 120px !important;

}

</style>

 
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name?> </h3>
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
                        <th scope="col" style="width: 90px">No</th>
                        <th scope="col"style="width: 100px">No TPS</th>                        
                        <th scope="col"style="width: 300px">Ketua</th>                        
                        <th scope="col"style="width: 150px">Provinsi</th>                        
                        <th scope="col"style="width: 200px">Kabupaten</th>                      
                        <th scope="col"style="width: 200px">Kecamatan</th>                      
                        <th scope="col"style="width: 200px">Kelurahan</th>                      
                        <th scope="col"style="width: 200px">Latitude</th>                      
                        <th scope="col"style="width: 200px">Longitude</th>                      
                        <th scope="col"style="width: 200px">Create Date</th>                      
                        <th scope="col"style="width: 200px">Change Date</th>                      
                        <th scope="col" style="width: 250px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php                       
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_tps')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['no_tps']?></td>                       
                        <td><?=$row['ketua_tps']?></td>                       
                        <td><?=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$row['id_provinsi'])->row()->name?></td>
                        <td><?=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$row['id_kabupaten'])->row()->name?></td>
                        <td><?=$this->model_global->getDataGlobal('tb_kecamatan','id_kecamatan',$row['id_kecamatan'])->row()->name?></td>
                        <td><?=$this->model_global->getDataGlobal('tb_kelurahan','id_kelurahan',$row['id_kelurahan'])->row()->name?></td>
                        <td><?=$row['latitude']?></td>
                        <td><?=$row['longitude']?></td>
                        <td><?=$row['create_date']?></td>                       
                        <td><?=$row['change_date']?></td>                       
                        <td>
                          <center>
                          <a href="<?=base_url()?>kelurahan/<?=$row['id_tps']?>"><button class="btn btn-success" data-toggle="modal">Petugas</button></a>
                          <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id_tps']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_tps']?>')"><i class="la la-trash"></i></button>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah TPS</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No TPS</label>
            <input type="text" class="form-control" id="no_tps" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Ketua TPS</label>
            <input type="text" class="form-control" id="ketua_tps" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="select-state" class="search-select" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                <?php
                } 
                ?>                          
            </select>
          </div>    
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="select-state" class="search-select" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                <?php
                } 
                ?>                          
            </select>
          </div>    
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="select-state" class="search-select" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $rKab) {
                ?>
                  <option value="<?=$rKab['id_kabupaten']?>"><?=$rKab['name']?></option>
                <?php
                } 
                ?>                          
            </select>
          </div>    
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="select-state" class="search-select" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_kecamatan')->result_array() as $rKec) {
                ?>
                  <option value="<?=$rKec['id_kecamatan']?>"><?=$rKec['name']?></option>
                <?php
                } 
                ?>                          
            </select>
          </div> 
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="select-state" class="search-select" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_kelurahan')->result_array() as $rKel) {
                ?>
                  <option value="<?=$rKel['id_kelurahan']?>"><?=$rKel['name']?></option>
                <?php
                } 
                ?>                          
            </select>
          </div>    
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi</label>
            <div id="find_location"></div>
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="tambahHimbauan()">Simpan</button>
    </div>
  </div>
</div>
</div>

<!-- modal update -->
  <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Himbauan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Judul</label>
            <input type="text" class="form-control" id="judul_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deskripsi</label>
            <input type="text" class="form-control" id="desc_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link Gambar</label>
            <input type="text" class="form-control" id="link_gambar_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link Website</label>
            <input type="text" class="form-control" id="link_website_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>
            <select class="form-control" id="status_update">
            	<option value="">-Pilih-</option>
            	<option value="Y">Aktif</option>
            	<option value="N">Tidak Aktif</option>
            </select>
          </div>    
          <input type="hidden" id="id_himbauan" value="" name="">      
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEdit()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- end modal update -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0YIK8MlBcc8GGQANjBKMBzI8LhLWgYBw&language=id"></script>

<script type="text/javascript">
  window.onload = function() {
    var latlng = new google.maps.LatLng(-8.7289, 115.1772);
    var map = new google.maps.Map(document.getElementById('find_location'), {
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
        console.log(a);
        var latitude=a.latLng.lat().toFixed(4);
        var langitude=a.latLng.lng().toFixed(4);
        // document.getElementById('input_lat').value=latitude;
        // document.getElementById('input_lng').value=langitude;
    });
};  

</script>

<script type="text/javascript">
    $(document).ready(function () {
      $.noConflict();
      $('.search-select').selectize({
          sortField: 'text'
      });
      var table = $('#myTable').DataTable();
  });
</script>
<!--  <script>$(document).ready(function () {
    $.noConflict();
      
    });
</script> -->

<script type="text/javascript">

  function tambahHimbauan() {
    var hps = new FormData();
    if ($("#judul").val()=='') {
    	swal("Informasi","Masukkan Judul Himbauan" ,"error");
    } else if ($("#desc").val()=='') {
    	swal("Informasi","Masukkan Deskripsi Himbauan" ,"error");
    } else if ($("#link_gambar").val()=='') {
    	swal("Informasi","Masukkan Link Gambar Himbauan" ,"error");
    } else if ($("#link_website").val()=='') {
    	swal("Informasi","Masukkan Link Website Himbauan" ,"error");
    }else if ($("#status").val()=='') {
    	swal("Informasi","Tentukan Status Himbauan" ,"error");
    } else {
        hps.append('judul',$("#judul").val());
        hps.append('desc',$("#desc").val());
        hps.append('link_gambar',$("#link_gambar").val());
        hps.append('link_website',$("#link_website").val());
        hps.append('status',$("#status").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/TambahHimbauan',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Data Berhasil Di Tambah" ,"success")
                .then((value) => {
                  window.location.reload();
                });
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
                
            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
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
        hps.append('tb','tb_announcement');
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
    hps.append('menu','announcement');
    hps.append('table','tb_announcement');
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
          $("#judul_update").val(data[0]['title']);
          $("#desc_update").val(data[0]['desc']);
          $("#link_gambar_update").val(data[0]['url_img']);
          $("#link_website_update").val(data[0]['url_website']);
          $("#status_update").val(data[0]['status']);
          $("#id_himbauan").val(id);

        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

    function AksiEdit() {
    	if ($("#judul_update").val()=='') {
    	swal("Informasi","Masukkan Judul Himbauan" ,"error");
    } else if ($("#desc_update").val()=='') {
    	swal("Informasi","Masukkan Deskripsi Himbauan" ,"error");
    } else if ($("#link_gambar_update").val()=='') {
    	swal("Informasi","Masukkan Link Gambar Himbauan" ,"error");
    } else if ($("#link_website_update").val()=='') {
    	swal("Informasi","Masukkan Link Website Himbauan" ,"error");
    }else if ($("#status_update").val()=='') {
    	swal("Informasi","Tentukan Status Himbauan" ,"error");
    } else {
    	var hps = new FormData();
         hps.append('judul',$("#judul_update").val());
        hps.append('desc',$("#desc_update").val());
        hps.append('link_gambar',$("#link_gambar_update").val());
        hps.append('link_website',$("#link_website_update").val());
        hps.append('status',$("#status_update").val());
        hps.append('id',$("#id_himbauan").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/EditHimbauan',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Data Berhasil Di Ubah" ,"success")
                .then((value) => {
                  window.location.reload();
                });
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
                
            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });

     }
  } 



</script>
