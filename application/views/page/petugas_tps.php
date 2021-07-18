
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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

</style>


        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?=$page_name .": ".$this->model_global->getDataGlobal('tb_tps','id_tps',$id_tps)->row()->no_tps?></h3>
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
                        <th scope="col"style="width: 100px">Petugas</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_tps_petugas','id_tps',$id_tps)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$this->model_global->getDataGlobal('tb_user','id_user',$row['id_petugas'])->row()->name?></td>
                        <td style="width: 300px;">
                          <center>

                          <button class="btn btn-primary" data-toggle="modal" onclick="GetDataUpdate('<?=$row['id_tps_petugas']?>')" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_tps_petugas']?>')"><i class="la la-trash"></i></button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas TPS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Petugas</label>
            <select id="petugas" class="search-select" placeholder="Pilih petugas...">
                <option value="">Pilih Petugas..</option>
                <?php foreach ($this->model_global->GetdataPetugasTPS($id_tps)->result_array() as $rKab) {
                ?>
                  <option value="<?=$rKab['id_user']?>"><?=$rKab['name']?></option>
                <?php
                }
                ?>
            </select>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="TambahPetugas()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ end modal insert -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ubah Petugas TPS</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
           <label for="recipient-name" class="col-form-label">Petugas</label>
            <select id="petugas_update" class="form-control" placeholder="Pick a state...">
              <?php foreach ($this->model_global->GetdataPetugasTPS($id_tps)->result_array() as $pUpdate) {
                ?>
                  <option value="<?=$pUpdate['id_user']?>"><?=$pUpdate['name']?></option>
                <?php
                }
                ?>
            </select>
          </div>

          <input type="hidden" id="id_petugas" name="">
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="editPetugas()">Simpan</button>
    </div>
  </div>
</div>
</div>
<!--/ Global settings -->

<script type="text/javascript">
  $(document).ready(function () {
    $.noConflict();
     $('.search-select').selectize({
          sortField: 'text'
      });
    var table = $('#myTable').DataTable();
});


  function TambahPetugas(){
  if ($('#petugas').val()=='') {
    swal("Informasi","Masukkan Nama Petugas" ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
            datasend.append('petugas',$('#petugas').val());
            datasend.append('id_tps',<?=$id_tps?>);
            $.ajax({
                url: '<?=base_url()?>Utility/AksiTambahPetugas',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Petugas Berhasil Ditambahkan" ,"success")
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
        hps.append('tb','tb_tps_petugas');
        hps.append('where','id_tps_petugas');
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

    function GetDataUpdate(id) {
     $("#pageloader").fadeIn();
      setTimeout(function() {
        var hps = new FormData();
            hps.append('menu','petugas');
            hps.append('table','tb_tps_petugas');
            hps.append('where','id_tps_petugas');
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
                  console.log(data[0]['id_petugas']);
                  $("#pageloader").hide();
                  $("#petugas_update").val(data[0]['id_petugas']);
                  $("#id_petugas").val(data[0]['id_tps_petugas']);
                  $('#id_petugas option[value='+data[0]['id_petugas']+']').prop('selected',true);


                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

  function editPetugas(){
  if ($('#petugas_update').val()==null) {
    swal("Informasi","Masukkan Nama Petugas" ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
           datasend.append('petugas',$('#petugas_update').val());
           datasend.append('id_petugas_tps',$('#id_petugas').val());
            $.ajax({
                url: '<?=base_url()?>Utility/editPetugas',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Data Berhasil Diubah" ,"success")
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
