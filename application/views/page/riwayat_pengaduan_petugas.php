<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

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

.table td{
  padding:10px;
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

<div class="col-xl-12 col-lg-12" style="float:left;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="la la-search"></i> Filter Complaint</h4>

            </div>
            <div class="card-body">
              <div class="row match-height">
                  <div class="col-xl-3 col-lg-3">
                    <label for="recipient-name" id="ab" class="col-form-label"><b>Tgl Request</b></label>
                      <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input class="form-control" id="tgl_dibuat" style="border-radius: 4px;" type="text" readonly="" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-3">
                    <label for="recipient-name" id="aa" class="col-form-label"><b>Tgl Tutup</b></label>
                    <div id="datepicker2" class="input-group date" data-date-format="dd-mm-yyyy">
                        <input class="form-control" id="tgl_tutup" style="border-radius: 4px;" type="text" readonly="" />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-3">
                    <label for="recipient-name" class="col-form-label"><b>Status</b></label>
                    <select class="form-control" id="status_filter">
                      <option value="semua">Semua</option>
                      <?php
                        foreach ($this->model_global->getDataGlobal('tb_setting','kategori','STATUS_FORUM')->result() as $Rsts) {
                      ?>
                        <option value="<?=$Rsts->value?>"><?=$Rsts->value?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-xl-3 col-lg-3" style="display: none; ;">
                    <label for="recipient-name" class="col-form-label"><b>Petugas</b></label>
                    <input type="text" id="petugas_filter" value="<?=$id_petugas?>" name="">
                  </div>
              </div>
            </div>
        <div class="card-footer">
          <button class="btn btn-primary" onclick="FilterComplaint()"><i class="la la-search"></i> Cari</button>
        </div>
    </div>

</div>
<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">


            <div class="card-body">
              <div class="table-responsive" id="filtered_complaint">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 90px">No</th>
                        <th scope="col"style="width: 150px">Code</th>
                        <th scope="col"style="width: 200px">Petugas</th>
                        <th scope="col"style="width: 200px">Pengguna</th>
                        <th scope="col"style="width: 160px">Request</th>
                        <th scope="col"style="width: 160px">Konfirmasi</th>
                        <th scope="col"style="width: 160px">Selesai</th>
                        <th scope="col"style="width: 160px">Durasi</th>
                        <th scope="col"style="width: 200px">Topik</th>
                        <th scope="col"style="width: 150px">Status</th>
                        <th scope="col"style="width: 150px">Rating</th>
                        <th scope="col"style="width: 200px">Komentar</th>
                        <th scope="col" style="width: 140px"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getDaftarComplaint('riwayat',$id_petugas)->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row['code']?></td>
                        <td>
                          <?php
                            if ($row['id_petugas']==0) {
                              echo 'Belum Terverifikasi';
                            } else {
                              $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row['id_petugas'])->row()->name;
                              if (strlen($name)>0) {
                                echo $name;
                              } else {
                                echo 'Tidak Diketahui';
                              }
                            }
                          ?>

                        </td>
                        <td>
                          <?php
                            if ($row['id_user']==0) {
                              echo 'Tidak Diketahui';
                            } else {
                              $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row['id_user'])->row()->name;
                              if (strlen($name)>0) {
                                echo $name;
                              } else {
                                echo 'Tidak Diketahui';
                              }
                            }
                          ?>
                        </td>
                        <td><?php if(strlen($row['date_request'])>5){echo date("d-m-Y H:i", strtotime($row['date_request']));}else {echo "";}?></td>
                        <td><?php if(strlen($row['date_confirm'])>5){echo date("d-m-Y H:i", strtotime($row['date_confirm']));}else {echo "";}?></td>
                        <td><?php if(strlen($row['date_finish'])>5){echo date("d-m-Y H:i", strtotime($row['date_finish']));}else {echo "";}?></td>
                          <td><?php

                                if(strlen($row['date_finish'])>3 && strlen($row['date_confirm'])>3 ){
                                    $to_time = strtotime($row['date_confirm']);
                                    $from_time = strtotime($row['date_finish']);
                                    $duration =  round(abs($to_time - $from_time) / 60,0);

                                    if($duration>60){
                                      $jam = round($duration/60,0);
                                      if($jam>24){
                                        $hari  =round($jam/24,0)."d -";
                                        $jam = round($jam%24,0);
                                      }
                                      $menit = $duration%60;
                                      $waktu = @$hari." ".$jam."h - ".$menit."m";
                                    }else{
                                      $waktu = $duration." menit";
                                    }

                                    echo $waktu;
                                }

                          ?></td>
                        <td><?=$row['title']?></td>
                        <td style="font-weight:bold;color:
                          <?php
                            if ($row['status']=='OPEN') {
                              echo "#2196f3";
                            } else if ($row['status']=='APPROVED') {
                              echo "#4caf50";
                            } else if ($row['status']=='REJECTED') {
                              echo "#626e82";
                            } else {
                              echo "#f44336";
                            }
                          ?>
                        ">
                        <?=$row['status']?>
                        </td>

                        <td> <?php
                            if(strlen($row['message_rating'])>0 ){
                              for ($x = 0; $x <= $row['value_rating']-1; $x++) {
                                echo ' <span><i class="la la-star warning" style="font-size: 15px"></i></span>';
                              }
                            }
                        ?> </td>
                        <td><?=$row['message_rating']?></td>
                        <td style="width: 300px;">
                        <center>
                          <a href="<?=base_url()?>detail_complaint/<?=$row['id_complaint']?>?id_petugas=<?=$row['id_petugas']?>&status=<?=$row['status']?>"><button class="btn btn-success" onclick=""><i class="la la-eye"></i></button></a>
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
<script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>

<script script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
 var $j = jQuery.noConflict();
 

  var minDate = new Date();
  minDate.setMonth(minDate.getMonth() - 1);
  $j(function () {
  $j("#datepicker").datepicker({
      autoclose: true,
      todayHighlight: true
  }).datepicker('update',minDate);
  });

  $j(function () {
  $j("#datepicker2").datepicker({
      autoclose: true,
      todayHighlight: true
  }).datepicker('update', new Date());
  });



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
</script>

<script type="text/javascript">



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

  <script type="text/javascript">
  function FilterComplaint() {
    if ($("#tgl_dibuat").val()=='') {
      swal("Informasi","Masukkan Tgl Request Complaint" ,"error");
    } else if ($("#tgl_tutup").val()=='') {
      swal("Informasi","Masukkan Tgl Penutupan Complaint" ,"error");
    } else if ($("#status_filter").val()=='') {
      swal("Informasi","Tentukan Salah Satu Status Complaint" ,"error");
    } else if ($("#petugas_filter").val()=='') {
      swal("Informasi","Tentukan Salah Satu Petugas Complaint" ,"error");
    } else {
      $("#pageloader").show();
      setTimeout(function() {
          var hps = new FormData();
          hps.append('tgl_dibuat',$("#tgl_dibuat").val());
          hps.append('tgl_tutup',$("#tgl_tutup").val());
          hps.append('status',$("#status_filter").val());
          hps.append('petugas',$("#petugas_filter").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/FilterComplaint',
              method:'POST',
              contentType: false,
              processData:false,
              data  :hps,
              success: function(data) {
                $("#pageloader").hide();
                console.log(data);
                $("#filtered_complaint").html(data);
              },error: function(data){
                $("#pageloader").hide();
                 console.log(data);
                 swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
        }, 500);
      }
    }
</script>
