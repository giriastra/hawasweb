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
                        <th scope="col"style="width: 200px">Nama partai</th>                        
                        <th scope="col"style="width: 200px">Logo</th>                        
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_partai')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['nama_partai']?></td>                       
                        <td><img src="<?=base_url()?>assets/upload/partai/<?=$row['img_logo']?>" width='100px'></td>                       
                        <td style="width: 300px;">
                          <center>
                          
                          <button class="btn btn-primary" data-toggle="modal" onclick="GetDataUpdate('<?=$row['id_partai']?>')" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_partai']?>')"><i class="la la-trash"></i></button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Partai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Partai</label>
              <input type="text" class="form-control" id="nama_partai" style="width:">
            </div>
          <div class="form-group">
            <div class="file-upload">
              <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Logo partai</button>

              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' id="logo_partai" onchange="readURL(this);" accept="image/*" />
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
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="TambahBerita()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ end modal insert -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ubah Partai</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama partai</label>              
            <input type="text" class="form-control" id="nama_partai_update"  name="">
          </div>
          <div class="form-group">
              <label for="recipient-name" class="col-form-label">Upload foto</label>
                <div class="file-upload2">
                  <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Logo Partai</button>

                  <div class="image-upload-wrap2">
                    <input class="file-upload-input2" type='file' id="logo_partai_update" onchange="readURL2(this);" accept="image/*" />
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
          <input type="hidden" id="id_partai" name="">          
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="EditPartai()">Simpan</button>
    </div>
  </div>
</div>
</div>
<!--/ Global settings -->

<script type="text/javascript">
  $(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});


  function TambahBerita(){
  var logo_partai=$('#logo_partai')[0].files[0];
  if ($('#nama_partai').val()=='') {
    swal("Informasi","Masukkan Nama Partai" ,"error");
  } else if ($('.file-upload-content').is(":hidden")) {
    swal("Informasi","Masukkan Gambar Partai" ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();            
            datasend.append('nama_partai',$('#nama_partai').val());          
            datasend.append('logo_partai',logo_partai);          
            $.ajax({
                url: '<?=base_url()?>Utility/AksiTambahPartai',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Partai Berhasil Ditambahkan" ,"success")
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
        hps.append('tb','tb_partai');
        hps.append('where','id_partai');
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
            hps.append('menu','partai');
            hps.append('table','tb_partai');
            hps.append('where','id_partai');
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
                  $("#pageloader").hide();                 
                  $("#nama_partai_update").val(data.nama_partai);
                  $("#id_partai").val(id);

                  $('.file-upload-image2').attr('src', "<?=base_url()?>assets/upload/partai/"+data.img_logo);       
                  $('.image-upload-wrap2').hide();
                  $('.file-upload-content2').show();

                    
                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

  function EditPartai(){
  var logo_partai_update=$('#logo_partai_update')[0].files[0];
  if ($('#nama_partai_update').val()=='') {
    swal("Informasi","Masukkan nama partai" ,"error");
  } else if ($('.file-upload-content2').is(":hidden")) {
    swal("Informasi","Masukkan Gambar Partai" ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();            
           datasend.append('logo_partai',logo_partai_update);         
           datasend.append('nama_partai',$('#nama_partai_update').val());         
           datasend.append('id_partai',$('#id_partai').val());         
            $.ajax({
                url: '<?=base_url()?>Utility/EditPartai',
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