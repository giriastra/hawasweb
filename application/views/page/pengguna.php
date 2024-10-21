<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/img_upload.css">
<style type="text/css">
body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #9f78ff, #32cafe);
}

.content-wrapper-before {

    height: 120px !important;

}
.table td{
  padding:10px;
}
#map {
  height: 400px;
  border: 1px solid #000;
}
</style>
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6WnyJo4EEX1WbUEwupS7Vqqfqy4u2GfQ&language=id"></script>
 --><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0YIK8MlBcc8GGQANjBKMBzI8LhLWgYBw&language=id"></script>

<script type="text/javascript">
  window.onload = function() {
    var latlng = new google.maps.LatLng(-8.7289, 115.1772);
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
        console.log(a);
        var latitude=a.latLng.lat().toFixed(4);
        var langitude=a.latLng.lng().toFixed(4);
        document.getElementById('input_lat').value=latitude;
        document.getElementById('input_lng').value=langitude;

        // var div = document.getElementById('lokasi');
        // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        // document.getElementById('penampung')[0].appendChild(div);
    });
};

function MapsUpdate(latitude,longitude) {
    // openModal();
    //console.log(latitude+"/"+longitude);
    var latlng = new google.maps.LatLng(latitude,longitude);
    var map = new google.maps.Map(document.getElementById('mapUpdate'), {
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
        document.getElementById('input_lat').value=latitude;
        document.getElementById('input_lng').value=langitude;

        // var div = document.getElementById('lokasi');
        // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        // document.getElementById('penampung')[0].appendChild(div);
    });
};

// function openModal(){
//   $('#modal_update').modal('show');
// }
</script>
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama</label>
              <input type="text" class="form-control" id="name" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Username</label>
              <input type="text" class="form-control" id="username" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Password</label>
              <input type="password" class="form-control" id="password" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Phone</label>
              <input type="text" class="form-control" id="phone" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Upload foto</label>
                <div class="file-upload">
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Foto Pengguna</button>

                  <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' id="foto_user" onchange="readURL(this);" accept="image/*" />
                    <div class="drag-text">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap">
                      <button type="button" onclick="removeUpload()" class="remove-image">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Type user</label>

              <?php
                if ($this->session->userdata('level_akses')=='5') {
              ?>
               <select class="form-control" onchange="isOperator()" id="type_user" style="width:">
                  <?php foreach ($this->db->query('select * from tb_type_user where status="Y" and id_type_user=2')->result_array() as $val) { ?>
                  ?>
                    <option value="<?=$val['id_type_user']?>"><?=$val['type_user']?></option>
                  <?php
                  }
                  ?>
              </select>
              <?php
              } else {
              ?>
              <select class="form-control" onchange="isOperator()" id="type_user" style="width:">
                  <option value="">Pilih Tipe User..</option>
                  <?php foreach ($this->db->query('select * from tb_type_user where status="Y"')->result_array() as $val) { ?>
                    <option value="<?=$val['id_type_user']?>"><?=$val['type_user']?></option>
                  <?php } ?>
              </select>
              <?php
              }
              ?>

            </div>
              <?php
                if ($this->session->userdata('level_akses')=='5') {
              ?>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Provinsi</label>
              <select id="provinsi" onchange="ProvinsiOnchange('insert')" class="form-control" placeholder="Pick a state..." style="pointer-events: none; background: #cccccc69;">
                 <?php foreach ($this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$this->session->userdata('id_provinsi'))->result_array() as $rProv) {
                 ?>
                   <option value="<?=$this->session->userdata('id_provinsi')?>"><?=$rProv['name']?></option>
                 <?php
                 }
                 ?>
             </select>
              </div>
              <?php
              } else {
              ?>
              <div class="form-group form_lokasi_op_prov">
                <label for="recipient-name" class="col-form-label">Provinsi</label>

                  <select class="form-control" onchange="ProvinsiOnchange('insert')" id="provinsi" style="width:">
                  	<option value="">Pilih Provinsi..</option>
                    <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                    ?>
                      <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              <?php
              }
              ?>

              <?php
                if ($this->session->userdata('level_akses')=='5') {
              ?>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kabupaten</label>
                    <select id="kabupaten"  class="form-control" placeholder="Pick a state..." style="pointer-events: none; background: #cccccc69;">
                       <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$this->session->userdata('id_kabupaten'))->result_array() as $rProv) {
                       ?>
                         <option value="<?=$this->session->userdata('id_kabupaten')?>"><?=$rProv['name']?></option>
                       <?php
                       }
                       ?>
                   </select>
              </div>
              <?php
              } else {
              ?>
              <div class="form-group form_lokasi_op_kab form_kab_op">
                <label for="recipient-name" class="col-form-label">Kabupaten</label>
                <select id="kabupaten" class="form-control" placeholder="Pick a state...">
              </select>
                </div>
              <?php
              }
              ?>



            <input type="hidden" id="input_lat" name="" readonly="">
            <input type="hidden" id="input_lng" name="" readonly="">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Insert()">Simpan</button>
      </div>
    </div>
  </div>
</div>
 <!-- modal -->


        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name?></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
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
	          <b>Filter Pengguna</b>
	      </div>
	        <div class="card-body">
	          <div class="row match-height">
	          <div class="form-group col-xl-3 col-lg-12">
	          	<label for="recipient-name" class="col-form-label">Tipe User</label>
	          	<select class="form-control" onchange="filtertyprOnchange()" id="filter_type_user">
	          		<label for="recipient-name" class="col-form-label">Tipe</label>
	          		<option value="semua">Semua</option>
	          		<?php
	          			foreach ($this->model_global->getDataGlobal('tb_type_user')->result() as $filter1) {
	          		?>
	          			<option value="<?=$filter1->id_type_user?>"><?=$filter1->type_user?></option>
	          		<?php
	          			}
	          		?>
	          	</select>
	          </div>
	          <div class="form-group col-xl-3 col-lg-12">
	          	<label for="recipient-name" class="col-form-label">Provinsi</label>
	          	<select id="prov_filter" onchange="FilterProvinsiOnchangeFilter()" class="form-control" placeholder="Pick a state...">
	                <option value="semua">Semua</option>
	                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
	                ?>
	                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
	                <?php
	                }
	                ?>
	            </select>
	          </div>
	          <div class="form-group col-xl-3 col-lg-12 mother_kab_filter_global">
	          	<label for="recipient-name" class="col-form-label">Kabupaten</label>
	          	<select id="kab_filter" class="form-control" placeholder="Pick a state...">
	              <option value="semua">SEMUA</option>
	            </select>
	          </div>
	      </div>
	     </div>
	     <div class="card-footer">
	     	<button class="btn btn-primary" onclick="filteredPengguna()">Cari</button>
	     </div>
	    </div>
	</div>


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">+Tambah</button>
                <h4 class="card-title"></h4>
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

            <div class="card-body" id="filtered_pengguna">

              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 60px">Foto</th>
                        <th scope="col"style="width: 100px">Nama</th>
                        <th scope="col"style="width: 100px">Username</th>
                        <th scope="col"style="width: 100px">Phone</th>
                        <th scope="col"style="width: 50px">Status</th>
                        <th scope="col"style="width: 80px">Tipe</th>
                        <th scope="col" style="width: 100px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getMember() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td>
                          <a href="<?=base_url()?>assets/upload/user/<?=$row->foto?>" target="_blank">
                            <img src="<?=base_url()?>assets/upload/user/<?=$row->foto?>" width="50px">
                          </a>
                        </td>
                        <td><?=$row->name?></td>
                        <td><?=$row->username?></td>
                        <td><?=$row->phone?></td>

                        <td>
                          <?php
                              if ($row->status_online=='Y') {
                                  echo '  <span class="success">Online</span>';
                              } else {
                                  echo '<span class="danger">Offline</span>';
                              }
                          ?>
                        </td>
                        <td><?=$row->type_user?></td>
                        <td style="width: 500px;">
                          <center>
                          <button class="btn btn-primary" data-toggle="modal"  onclick="getDataForUpdate('<?=$row->id_user?>')"  data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" style="display: <?=($row->username=='admin') ? 'none' : 'block' ;?>"   onclick="alertdel('<?=$row->id_user?>')"><i class="la la-trash"></i></button>
                          </center>

                        <!-- modal update -->
                          <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Update Pengguna</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                  <div class="modal-body">
                                    <?php foreach ($this->model_global->getPengguna($row->id_user)->result_array() as $rowUsr) {?>
                                      <input type="hidden" value="<?=$rowUsr['id_user']?>" id="" name="">


                                      </div>
                                      <?php } ?>
                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" onclick="EditPengguna()">Simpan</button>
                                </div>
                              </div>
                            </div>

                          <?php } ?>
                         <!-- modal -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
           </div>


        </div>
</div>

<!-- modal update -->
  <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama</label>
                <input type="text" class="form-control" value="" id="nama_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Username</label>
                <input type="text" class="form-control" value="" id="username_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password</label>
                <input type="password" class="form-control" value="" id="password_update" style="">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Phone</label>
                <input type="text" class="form-control" value="" id="phone_update" style="">
              </div>
              <div class="form-group">
              <label for="recipient-name" class="col-form-label">Upload foto</label>
                <div class="file-upload2">
                  <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Foto Pengguna</button>

                  <div class="image-upload-wrap2">
                    <input class="file-upload-input2" type='file' id="foto_user_update" onchange="readURL2(this);" accept="image/*" />
                    <div class="drag-text2">
                      <h3>Drag and drop a file or select add Image</h3>
                    </div>
                  </div>
                  <div class="file-upload-content2">
                    <img class="file-upload-image2" src="#" alt="your image" />
                    <div class="image-title-wrap2">
                      <button type="button" onclick="removeUpload2()" class="remove-image2">Hapus</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Type user</label>
                <?php
                  if ($this->session->userdata('level_akses')=='5') {
                ?>
                 <select class="form-control" onchange="isOperator2()" id="type_user_update" style="width:">
                    <?php foreach ($this->db->query('select * from tb_type_user where status="Y" and id_type_user=2')->result_array() as $val) { ?>
                    ?>
                      <option value="<?=$val['id_type_user']?>"><?=$val['type_user']?></option>
                    <?php
                    }
                    ?>
                </select>
                <?php
                } else {
                ?>
                <select class="form-control" id="type_user_update" onchange="isOperator2()" style="width:">
                <option>-Pilih-</option>
                  <?php foreach ($this->db->query('select * from tb_type_user where status="Y"')->result_array() as $val2) { ?>
                    <option value="<?=$val2['id_type_user']?>"><?=$val2['type_user']?></option>
                  <?php } ?>
                </select>
                <?php
                }
                ?>


              </div>
              <div class="form-group form_lokasi_op_prov_update">
              <label for="recipient-name" class="col-form-label">Provinsi</label>
              <select id="provinsi_update" onchange="ProvinsiOnchange('update')" class="form-control" placeholder="Pick a state..." <?= ($this->session->userdata('level_akses')=='5') ? 'style="pointer-events: none; background: #cccccc69;"' : '' ;?>>
              	<option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $provUp) {
                ?>
                  <option value="<?=$provUp['id_provinsi']?>"><?=$provUp['name']?></option>
                <?php
                }
                ?>
              </select>
            </div>

            <div class="form-group form_lokasi_op_kab_update form_kab_op_update">
              <label for="recipient-name" class="col-form-label">Kabupaten</label>
              <select id="kabupaten_update" class="form-control" placeholder="Pick a state..." <?= ($this->session->userdata('level_akses')=='5') ? 'style="pointer-events: none; background: #cccccc69;"' : '' ;?> >
              	<?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $rKab) {
                ?>
                  <option value="<?=$rKab['id_kabupaten']?>"><?=$rKab['name']?></option>
                <?php
                }
                ?>
            </select>
            </div>
              <input type="hidden" id="id_pengguna" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditPengguna()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- end modal update -->



<!--/ Global settings -->

 <script>$(document).ready(function () {
    $.noConflict();
    $(".form_lokasi_op_prov").hide();
    $(".form_lokasi_op_kab").hide();
    $(".form_kab_op").hide();

    $(".form_lokasi_op_prov_update").hide();
    $(".form_lokasi_op_kab_update").hide();
    $(".form_kab_op_update").hide();

    var table = $('#myTable').DataTable(
      {
      "aLengthMenu": [[20, 30, 40,50,60, -1], [20, 30, 40,50,60, "All"]],
        "pageLength": 20
      }
    );
     $("#kab_filter").hide();
     $(".mother_kab_filter_global").hide();
     $('#prov_filter').prop('disabled', true);
	});
	</script>


<script type="text/javascript">
  function Insert(){
    var foto_user=$('#foto_user')[0].files[0];
    if ($('#name').val()=='') {
      swal("Informasi","Masukkan Nama User" ,"error");
    } else if ($('#username').val()=='') {
      swal("Informasi","Masukkan Username User" ,"error");
    } else if ($('#password').val()=='') {
      swal("Informasi","Masukkan Password User" ,"error");
    } else if ($('#phone').val()=='') {
      swal("Informasi","Masukkan No Telepon User" ,"error");
    }else if ($('#type_user').val()=='') {
      swal("Informasi","Tentukan Salah Satu Tipe User" ,"error");
    } else {
    $("#pageloader").fadeIn();
       setTimeout(function() {
        var datasend = new FormData();
            datasend.append('name',$('#name').val());
            datasend.append('username',$('#username').val());
            datasend.append('password',$('#password').val());
            datasend.append('phone',$('#phone').val());
            datasend.append('type_user',$('#type_user').val());
            datasend.append('input_lat',$('#input_lat').val());
            datasend.append('input_lng',$('#input_lng').val());
             datasend.append('provinsi',$('#provinsi').val());
            datasend.append('kabupaten',$('#kabupaten').val());
            datasend.append('foto_user',foto_user);

            $.ajax({
                url: '<?=base_url()?>Utility/InsertPengguna',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                   $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Pengguna Berhasil Ditambahkan" ,"success")
                    .then((value) => {
                      window.location.reload();
                    });
                  } else if (data=='usernameExist') {
                    swal("Informasi","Username Sudah Terdaftar" ,"error");
                  }else if (data=='min5') {
                    swal("Informasi","Username Harus Mengandung Minimal 5 Karakter" ,"error");
                  }else if (data=='spaceDetect') {
                    swal("Informasi","Username Tidak Boleh Mangandung Karakter Spesial" ,"error");
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

  function AksiEditPengguna(){
    var foto_user=$('#foto_user_update')[0].files[0];
    if ($('#nama_update').val()=='') {
      swal("Informasi","Masukkan Nama User" ,"error");
    } else if ($('#username_update').val()=='') {
      swal("Informasi","Masukkan Username User" ,"error");
    } 
    
    // else if ($('#password_update').val()=='') {
    //   swal("Informasi","Masukkan Password User" ,"error");
    // } 
    
    else if ($('#phone_update').val()=='') {
      swal("Informasi","Masukkan No Telepon User" ,"error");
    }else if ($('#type_user_update').val()=='') {
      swal("Informasi","Tentukan Salah Satu Tipe User" ,"error");
    } else {
    $("#pageloader").fadeIn();
     setTimeout(function() {
        var datasend = new FormData();
            datasend.append('id_user_update',$('#id_pengguna').val());
            datasend.append('name_update',$('#nama_update').val());
            datasend.append('username_update',$('#username_update').val());
            datasend.append('password_update',$('#password_update').val());
            datasend.append('phone_update',$('#phone_update').val());
            datasend.append('type_user_update',$('#type_user_update').val());
             datasend.append('provinsi',$('#provinsi_update').val());
            datasend.append('kabupaten',$('#kabupaten_update').val());
            datasend.append('foto_user',foto_user);
            $.ajax({
                url: '<?=base_url()?>Utility/UpdatePengguna',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                   $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Pengguna Berhasil Di Ubah" ,"success")
                    .then((value) => {
                      window.location.reload();
                    });
                  } else {
                    $("#pageloader").fadeOut();
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
          text: "Ingin Menghapus Data Pengguna Yang Dipilih?",
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
        hps.append('id_user',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusPengguna',
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
   $("#pageloader").fadeIn();
    setTimeout(function() {
      var hps = new FormData();
      hps.append('menu','pengguna');
      hps.append('table','tb_user');
      hps.append('where','id_user');
      hps.append('parameter',id);
      $.ajax({
          url   :'<?=base_url()?>Utility/GetDataUpdate',
          method:'POST',
          contentType: false,
          processData:false,
          data  :hps,
          dataType:'json',
          cache:true,
          success: function(data) {
            $("#pageloader").hide();
            console.log(data);
            $("#nama_update").val(data.nama);
            $("#username_update").val(data.username);
            // $("#password_update").val(data.pwd);
            $("#phone_update").val(data.phone);
            $("#type_user_update").val(data.id_type_user);
            $("#id_pengguna").val(id);

            $('.file-upload-image2').attr('src', "<?=base_url()?>assets/upload/user/"+data.foto);
            $('.image-upload-wrap2').hide();
            $('.file-upload-content2').show();
            if (data.id_type_user==5 || data.id_type_user==2) {
            	$(".form_lokasi_op_prov_update").show('slow');
            	 $(".form_lokasi_op_kab_update").show('slow');
            	 $("#provinsi_update").val(data.id_provinsi);

            	 //ProvinsiOnchange('update');
            	 $("#kabupaten_update").val(data.id_kabupaten);
            } else {
            	$(".form_lokasi_op_prov_update").hide();
            	 $(".form_lokasi_op_kab_update").hide();
            }
          },error: function(data){
            $("#pageloader").hide();
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }, 300);
  }

    function ProvinsiOnchange(type){
    if (type=='insert') {
       Typedaerah = $("#provinsi").val();
    } else {
      Typedaerah = $("#provinsi_update").val();
    }

    if (Typedaerah=='') {
      if (type=='insert') {
        $("#formKabupaten").hide('slow');
        $("#formKecamatan").hide('slow');
        $("#formKelurahan").hide('slow');
        $(".form_lokasi_op_kab").hide('slow');
      } else {
        $("#formKabupaten_update").hide('slow');
        $("#formKecamatan_update").hide('slow');
        $("#formKelurahan_update").hide('slow');
        $(".form_lokasi_op_kab_update").hide('slow');
      }
    } else {
      var hps = new FormData();
      hps.append('menu','kabupaten');
      hps.append('table','tb_kabupaten');
      hps.append('where','id_provinsi');
      hps.append('parameter',Typedaerah);
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

            var i;
            if (type=='insert') {
            $(".form_lokasi_op_kab").show('slow');
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">Pilih Kabupaten..</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kabupaten').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }
            } else {
            $(".form_lokasi_op_kab_update").show('slow');
            $('#kabupaten_update').empty();
            $('#kabupaten_update').append('<option value="">Pilih Kabupaten..</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kabupaten_update').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }
            }
          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

    function FilterProvinsiOnchangeFilter(){
    var Typedaerah=$("#prov_filter").val();
    if (Typedaerah=='semua') {
         $("#kab_filter").hide('slow');
         $(".mother_kab_filter_global").hide('slow');
        // $("#filter_kec").hide('slow');
        // $("#filter_kel").hide('slow');
    } else {
      var hps = new FormData();
      hps.append('menu','kabupaten');
      hps.append('table','tb_kabupaten');
      hps.append('where','id_provinsi');
      hps.append('parameter',Typedaerah);
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

            var i;
            $("#kab_filter").show('slow');
            $(".mother_kab_filter_global").show('slow');
            $('#kab_filter').empty();
            $('#kab_filter').append('<option value="semua">SEMUA</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kab_filter').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }

          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function filtertyprOnchange(){
  	if ($("#filter_type_user").val()=='5' || $("#filter_type_user").val()=='2') {
  		$('#prov_filter').prop('disabled', false);
  	} else {
  		$('#prov_filter').val('semua');
  		$('.mother_kab_filter_global').hide('slow');
  		$('#prov_filter').prop('disabled', true);
  	}
  }

  function filteredPengguna(){
  	if ($("#filter_type_user").val()=='semua'){
  		$("#pageloader").show();
  		location.reload();
  	} else {
  		setTimeout(function() {
  			$("#pageloader").show();
  			var hps = new FormData();
		      hps.append('type_user',$("#filter_type_user").val());
		      hps.append('id_provinsi',$("#prov_filter").val());
		      hps.append('id_kabupaten',$("#kab_filter").val());
		      $.ajax({
		          url   :'<?=base_url()?>Utility/FilteredPengguna',
		          method:'POST',
		          contentType: false,
		          processData:false,
		          data  :hps,
		          success: function(data) {
		          	$("#pageloader").hide();
		            console.log(data);
		            $("#filtered_pengguna").html(data);
		          },error: function(data){
		             console.log(data);
		             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
		          }
		      });
  		}, 500);
  	}

  }


  function isOperator(){
  	if ($("#type_user").val()=='5' || $("#type_user").val()=='2') {
  		$(".form_lokasi_op_prov").show('slow');
  	} else {
  		$(".form_lokasi_op_prov").hide('slow');
  	}
  }

  function isOperator2(){
  	if ($("#type_user_update").val()=='5' || $("#type_user_update").val()=='2') {
  		$(".form_lokasi_op_prov_update").show('slow');
  	} else {
  		$(".form_lokasi_op_prov_update").hide('slow');
  	}
  }

</script>
  <script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

  </script>

<script type="text/javascript">
    function readURL2(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap2').hide();

      $('.file-upload-image2').attr('src', e.target.result);
      $('.file-upload-content2').show();

      $('.image-title2').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload2();
  }
}

function removeUpload2() {
  $('.file-upload-input2').replaceWith($('.file-upload-input2').clone());
  $('.file-upload-content2').hide();
  $('.image-upload-wrap2').show();
}
$('.image-upload-wrap2').bind('dragover', function () {
    $('.image-upload-wrap2').addClass('image-dropping2');
  });
  $('.image-upload-wrap2').bind('dragleave', function () {
    $('.image-upload-wrap2').removeClass('image-dropping2');
});

  </script>
