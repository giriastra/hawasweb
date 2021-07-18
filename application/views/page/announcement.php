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

            </div>

            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 100px">Gambar</th>
                        <th scope="col"style="width: 100px">Judul</th>
                        <th scope="col"style="width: 200px">Deskripsi</th>
                        <th scope="col"style="width: 30px">Like</th>
                        <th scope="col"style="width: 50px">Status</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataAnnouncement()->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>assets/upload/announcement/<?=$row['url_img']?>" target="_blank"><img src="<?=base_url()?>assets/upload/announcement/<?=$row['url_img']?>" width="100px"></a></td>
                        <td><a href="<?=$row['url_website']?>" target="_blank"><?=$row['title']?></a></td>
                        <td><?=$row['desc']?></td>

                        <td><?=$row['jml_like']?></td>
                        <td><?=($row['status']=='Y') ? '<b class="success">Aktif</b>' : '<b class="danger">Tidak Aktif</b>' ; ?></td>
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
      <h5 class="modal-title" id="exampleModalLabel">Tambah Himbauan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Judul</label>
            <input type="text" class="form-control" id="judul" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Deskripsi</label>
            <input type="text" class="form-control" id="desc" style="width:">
          </div>
         <!--  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link Gambar</label>
            <input type="text" class="form-control" id="link_gambar" style="width:">
          </div> -->
          <div class="form-group">
          <label for="recipient-name" class="col-form-label">Upload Gambar</label>
            <div class="file-upload">
              <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Upload Gambar</button>

              <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' id="up_gambar" onchange="readURL(this);" accept="image/*" />
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
            <label for="recipient-name" class="col-form-label">Link Website</label>
            <input type="text" class="form-control" id="link_website" style="width:">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Status</label>
            <select class="form-control" id="status">
            	<option value="">-Pilih-</option>
            	<option value="Y">Aktif</option>
            	<option value="N">Tidak Aktif</option>
            </select>
          </div>
          <input type="hidden" id="id_kabupaten" value="" name="">
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
          <label for="recipient-name" class="col-form-label">Upload Gambar</label>
            <div class="file-upload2">
              <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Upload Gambar</button>

              <div class="image-upload-wrap2">
                <input class="file-upload-input2" type='file' id="up_gambar_update" onchange="readURL2(this);" accept="image/*" />
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
<!--/ Global settings -->
 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>

<script type="text/javascript">

  function tambahHimbauan() {
  	var gambar=$('#up_gambar')[0].files[0];
    var hps = new FormData();
    if ($("#judul").val()=='') {
    	swal("Informasi","Masukkan Judul Himbauan" ,"error");
    } else if ($("#desc").val()=='') {
    	swal("Informasi","Masukkan Deskripsi Himbauan" ,"error");
    } else if ($("#link_gambar").val()=='') {
    	swal("Informasi","Masukkan Link Gambar Himbauan" ,"error");
    } else if ($("#status").val()=='') {
    	swal("Informasi","Tentukan Status Himbauan" ,"error");
    } else {
    	$("#pageloader").show();
        hps.append('judul',$("#judul").val());
        hps.append('desc',$("#desc").val());
        hps.append('link_gambar',gambar);
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
              	$("#pageloader").hide();
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }

            },error: function(data){
            	$("#pageloader").hide();
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

           $('.file-upload-image2').attr('src', "<?=base_url()?>assets/upload/announcement/"+data[0]['url_img']);
            $('.image-upload-wrap2').hide();
            $('.file-upload-content2').show();

        },error: function(data){
           console.log(data);
           swal("Informasi","Gagal Terhubung Ke Server" ,"error");
        }
    });
  }

    function AksiEdit() {
    	var gambar=$('#up_gambar_update')[0].files[0];
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
        hps.append('link_gambar',gambar);
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
