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


<?php $id_previousKec=$this->db->get_where("tb_kecamatan", array("id_kecamatan" => $id_parent))->row()?>
<?php $id_previousKab=$this->db->get_where("tb_kabupaten", array("id_kabupaten" => $id_previousKec->id_kabupaten))->row()?>
<?php $id_previousProv=$this->db->get_where("tb_provinsi", array("id_provinsi" => $id_previousKab->id_provinsi))->row()?>
         <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-8 col-12">
            <div class="breadcrumbs-top float-md-left">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?=base_url()?>daerah"><b><?=$id_previousProv->name?></b></a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?=base_url()?>kabupaten/<?=$id_previousKab->id_provinsi?>"><b><?=$id_previousKab->name?></b></a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?=base_url()?>kecamatan/<?=$id_previousKec->id_kabupaten?>"><b><?=$id_previousKec->name?></b></a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Kelurahan</a>
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
                        <th scope="col" style="width: 30px">No</th>
                        <th scope="col"style="width: 200px">Kelurahan</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $id_kec=$id_parent;
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_kelurahan','id_kecamatan',$id_kec)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['name']?></td>
                        <td style="width: 300px;">
                          <center>
                          <!-- <a href="<?=base_url()?>kelurahan/<?=$row['id_kelurahan']?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-eye"></i></button></a> -->
                          <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id_kelurahan']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_kelurahan']?>')"><i class="la la-trash"></i></button>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah Kelurahan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kelurahan</label>
            <input type="text" class="form-control" id="kelurahan" style="width:">
          </div>
          <input type="hidden" id="id_kecamatan" value="<?=$id_parent?>" name="">
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="tambahKelurahan()">Simpan</button>
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
                <input type="text" class="form-control" value="" id="kel_update" style="">
              </div>
              <input type="hidden" id="id_kel" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditKel()">Simpan</button>
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

  function tambahKelurahan() {
    if ($("#kelurahan").val()=='') {
      swal("Informasi","Masukkan Nama Kelurahan" ,"error");
    } else {
    var hps = new FormData();
        hps.append('id_kecamatan',$("#id_kecamatan").val());
        hps.append('kelurahan',$("#kelurahan").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/TambahKelurahan',
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
          text: "Ingin Menghapus Data Kelurahan Yang Dipilih?",
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
        hps.append('id_kel',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusKelurahan',
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
    hps.append('menu','kelurahan');
    hps.append('table','tb_kelurahan');
    hps.append('where','id_kelurahan');
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
          $("#kel_update").val(data.kelurahan);
          $("#id_kel").val(id);
        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

    function AksiEditKel() {
    if ($("#kel_update").val()=='') {
      swal("Informasi","Masukkan Nama Kelurahan" ,"error");
    } else {
    var hps = new FormData();
        hps.append('kel_update',$("#kel_update").val());
        hps.append('id_kel',$("#id_kel").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/EditKelurahan',
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
