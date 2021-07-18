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
          <div class="content-header-left col-md-8 col-12">
            <div class="breadcrumbs-top float-md-left">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?=base_url()?>daerah"><b><?=$this->model_global->getDataGlobal('tb_provinsi','id_provinsi',$id_parent)->row()->name?></b></a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Kabupaten</a>
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
                        <th scope="col"style="width: 150px">Kabupaten</th>
                        <th scope="col"style="width: 100px">Jml.Kecamatan</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $id_prov=$id_parent;
                      $no=0;
                      foreach ($this->model_global->GetDataDaerah('kabupaten',$id_prov)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>kecamatan/<?=$row['id_kabupaten']?>"><?=$row['name']?></a></td>
                        <td><?=$row['jml_kecamatan']?></td>
                        <td style="width: 300px;">
                          <center>
                          <a href="<?=base_url()?>kecamatan/<?=$row['id_kabupaten']?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-eye"></i></button></a>
                          <button class="btn btn-primary" onclick="getDataForUpdate('<?=$row['id_kabupaten']?>')" data-toggle="modal" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_kabupaten']?>')"><i class="la la-trash"></i></button>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten" style="width:">
          </div>
          <input type="hidden" id="id_prov" value="<?=$id_parent?>" name="">
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="tambahKabupaten()">Simpan</button>
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
                <label for="recipient-name" class="col-form-label">Kabupaten</label>
                <input type="text" class="form-control" value="" id="kab_update" style="">
              </div>
              <input type="hidden" id="id_kab" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditKab()">Simpan</button>
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


} );
});</script>

<script type="text/javascript">
  function tambahKabupaten() {
     if ($("#kabupaten").val()=='') {
      swal("Informasi","Masukkan Nama Kabupaten" ,"error");
    } else {
    var hps = new FormData();
        hps.append('id_prov',$("#id_prov").val());
        hps.append('kabupaten',$("#kabupaten").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/TambahKab',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Pengguna Berhasil Di Tambah" ,"success")
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
        hps.append('id_kab',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusKabupaten',
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
    hps.append('menu','kabupaten');
    hps.append('table','tb_kabupaten');
    hps.append('where','id_kabupaten');
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
          $("#kab_update").val(data.kabupaten);
          $("#id_kab").val(id);
        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

    function AksiEditKab() {
    if ($("#kab_update").val()=='') {
      swal("Informasi","Masukkan Nama Kabupaten" ,"error");
    } else {
    var hps = new FormData();
        hps.append('kab_update',$("#kab_update").val());
        hps.append('id_kab',$("#id_kab").val());
        $.ajax({
            url   :'<?=base_url()?>Utility/EditKabupaten',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                 swal("Informasi","Pengguna Berhasil Di Ubah" ,"success")
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
