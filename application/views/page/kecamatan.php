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

          <?php
          	if ($this->session->userdata('level_akses')=='5') {
          		$id_parent=$this->session->userdata('id_kabupaten');
          	} 
          	$id_previous=$this->db->get_where("tb_kabupaten", array("id_kabupaten" => $id_parent))->row();
          ?>
         <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-8 col-12">
            <div class="breadcrumbs-top float-md-left">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                  	<?php
                  		if ($this->session->userdata('level_akses')=='5') {
                  	?>
                    <a href="" style="pointer-events: none;"><b><?=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$id_previous->id_provinsi)->row()->name?></b></a>
                	<?php } else { ?>
                	<a href="<?=base_url()?>daerah"><b><?=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$id_previous->id_provinsi)->row()->name?></b></a>
                	<?php } ?>
                  </li>
                  <li class="breadcrumb-item">
                  	<?php
                  		if ($this->session->userdata('level_akses')=='5') {
                  	?>
                    	<a href="" style="pointer-events: none;"><b><?=$id_previous->name?></b></a>
                    <?php } else { ?>
                    	<a href="<?=base_url()?>kabupaten/<?=$id_previous->id_provinsi?>"><b><?=$id_previous->name?></b></a>
                    <?php } ?>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Kecamatan</a>
                  </li>
                  <!-- <li class="breadcrumb-item active"><?=$page_name?>
                  </li> -->
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12 mb-2">
            <h3 class="content-header-title">&nbsp;</h3>
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
                        <th scope="col" style="width: 5px">No</th>
                        <th scope="col"style="width: 200px">Kecamatan</th>
                        <th scope="col"style="width: 100px">Jml. Kelurahan</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $id_kab=$id_parent;
                      $no=0;
                      foreach ($this->model_global->GetDataDaerah('kecamatan',$id_kab)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>kelurahan/<?=$row['id_kecamatan']?>"><?=$row['name']?></a></td>
                        <td><?=$row['jml_kelurahan']?></td>
                        <td style="width: 300px;">
                          <center>
                          <a href="<?=base_url()?>kelurahan/<?=$row['id_kecamatan']?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-eye"></i></button></a>
                          <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id_kecamatan']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_kecamatan']?>')"><i class="la la-trash"></i></button>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah Kecamatan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" style="width:">
          </div>
          <input type="hidden" id="id_kabupaten" value="<?=$id_parent?>" name="">
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="tambahKecamatan()">Simpan</button>
    </div>
  </div>
</div>
</div>

<!-- modal update -->
  <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Kecamatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Kecamatan</label>
                <input type="text" class="form-control" value="" id="kec_update" style="">
              </div>
              <input type="hidden" id="id_kec" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditKec()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- end modal update -->
<!--/ Global settings -->
 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable(
      {
      "aLengthMenu": [[20, 30, 40, -1], [20, 30, 40, "All"]],
        "pageLength": 20
      }
    );
});</script>

<script type="text/javascript">

  function tambahKecamatan() {
    if ($("#kecamatan").val()=='') {
      swal("Informasi","Masukkan Nama Kecamatan" ,"error");
    } else {
    var hps = new FormData();
        hps.append('id_kabupaten',$("#id_kabupaten").val());
        hps.append('kecamatan',$("#kecamatan").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/TambahKecamatan',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Kecamatan Berhasil Di Tambah" ,"success")
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
          text: "Ingin Menghapus Data Kabupaten Yang Dipilih?",
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
        hps.append('id_kec',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusKecamatan',
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
    hps.append('menu','kecamatan');
    hps.append('table','tb_kecamatan');
    hps.append('where','id_kecamatan');
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
          $("#kec_update").val(data.kecamatan);
          $("#id_kec").val(id);
        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

    function AksiEditKec() {
    if ($("#kec_update").val()=='') {
      swal("Informasi","Masukkan Nama Kecamatan" ,"error");
    } else {
    var hps = new FormData();
        hps.append('kec_update',$("#kec_update").val());
        hps.append('id_kec',$("#id_kec").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/EditKecamatan',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Kecamatan Berhasil Di Ubah" ,"success")
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
