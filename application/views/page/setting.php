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
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 200px">Kategori</th>
                        <th scope="col"style="width: 200px">Sub kategori</th>
                        <th scope="col"style="width: 200px">Value</th>
                        <th scope="col"style="width: 100px">Value2</th>
                        <th scope="col" style="width: 100px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_setting')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['kategori']?></td>
                        <td><?=$row['sub_kat']?></td>
                        <td><?=$row['value']?></td>
                        <td>
                          <?php
                            if ($row['val2_type']=='IMAGE') {
                          ?>
                            <img src="<?=base_url()?>assets/upload/setting/<?=$row['value2']?>" width="70px;">
                          <?php
                            } else {
                              echo $row['value2'];
                            }
                          ?>
                        </td>
                        <td style="width: 300px;">
                          <center>
                             <button class="btn btn-primary" data-toggle="modal" onclick="GetDataUpdate('<?=$row['id']?>')" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <?php
                            if ($row['isdeleted']=='0') {
                          ?>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id']?>')"><i class="la la-trash"></i></button>

                          <?php
                            }
                          ?>

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
<!-- modal update -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <input type="hidden" value="" id="id_setting" name="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">kategori</label>
            <input type="text" class="form-control" id="kategori_update"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sub kategori</label>
            <input type="text" class="form-control" id="sub_kategori_update"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Value</label>
            <input type="text" class="form-control" id="value_update"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Value2</label>
            <select class="form-control" id="imgORtxt_update" onchange="imgORtxt2()">
              <option value="IMAGE">Gambar</option>
              <option value="TEXT">Text</option>
            </select>
          <div class="" id="txt_update">
            <label for="recipient-name" class="col-form-label">Text Value2</label>
            <input type="text" class="form-control" id="txt_value2_update"  name="">
          </div>
          <div class="" id="img_update">
            <label for="recipient-name" class="col-form-label">Gambar Value2</label>
                <div class="file-upload">
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">IMAGE VALUE2</button>

                  <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' id="img_value_update" onchange="readURL(this);" accept="image/*" />
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="EditSetting()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ end modal insert -->
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Setting</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">kategori</label>
            <input type="text" class="form-control" id="kategori"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sub kategori</label>
            <input type="text" class="form-control" id="sub_kategori"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Value</label>
            <input type="text" class="form-control" id="value"  name="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Value2</label>
            <select class="form-control" id="imgORtxt" onchange="imgORtxt()">
              <option value="">-Pilih-</option>
              <option value="IMG">Gambar</option>
              <option value="TXT">Text</option>
            </select>
          <div class="" id="txt">
            <label for="recipient-name" class="col-form-label">Text Value2</label>
            <input type="text" class="form-control" id="txt_value2"  name="">
          </div>
          <div class="" id="img">
            <label for="recipient-name" class="col-form-label">Gambar Value2</label>
                <div class="file-upload2">
                  <button class="file-upload-btn2" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">IMAGE VALUE2</button>

                  <div class="image-upload-wrap2">
                    <input class="file-upload-input2" type='file' id="img_value2" onchange="readURL2(this);" accept="image/*" />
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
          </div>
          <div class="form-group">
             <label for="recipient-name" class="col-form-label">Delete status</label>
            <select class="form-control" id="isDelete">
              <option value="">-Pilih-</option>
              <option value="0">True</option>
              <option value="1">False</option>
            </select>
          </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="TambahSetting()">Simpan</button>
    </div>
  </div>
</div>
</div>
<!--/ Global settings -->

<script type="text/javascript">
  $(document).ready(function () {
    $.noConflict();
    
    var table = $('#myTable').DataTable(
      {
      "aLengthMenu": [[20, 30, 40, -1], [20, 30, 40, "All"]],
        "pageLength": 20
      }
    );


    $("#txt").hide();
    $("#img").hide();
});

  function TambahSetting(){
    var val2;
    var val2_type;
  if ($('#kategori').val()=='') {
    swal("Informasi","Masukkan Ketegori" ,"error");
  } else if ($('#sub_kategori').val()=='') {
    swal("Informasi","Masukkan Sub Kategori" ,"error");
  } else if ($('#value').val()=='') {
    swal("Informasi","Masukkan Value" ,"error");
  }
  else {
    if ($("#imgORtxt").val()=='IMG') {
      val2_type='IMAGE';
      val2=$('#img_value2')[0].files[0];
    } else {
      val2_type='TEXT';
      val2=$('#txt_value2').val();
    }
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
            datasend.append('kategori',$('#kategori').val());
            datasend.append('sub_kategori',$('#sub_kategori').val());
            datasend.append('value',$('#value').val());
            datasend.append('value2',val2);
            datasend.append('val2_type',val2_type);
            datasend.append('isDelete',$("#isDelete").val());
            $.ajax({
                url: '<?=base_url()?>Utility/TambahSetting',
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

    function imgORtxt(){
      if ($("#imgORtxt").val()=='IMG') {
        $("#img").show('slow');
        $("#txt").hide();
      } else if ($("#imgORtxt").val()=='TXT') {
        $("#txt").show('slow');
        $("#img").hide();
      } else {
        $("#img").hide('slow');
        $("#txt").hide('slow');
      }
    }

    function imgORtxt2(){
      if ($("#imgORtxt_update").val()=='IMAGE') {
        $("#img_update").show('slow');
        $("#txt_update").hide();
      } else if ($("#imgORtxt_update").val()=='TEXT') {
        $("#txt_update").show('slow');
        $("#img_update").hide();
      } else {
        $("#img_update").hide('slow');
        $("#txt_update").hide('slow');
      }
    }

    function AksiHapus(id) {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('tb','tb_setting');
        hps.append('where','id');
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
            hps.append('menu','setting');
            hps.append('table','tb_setting');
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
                  $("#pageloader").hide();

                  $("#kategori_update").val(data[0]['kategori']);
                  $("#sub_kategori_update").val(data[0]['sub_kat']);
                  $("#value_update").val(data[0]['value']);
                  $("#imgORtxt_update").val(data[0]['val2_type']);
                  $("#id_setting").val(id);

                  if (data[0]['val2_type']=='IMAGE') {
                    $("#img_update").show();
                    $("#txt_update").hide();
                    $('.file-upload-image').attr('src', "<?=base_url()?>assets/upload/setting/"+data[0]['value2']);
                    $('.image-upload-wrap').hide();
                    $('.file-upload-content').show();
                  } else {
                    $("#img_update").hide();
                    $("#txt_update").show();
                    $("#txt_value2_update").val(data[0]['value2']);
                  }



                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

  function EditSetting(){
   var val2;
  var val2_type;
  if ($('#kategori_update').val()=='') {
    swal("Informasi","Masukkan Ketegori" ,"error");
  } else if ($('#sub_kategori_update').val()=='') {
    swal("Informasi","Masukkan Sub Kategori" ,"error");
  } else if ($('#value_update').val()=='') {
    swal("Informasi","Masukkan Value" ,"error");
  }
  else {
    if ($("#imgORtxt_update").val()=='IMAGE') {
      val2_type='IMAGE';
      val2=$('#img_value_update')[0].files[0];
    } else {
      val2_type='TEXT';
      val2=$('#txt_value2_update').val();
    }
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
            datasend.append('kategori',$('#kategori_update').val());
            datasend.append('sub_kategori',$('#sub_kategori_update').val());
            datasend.append('value',$('#value_update').val());
            datasend.append('value2',val2);
            datasend.append('val2_type',val2_type);
            datasend.append('type',$("#imgORtxt_update").val());
            datasend.append('id_setting',$("#id_setting").val());
            $.ajax({
                url: '<?=base_url()?>Utility/UbahSetting',
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
