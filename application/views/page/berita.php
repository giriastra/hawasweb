  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">+Tambah</button>

            </div>

            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 30px">No</th>
                        <th scope="col"style="width: 100px">Gambar</th>
                        <th scope="col"style="width: 300px">Judul</th>
                        <th scope="col" style="width: 400px">Deskripsi</th>
                        <th scope="col"style="width: 80px">Tgl. Terbit</th>
                        <th scope="col"style="width: 100px">Jml. Comment</th>
                        <th scope="col"style="width: 100px">Jml. rating</th>
                        <th scope="col"style="width: 50px">Status</th>
                        <th scope="col" style="width: 280px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataNews()->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=$row['url_img_header']?>" target="_blank"><img src="<?=$row['url_img_header']?>" width="100px"></a></td>
                        <td><a target="_blank" href="<?=$row['url_website']?>"><?=$row['title']?></a></td>
                        <td><?=substr($row['desc'], 0,200)?></td>
                        <td><?=date("d-m-Y", strtotime($row['date_publish']))?></td>
                        <td><?=$row['jml_comment']?></td>
                        <td> <?php
                            if(strlen($row['val_rating'])>0 ){
                              for ($x = 0; $x <= $row['val_rating']-1; $x++) {
                                echo ' <span><i class="la la-star warning" style="font-size: 15px"></i></span>';
                              }
                              if($row['val_rating']>0){
                              echo "/(".$row['all_rating'].")";  
                              }

                            }
                        ?> </td>


                        <td><?= ($row['status']=='Y') ? '<b style="color:#5ed84f">Aktif</b>' : '<b style="color:#fa626b">Tidak Aktif</b>' ; ?></td>
                        <td style="width: 500px;">
                          <center>
                          <button class="btn btn-primary" data-toggle="modal" onclick="GetDataUpdate('<?=$row['id_news']?>')" data-target="#modal_update"><i class="la la-edit"></i></button>
                          <button class="btn btn-danger" onclick="alertdel('<?=$row['id_news']?>')"><i class="la la-trash"></i></button>
                          <a href="<?=base_url()?>news_comment/<?=$row['id_news']?>"> <button class="btn btn-success"><i class="la la-eye"></i> Comment</button></a>
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

                                  </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary" onclick="EditBerita()">Simpan</button>
                                </div>
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
              <label for="recipient-name" class="col-form-label">Judul</label>
              <input type="text" class="form-control" id="judul" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Deskripsi</label>
              <textarea class="form-control" id="desc" style="width:"></textarea>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Link gambar</label>
              <input type="text" class="form-control" id="link_gmbr" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Link website</label>
              <input type="text" class="form-control" id="link_web" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Status</label>
              <select class="form-control" id="status">
                <option value="">-Pilih-</option>
                <option value="Y">Aktif</option>
                <option value="N">Tidak aktif</option>
              </select>
            </div>
  <!--           <div class="form-group">
              <label for="recipient-name" class="col-form-label">tgl upload</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="la la-calendar"></i></span>
                  </div>
                  <input id="datepicker" v-model="newDate" style="border: 1px solid #ccc; border-radius: 0px 5px 5px 0px; width: 50%; padding-left: 5px;">
                </div>
            </div>  -->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="TambahBerita()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Berita</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">
          <input type="hidden" id="id_news" name="">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Judul</label>
              <input type="text" class="form-control" id="judul_update" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Deskripsi</label>
              <textarea class="form-control" id="desc_update" rows="5" style="width:"></textarea>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Link gambar</label>
              <input type="text" class="form-control" id="link_gmbr_update" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Link website</label>
              <input type="text" class="form-control" id="link_web_update" style="width:">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Status</label>
              <select class="form-control" id="status_update">
                <option value="">-Pilih-</option>
                <option value="Y">Aktif</option>
                <option value="N">Tidak aktif</option>
              </select>
            </div>
  <!--           <div class="form-group">
              <label for="recipient-name" class="col-form-label">tgl upload</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="la la-calendar"></i></span>
                  </div>
                  <input id="datepicker" v-model="newDate" style="border: 1px solid #ccc; border-radius: 0px 5px 5px 0px; width: 50%; padding-left: 5px;">
                </div>
            </div>  -->
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="EditBerita()">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!--/ Global settings -->
 <script>
  $(document).ready(function () {
      $.noConflict();
      var table = $('#myTable').DataTable();
  });

</script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      format: 'DD/MM/YYYY HH:mm:ss'
    });

  } );

  new Vue ({
  el: '#main',
  data: {
    newDate: '',
    dates: [
      {text: ''}
    ]
  },
  methods: {
    addDate: function(){
      var text = this.newDate.trim()
      if (text){
        this.dates.push({text: text})
        this.newDate = ''
      }
    },
    deleteDate(){

    }
  }
});

  function getFormattedDate() {
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear().toString().slice(2);
    return day + '-' + month + '-' + year;
}

function TambahBerita(){
  if ($('#judul').val()=='') {
    swal("Informasi","Masukkan Judul Berita" ,"error");
  } else if ($('#desc').val()=='') {
    swal("Informasi","Masukkan Deskripsi Berita" ,"error");
  } else if ($('#link_gmbr').val()=='') {
    swal("Informasi","Masukkan Link Gambar " ,"error");
  } else if ($('#link_web').val()=='') {
    swal("Informasi","Masukkan Link Website " ,"error");
  } else if ($('#status').val()=='') {
    swal("Informasi","Tentukan Status Berita " ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
            datasend.append('judul',$('#judul').val());
            datasend.append('desc',$('#desc').val());
            datasend.append('link_gmbr',$('#link_gmbr').val());
            datasend.append('link_web',$('#link_web').val());
            datasend.append('status',$('#status').val());
            $.ajax({
                url: '<?=base_url()?>Utility/AksiTambahBerita',
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

function GetDataUpdate(id) {
     $("#pageloader").fadeIn();
      setTimeout(function() {
        var hps = new FormData();
            hps.append('menu','berita');
            hps.append('table','tb_news');
            hps.append('where','id_news');
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
                   $("#pageloader").fadeOut();
                  $("#judul_update").val(data.judul);
                  $("#desc_update").val(data.desc);
                  $("#link_gmbr_update").val(data.url_img_header);
                  $("#link_web_update").val(data.url_website);
                  $("#status_update").val(data.status);
                  $("#id_news").val(id);

                },error: function(data){
                   console.log(data);
                   swal("Informasi","Gagal Terhubung Ke Server" ,"error");
                }
            });
        }, 300);
  }

function EditBerita(){
  if ($('#judul_update').val()=='') {
    swal("Informasi","Masukkan Judul Berita" ,"error");
  } else if ($('#desc_update').val()=='') {
    swal("Informasi","Masukkan Deskripsi Berita" ,"error");
  } else if ($('#link_gmbr_update').val()=='') {
    swal("Informasi","Masukkan Link Gambar " ,"error");
  } else if ($('#link_web_update').val()=='') {
    swal("Informasi","Masukkan Link Website " ,"error");
  } else if ($('#status_update').val()=='') {
    swal("Informasi","Tentukan Status Berita " ,"error");
  } else {
  $("#pageloader").fadeIn();
      setTimeout(function() {
            var datasend = new FormData();
            datasend.append('id_news',$('#id_news').val());
            datasend.append('judul',$('#judul_update').val());
            datasend.append('desc',$('#desc_update').val());
            datasend.append('link_gmbr',$('#link_gmbr_update').val());
            datasend.append('link_web',$('#link_web_update').val());
            datasend.append('status',$('#status_update').val());
            $.ajax({
                url: '<?=base_url()?>Utility/AksiEditBerita',
                method: 'POST',
                contentType: false,
                processData: false,
                data: datasend,
                success: function(data) {
                  console.log(data);
                  $("#pageloader").fadeOut();
                  if (data=='sukses') {
                    swal("Informasi","Pengguna Berhasil Diubah" ,"success")
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
        hps.append('id_news',id);
        $.ajax({
            url   :'<?=base_url()?>Utility/HapusBerita',
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
