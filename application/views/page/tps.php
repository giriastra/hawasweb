
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
   box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

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
          <li class="breadcrumb-item active"><?=$page_name?> <?=$this->session->userdata('id_provinsi')?>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-12 col-lg-12" style="float:left">
    <div class="card">
      <div class="card-header">
          <b>Filter TPS</b>
      </div>
        <div class="card-body">
          <div class="row match-height">
          <div class="form-group col-xl-3 col-lg-12">
            <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Provinsi</label>
            <?php
            	if ($this->session->userdata('level_akses')=='5') {
            ?>
             <select id="prov_filter" onchange="FilterProvinsiOnchange()" style="pointer-events: none; background: #cccccc69;" class="form-control" placeholder="Pick a state...">
                <!-- <option value="">Pilih Provinsi..</option> -->
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$this->session->userdata('id_provinsi')?>"><?=@$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$this->session->userdata('id_provinsi'))->row()->name?></option>
                <?php
                }
                ?>
            </select>
            <?php
        	} else {
            ?>
            <select id="prov_filter" onchange="FilterProvinsiOnchange()" class="form-control" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                <?php
                }
                ?>
            </select>
            <?php
        	}
            ?>
          </div>
          <div class="form-group col-xl-3 col-lg-12" id="filter_kab">
            <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Kabupaten</label>
            <?php
            	if ($this->session->userdata('level_akses')=='5') {
            ?>
             <select id="kab_filter" onchange="FilterKabupatenOnchange()" style="pointer-events: none; background: #cccccc69;" class="form-control" placeholder="Pick a state...">
                <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $rKab) {
                ?>
                  <option value="<?=$this->session->userdata('id_kabupaten')?>"><?=$this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$this->session->userdata('id_kabupaten'))->row()->name?></option>
                <?php
                }
                ?>
            </select>
            <?php
        	} else {
            ?>
             <select id="kab_filter" class="form-control" onclick="FilterKabupatenOnchange()" placeholder="Pick a state...">
              <option value="semua">SEMUA</option>
            </select>
            <?php
        	}
            ?>
          </div>
          <div class="form-group col-xl-3 col-lg-12" id="filter_kec">
            <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Kecamatan</label>
             <select id="kec_filter" class="form-control" onchange="FilterKecamatanOnchange()" placeholder="Pick a state...">
              <option value="semua">SEMUA</option>
            </select>
          </div>
          <div class="form-group col-xl-3 col-lg-12" id="filter_kel">
            <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Kelurahan</label>
             <select id="kel_filter" class="form-control" placeholder="Pick a state...">
              <option value="semua">SEMUA</option>
            </select>
          </div>
          <div class="form-group col-xl-12 col-lg-12" id="filter_kel">
            <button class="btn btn-primary" onclick="FilterTPS()">Cari <i class="la la-search"></i></button>
          </div>
        </div>
        </div>
      </div>
    </div>
  <div class="col-xl-12 col-lg-12" style="float:left">
      <div class="card">
        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">+ Tambah</button>
           <a href="<?=base_url()?>maps_tps"><button class="btn btn-warning"><i class="la la-map"></i> Maps TPS</button></a>
           <button class="btn btn-primary" data-toggle="modal" data-target="#modal_update_id_pemilihan"> Edit Pemilihan Global</button>
        </div>
            <div class="card-body">
              <div class="table-responsive" id="filtered_tps">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 100px">No TPS</th>
                        <th scope="col"style="width: 200px">Ketua</th>
                        <th scope="col"style="width: 150px">Provinsi</th>
                        <th scope="col"style="width: 150px">Kabupaten</th>
                        <th scope="col"style="width: 150px">Kecamatan</th>
                        <th scope="col"style="width: 150px">Kelurahan</th>
                        <th scope="col"style="width: 200px">Latitude</th>
                        <th scope="col"style="width: 200px">Longitude</th>
                        <th scope="col" style="width: 350px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      $query="";
                      if ($this->session->userdata('level_akses')=='5') {
			          	$query=$this->model_global->getTpsOperator();
			          } else {
			          	$query=$this->model_global->getDataGlobal('tb_tps');
			          }

                      foreach ($query->result_array() as $row) {
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
                        <td>
                          <center>
                          <a href="<?=base_url()?>petugas/<?=$row['id_tps']?>"><button class="btn btn-success" data-toggle="modal">Petugas</button></a>
                           <a href="<?=base_url()?>maps_tps/<?=$row['id_tps']?>"><button class="btn btn-warning"><i class="la la-map-marker"></i></button></a>
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
            <?php
            	if ($this->session->userdata('level_akses')=='5') {
            ?>
             <select id="provinsi" onchange="ProvinsiOnchange('insert')" class="form-control" placeholder="Pick a state..." style="pointer-events: none; background: #cccccc69;">
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$this->session->userdata('id_provinsi'))->result_array() as $rProv) {
                ?>
                  <option value="<?=$this->session->userdata('id_provinsi')?>"><?=$rProv['name']?></option>
                <?php
                }
                ?>
            </select>
            <?php
            } else {
            ?>
            <select id="provinsi" onchange="ProvinsiOnchange('insert')" class="form-control" placeholder="Pick a state...">
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                <?php
                }
                ?>
            </select>
            <?php
            }
            ?>
          </div>
          <div class="form-group" id="formKabupaten">
            <label for="recipient-name" class="col-form-label">Kabupaten</label>
            <?php
            	if ($this->session->userdata('level_akses')=='5') {
            ?>
            <select id="kabupaten" onchange="KabupatenOnchange('insert')" class="form-control" placeholder="Pick a state..." style="pointer-events: none; background: #cccccc69;">
                <?php foreach ($this->model_global->getDataGlobal('tb_kabupaten','id_kabupaten',$this->session->userdata('id_kabupaten'))->result_array() as $rKab) {
                ?>
                  <option value="<?=$this->session->userdata('id_kabupaten')?>"><?=$rKab['name']?></option>
                <?php
                }
                ?>
            </select>
            <?php
        	} else {
        	?>
        	<select id="kabupaten" class="form-control" onclick="KabupatenOnchange('insert')" placeholder="Pick a state...">
            </select>
        	<?php
        	}
            ?>
          </div>
          <div class="form-group" id="formKecamatan">
            <label for="recipient-name" class="col-form-label">Kecamatan</label>
             <select id="kecamatan" class="form-control" onchange="KecamatanOnchange('insert')" placeholder="Pick a state...">
            </select>
          </div>
          <div class="form-group" id="formKelurahan">
            <label for="recipient-name" class="col-form-label">Kelurahan</label>
             <select id="kelurahan" class="form-control" placeholder="Pick a state...">
            </select>
          </div>
          <div class="form-group" >
            <label for="recipient-name" class="col-form-label">Tgl pemilihan</label>
            <select class="form-control" id="tgl_pemilihan">
              <option value="">-Pilih-</option>
              <?php
              // ($rowTgl->is_pilgub=="true" &&  $rowTgl->is_pilbub=="true") ?   "PILGUB - PILBUB" :  ($row->is_pilgub=="true") ?   "PILGUB" :   "PILBUB";
                foreach ($this->model_global->getDataGlobal('tb_pemilihan',"status","Y")->result() as $rowTgl) {
              ?>
                <option value="<?=$rowTgl->id_pemilihan?>">
                  <?php
                    echo $this->model_global->tgl_indo($rowTgl->tgl_pemilihan);
                    echo "&nbsp";
                    echo ($rowTgl->is_pilgub=="true" &&  $rowTgl->is_pilbub=="true") ?   "PILGUB - PILBUB" :  ($rowTgl->is_pilgub=="true") ?   "PILGUB" :   "PILBUB";

                  ?>
                </option>
              <?php
                }
              ?>
            </select>


          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi</label>
             <?php $this->load->view('page/sample_map'); ?>
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="TambahTps()">Simpan</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ubah TPS</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
      	<input type="hidden" id="id_tps" name="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No TPS</label>
            <input type="text" class="form-control" id="no_tps_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Ketua TPS</label>
            <input type="text" class="form-control" id="ketua_tps_update" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Provinsi</label>
             <select id="provinsi_update" onchange="ProvinsiOnchange('update')" class="form-control" placeholder="Pick a state..." <?= ($this->session->userdata('level_akses')=='5') ? 'style="pointer-events: none; background: #cccccc69;"' : '' ;?>>
                <option value="">Pilih Provinsi..</option>
                <?php foreach ($this->model_global->getDataGlobal('tb_provinsi')->result_array() as $rProv) {
                ?>
                  <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group" id="formKabupaten_update">
            <label for="recipient-name" class="col-form-label">Kabupaten</label>
             <select id="kabupaten_update" class="form-control" onchange="KabupatenOnchange('update')" placeholder="Pick a state..." <?= ($this->session->userdata('level_akses')=='5') ? 'style="pointer-events: none; background: #cccccc69;"' : '' ;?>>
             	<?php foreach ($this->model_global->getDataGlobal('tb_kabupaten')->result_array() as $rKab) {
                ?>
                  <option value="<?=$rKab['id_kabupaten']?>"><?=$rKab['name']?></option>
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group" id="formKecamatan_update">
            <label for="recipient-name" class="col-form-label">Kecamatan</label>
             <select id="kecamatan_update" class="form-control" onchange="KecamatanOnchange('update')" placeholder="Pick a state...">    <?php foreach ($this->model_global->getDataGlobal('tb_kecamatan')->result_array() as $rKec) {
                ?>
                  <option value="<?=$rKec['id_kecamatan']?>"><?=$rKec['name']?></option>
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group" id="formKelurahan_update">
            <label for="recipient-name" class="col-form-label">Kelurahan</label>
             <select id="kelurahan_update" class="form-control" placeholder="Pick a state...">
             <?php foreach ($this->model_global->getDataGlobal('tb_kelurahan')->result_array() as $rKec) {
                ?>
                  <option value="<?=$rKec['id_kelurahan']?>"><?=$rKec['name']?></option>
                <?php
                }
                ?>
             </select>
          </div>
          <div class="form-group" >
            <label for="recipient-name" class="col-form-label">Tgl pemilihan</label>
            <select class="form-control" id="tgl_pemilihan_update">
              <option value="">-Pilih-</option>
              <?php
              // ($rowTgl->is_pilgub=="true" &&  $rowTgl->is_pilbub=="true") ?   "PILGUB - PILBUB" :  ($row->is_pilgub=="true") ?   "PILGUB" :   "PILBUB";
                foreach ($this->model_global->getDataGlobal('tb_pemilihan',"status","Y")->result() as $rowTgl2) {
              ?>
                <option value="<?=$rowTgl2->id_pemilihan?>">
                  <?php
                    echo $this->model_global->tgl_indo($rowTgl2->tgl_pemilihan);
                    echo "&nbsp";
                    echo ($rowTgl2->is_pilgub=="true" &&  $rowTgl2->is_pilbub=="true") ?   "PILGUB - PILBUB" :  ($rowTgl2->is_pilgub=="true") ?   "PILGUB" :   "PILBUB";

                  ?>
                </option>
              <?php
                }
              ?>
            </select>


          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi</label>

            <input id="searchInput2" class="input-controls2" type="text" placeholder="Enter a location">
               <div class="map_update" id="map_update" style="width: 100%; height: 300px;"></div>
               <div class="form_area">
                   <span id="location_update" style="color: #333;font-weight: bold;"></span>
                   <input type="hidden" name="lat_update" id="lat_update">
                   <input type="hidden" name="lng_update" id="lng_update">
               </div>
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="EditTps()">Simpan</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal_update_id_pemilihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Pemilihan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
        <div class="row match-height">
        <div class="form-group col-xl-6 col-lg-12">
          <label for="recipient-name" class="col-form-label">Provinsi</label>
              <select id="prov_filter_global" onchange="FilterProvinsiOnchangeFilter()" class="form-control" placeholder="Pick a state...">
                  <option value="semua">Semua</option>
                  <?php foreach ($this->model_global->getDataGlobal("tb_provinsi")->result_array() as $rProv) {
                  ?>
                    <option value="<?=$rProv['id_provinsi']?>"><?=$rProv['name']?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-group col-xl-6 col-lg-12 kab_filter_global_class">
              <label for="recipient-name" class="col-form-label">Kabupaten</label>
              <select id="kab_filter_global" class="form-control" placeholder="Pick a state...">
                <option value="semua">SEMUA</option>
              </select>
            </div>
          </div>
          <div class="row match-height">
          <div class="form-group col-xl-12 col-lg-12">
              <label for="recipient-name" class="col-form-label">Pemilihan</label>
            <select id="select_id_pemilihan" class="form-control" placeholder="Pick a state...">
              <option value="">-Pilih-</option>
               <?php foreach ($this->model_global->getDataGlobal('tb_pemilihan')->result_array() as $Rpem) {
                  ?>
                    <option value="<?=$Rpem['id_pemilihan']?>">
                        <?php
                          if ($Rpem['is_pilgub']=='true' && $Rpem['is_pilbub']=='false'){
                              echo $this->model_global->tgl_indo($Rpem['tgl_pemilihan'])." - PILGUB";
                          } else if ($Rpem['is_pilgub']=='false' && $Rpem['is_pilbub']=='true') {
                              echo $this->model_global->tgl_indo($Rpem['tgl_pemilihan'])." - PILBUB";
                          } else if ($Rpem['is_pilgub']=='true' && $Rpem['is_pilbub']=='true'){
                              echo $this->model_global->tgl_indo($Rpem['tgl_pemilihan'])." - PILGUB & PILBUB";
                          }
                        ?>
                    </option>
                  <?php
                  }
                  ?>
              </select>

          </div>
          <div class="form-group col-xl-12 col-lg-12">
            <button class="btn btn-primary" onclick="UpdatePemilihanGlobal()">Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--/ Global settings -->
<script type="text/javascript">
  // var lat_db=$("#input_lat_update").val();
  // var lng_db=$("#input_lng_update").val();
  $(document).ready(function () {
  	  var session='<?=$this->session->userdata("level_akses")?>';
      if (session=='5') {
      	FilterKabupatenOnchange();
      	KabupatenOnchange('insert');
      }
  });
</script>
<script type="text/javascript">



  function TambahTps(){
    if ($("#no_tps").val()=='') {
      swal("Informasi","Masukkan No TPS" ,"error");
    } else if ($("#ketua_tps").val()=='') {
      swal("Informasi","Masukkan Ketua TPS" ,"error");
    } else if ($("#provinsi").val()=='') {
      swal("Informasi","Masukkan Provinsi TPS" ,"error");
    } else if ($("#kabupaten").val()=='') {
      swal("Informasi","Masukkan Kabupaten TPS" ,"error");
    } else if ($("#kecamatan").val()=='') {
      swal("Informasi","Masukkan Kecamatan TPS" ,"error");
    } else if ($("#kelurahan").val()=='') {
      swal("Informasi","Masukkan Kelurahan TPS" ,"error");
    } else if ($("#tgl_pemilihan").val()=='') {
      swal("Informasi","Tentukan tanggal pemilihan" ,"error");
    } else if ($("#lat").val()=='' && $("#lng").val()=='') {
      swal("Informasi","Tentukan Lokasi TPS" ,"error");
    } else {
    $("#pageloader").fadeIn();
       setTimeout(function() {
          var datasend = new FormData();
              datasend.append('no_tps',$('#no_tps').val());
              datasend.append('ketua_tps',$('#ketua_tps').val());
              datasend.append('provinsi',$('#provinsi').val());
              datasend.append('kabupaten',$('#kabupaten').val());
              datasend.append('kecamatan',$('#kecamatan').val());
              datasend.append('kelurahan',$('#kelurahan').val());
              datasend.append('latitude',$('#lat').val());
              datasend.append('longitude',$('#lng').val());
              datasend.append('tgl_pemilihan',$('#tgl_pemilihan').val());
              $.ajax({
                  url: '<?=base_url()?>Utility/TambahTps',
                  method: 'POST',
                  contentType: false,
                  processData: false,
                  data: datasend,
                  success: function(data) {
                    console.log(data);
                     $("#pageloader").fadeOut();
                    if (data=='sukses') {
                      swal("Informasi","Data Berhasil Di Tambahkan" ,"success")
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

  function EditTps(){
  	if ($("#no_tps_update").val()=='') {
  		swal("Informasi","Masukkan No TPS" ,"error");
  	} else if ($("#ketua_tps_update").val()=='') {
  		swal("Informasi","Masukkan Ketua TPS" ,"error");
  	} else if ($("#provinsi_update").val()=='') {
  		swal("Informasi","Masukkan Provinsi TPS" ,"error");
  	} else if ($("#kabupaten_update").val()=='') {
  		swal("Informasi","Masukkan Kabupaten TPS" ,"error");
  	} else if ($("#kecamatan_update").val()=='') {
  		swal("Informasi","Masukkan Kecamatan TPS" ,"error");
  	} else if ($("#kelurahan_update").val()=='') {
  		swal("Informasi","Masukkan Kelurahan TPS" ,"error");
  	} else if ($("#tgl_pemilihan_update").val()=='') {
      swal("Informasi","Masukkan Tanggal Pemilihan" ,"error");
    } else if ($("#lat_update").val()=='' && $("#lng_update").val()=='') {
  		swal("Informasi","Tentukan Lokasi TPS" ,"error");
  	} else {
    $("#pageloader").fadeIn();
	     setTimeout(function() {
	        var datasend = new FormData();
	            datasend.append('no_tps',$('#no_tps_update').val());
	            datasend.append('ketua_tps',$('#ketua_tps_update').val());
	            datasend.append('provinsi',$('#provinsi_update').val());
	            datasend.append('kabupaten',$('#kabupaten_update').val());
	            datasend.append('kecamatan',$('#kecamatan_update').val());
	            datasend.append('kelurahan',$('#kelurahan_update').val());
	            datasend.append('latitude',$('#lat_update').val());
              datasend.append('longitude',$('#lng_update').val());
	            datasend.append('id_tps',$('#id_tps').val());
              datasend.append('tgl_pemilihan',$('#tgl_pemilihan_update').val());
	            $.ajax({
	                url: '<?=base_url()?>Utility/UbahTps',
	                method: 'POST',
	                contentType: false,
	                processData: false,
	                data: datasend,
	                success: function(data) {
	                  console.log(data);
	                   $("#pageloader").fadeOut();
	                  if (data=='sukses') {
	                    swal("Informasi","Data TPS Berhasil Di Ubah" ,"success")
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
        hps.append('where','id_tps');
        hps.append('tb','tb_tps');
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
    hps.append('menu','tps');
    hps.append('table','tb_tps');
    hps.append('where','id_tps');
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
          console.log(data);
          $("#id_tps").val(id);
          $("#no_tps_update").val(data.no_tps);
          $("#ketua_tps_update").val(data.ketua_tps);
          $("#provinsi_update").val(data.id_provinsi);
          $("#kabupaten_update").val(data.id_kabupaten);
          $("#kecamatan_update").val(data.id_kecamatan);
          $("#kelurahan_update").val(data.id_kelurahan);
          $("#lat_update").val(data.latitude);
          $("#lng_update").val(data.longitude);
          $("#input_lng_update").val(data.longitude);
          $("#tgl_pemilihan_update").val(data.id_pemilihan);
          var lat=data.latitude;
          var lang=data.longitude;
          // EditMaps(lat,lang)
          // object.addEventListener("load", mapPicker());
          initialize2(lat,lang);
          getFormatLocation(lat,lang);
          //ProvinsiOnchange('update');
          var session='<?=$this->session->userdata("level_akses")?>';
      	  if (session=='5') {
          	//KabupatenOnchange('update');
          	//KecamatanOnchange('update');
      	  }
        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

  function getFormatLocation(lat,lang){
    $.ajax({
        url : 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lang+'&key=<?=config_item('MAP_API_KEY')?>',
        type : 'GET',
        data : {
            'numberOfWords' : 10
        },
        dataType:'json',
        success : function(data) {
            //alert('Data: '+data['results'][0]['formatted_address']);
            console.log(data);
            $("#location_update").html(data['results'][0]['formatted_address']);
        },
        error : function(request,error)
        {
            //alert("Request: "+data);
            console.log(data);
        }
    });
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
      } else {
        $("#formKabupaten_update").hide('slow');
        $("#formKecamatan_update").hide('slow');
        $("#formKelurahan_update").hide('slow');
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
            $("#formKabupaten").show('slow');
            $('#kabupaten').empty();
            $('#kabupaten').append('<option value="">Pilih Kabupaten..</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kabupaten').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }
            } else {
            $("#formKabupaten_update").show('slow');
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

  function KabupatenOnchange(type){
    var Typedaerah;
    if (type=='insert') {
       Typedaerah = $("#kabupaten").val();
    } else {
      Typedaerah = $("#kabupaten_update").val();
    }

    if (Typedaerah=='') {
      if (type=='insert') {
        $("#formKecamatan").hide('slow');
        $("#formKelurahan").hide('slow');
      } else {
        $("#formKecamatan_update").hide('slow');
        $("#formKelurahan_update").hide('slow');
      }
    } else {
      var hps = new FormData();
      hps.append('menu','kabupaten');
      hps.append('table','tb_kecamatan');
      hps.append('where','id_kabupaten');
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
            if (type=='insert') {
              $('#kecamatan').empty();
              var i;
              $("#formKecamatan").show('slow');
              $('#kecamatan').append('<option value="">Pilih Kecamatan..</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kecamatan').append('<option value="'+data[i]['id_kecamatan']+'">'+data[i]['name']+'</option>');
                }
            } else {
              $('#kecamatan_update').empty();
              var i;
              $("#formKecamatan_update").show('slow');
              $('#kecamatan_update').append('<option value="">Pilih Kecamatan..</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kecamatan_update').append('<option value="'+data[i]['id_kecamatan']+'">'+data[i]['name']+'</option>');
                }
            }
          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function KecamatanOnchange(type){

    var Typedaerah;
    if (type=='insert') {
       Typedaerah = $("#kecamatan").val();
    } else {
      Typedaerah = $("#kecamatan_update").val();
    }

   if (Typedaerah=='') {
      if (type=='insert') {
        $("#formKelurahan").hide('slow');
      } else {
        $("#formKelurahan_update").hide('slow');
      }
    } else {
      var hps = new FormData();
      hps.append('menu','kecamatan');
      hps.append('table','tb_kelurahan');
      hps.append('where','id_kecamatan');
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
            if (type=='insert') {
              $('#kelurahan').empty();
              var i;
              $("#formKelurahan").show('slow');
              $('#kelurahan').append('<option value="">Pilih Kelurahan..</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kelurahan').append('<option value="'+data[i]['id_kelurahan']+'">'+data[i]['name']+'</option>');
                }
            } else {
              $('#kelurahan_update').empty();
              var i;
              $("#formKelurahan_update").show('slow');
              $('#kelurahan_update').append('<option value="">Pilih Kelurahan..</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kelurahan_update').append('<option value="'+data[i]['id_kelurahan']+'">'+data[i]['name']+'</option>');
                }
            }
          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }



  function FilterProvinsiOnchange(){
    var Typedaerah=$("#prov_filter").val();
    if (Typedaerah=='semua') {
        // $("#filter_kab").hide('slow');
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
            $("#filter_kab").show('slow');
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

  function FilterKabupatenOnchange(){
    var Typedaerah=$("#kab_filter").val();

    if (Typedaerah=='semua') {
        // $("#filter_kec").hide('slow');
        // $("#filter_kel").hide('slow');
    } else {
      var hps = new FormData();
      hps.append('menu','kabupaten');
      hps.append('table','tb_kecamatan');
      hps.append('where','id_kabupaten');
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
              $("#filter_kec").show('slow');
              $('#kec_filter').empty();
              $('#kec_filter').append('<option value="semua">SEMUA</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kec_filter').append('<option value="'+data[i]['id_kecamatan']+'">'+data[i]['name']+'</option>');
                }

          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function FilterKecamatanOnchange(){

    var Typedaerah=$("#kec_filter").val();


   if (Typedaerah=='semua') {
        //$("#filter_kel").hide('slow');

    } else {
      var hps = new FormData();
      hps.append('menu','kecamatan');
      hps.append('table','tb_kelurahan');
      hps.append('where','id_kecamatan');
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
              $('#kel_filter').empty();
              var i;
              $("#filter_kel").show('slow');
              $('#kel_filter').append('<option value="semua">SEMUA</option>');
                for (i = 0; i < data.length; ++i) {
                    $('#kel_filter').append('<option value="'+data[i]['id_kelurahan']+'">'+data[i]['name']+'</option>');
                }

          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function FilterTPS() {
    //alert($('#prov_filter').val());
    //alert($('#kab_filter').val());
    if ($("#prov_filter").val()=='') {
      swal("Informasi","Tentukan Filter Provinsi" ,"error");
    } else {
    	$("#pageloader").show();

    	setTimeout(function() {
    		var hps = new FormData();
          hps.append('provinsi',$("#prov_filter").val());
          hps.append('kabupaten',$("#kab_filter").val());
          hps.append('kecamatan',$("#kec_filter").val());
          hps.append('kelurahan',$("#kel_filter").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/FilterTPS',
              method:'POST',
              contentType: false,
              processData:false,
              data  :hps,
              success: function(data) {
                console.log(data);
                $("#pageloader").hide();
               $("#filtered_tps").html(data);

              },error: function(data){
              	$("#pageloader").hide();
                 console.log(data);
                 swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
    	}, 500);
    }

    }

  function FilterProvinsiOnchangeFilter(){
    var Typedaerah=$("#prov_filter_global").val();
    if (Typedaerah=='semua') {
         $(".kab_filter_global_class").hide('slow');
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
            $(".kab_filter_global_class").show('slow');
            $('#kab_filter_global').empty();
            $('#kab_filter_global').append('<option value="semua">SEMUA</option>');
              for (i = 0; i < data.length; ++i) {
                  $('#kab_filter_global').append('<option value="'+data[i]['id_kabupaten']+'">'+data[i]['name']+'</option>');
              }

          },error: function(data){
             console.log(data);
             swal("Informasi","Gagal Terhubung Ke Server" ,"error");
          }
      });
    }
  }

  function UpdatePemilihanGlobal(){
    $("#pageloader").show();

      setTimeout(function() {
        var hps = new FormData();
          hps.append('id_provinsi',$("#prov_filter_global").val());
          hps.append('id_kabupaten',$("#kab_filter_global").val());
          hps.append('id_pemilihan',$("#select_id_pemilihan").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/UpdatePemilihanGlobal',
              method:'POST',
              contentType: false,
              processData:false,
              data  :hps,
              success: function(data) {
                console.log(data);
                 $("#pageloader").hide();
                 if (data=='sukses') {
                      swal("Informasi","Data TPS Berhasil Di Ubah" ,"success")
                      .then((value) => {
                        window.location.reload();
                      });
                    } else {
                      swal("Informasi","Terjadi Kesalahan Mohon Coba Beberapa Saat Lagi" ,"error");
                    }
              },error: function(data){
                $("#pageloader").hide();
                 console.log(data);
                 swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
      }, 500);
  }


</script>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
      $(".kab_filter_global_class").hide();
      $.noConflict();
      $('.search-select').selectize({
          sortField: 'text'
      });
      var table = $('#myTable').DataTable();

  });

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=config_item('MAP_API_KEY2')?>&language=id&sensor=false&libraries=places"></script>
<script type="text/javascript">
  function initialize2(lat,lang) {
   var latlng = new google.maps.LatLng(lat,lang);
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
</script>
