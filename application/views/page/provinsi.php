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
                    <a href="javascript:void(0)">Provinsi</a>
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
                 
            </div>

            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 30px">No</th>
                        <th scope="col"style="width: 200px">Provinsi</th>
                        <th scope="col"style="width: 50px">Jml. Kabupaten</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->GetDataDaerah('provinsi')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>kabupaten/<?=$row['id_provinsi']?>"><?=$row['name']?></a></td>
                        <td><?=$row['jml_kabupaten']?></td>
                        <td style="width: 300px;">
                          <center>
                          <a href="<?=base_url()?>kabupaten/<?=$row['id_provinsi']?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-eye"></i></button></a>
                          <button class="btn btn-primary" data-toggle="modal" onclick="editProv('<?=$row['id_provinsi']?>')" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_provinsi']?>')"><i class="la la-trash"></i></button>
                        </center>

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


<!-- modal insert -->
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Daerah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Provinsi</label>
              <input type="text" class="form-control" id="provinsi" style="width:">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahProv()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ end modal insert -->

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
                <label for="recipient-name" class="col-form-label">Provinsi</label>
                <input type="text" class="form-control" value="" id="prov_update" style="">
              </div>
              <input type="hidden" id="id_prov" value="" name="">
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="AksiEditProv()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- end modal update -->
 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>
<script type="text/javascript">
  function tambahProv() {
    if ($("#provinsi").val()=='') {
      swal("Informasi","Masukkan Nama Provinsi" ,"error");
    } else {
      var hps = new FormData();
          hps.append('prov',$("#provinsi").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/TambahProv',
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

  function AksiEditProv() {
    if ($("#prov_update").val()=='') {
      swal("Informasi","Masukkan Nama Provinsi" ,"error");
    } else {
      var hps = new FormData();
          hps.append('prov_update',$("#prov_update").val());
          hps.append('id_prov',$("#id_prov").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/EditProv',
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

  function editProv(id) {
    var hps = new FormData();
        hps.append('menu','provinsi');
        hps.append('table','tb_provinsi');
        hps.append('where','id_provinsi');
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
              $("#prov_update").val(data.provinsi);
              $("#id_prov").val(id);


            },error: function(data){
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
  }

  function alertdel(id){
     swal({
          title: "Anda Yakin",
          text: "Ingin Menghapus Data Provinsi Yang Dipilih?",
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
        hps.append('id_provinsi',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusProvinsi',
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

</script>
