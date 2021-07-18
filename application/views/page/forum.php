<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/forum.css">
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Forum</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Forum
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
<section id="global-settings" class="card">
        <div class="container">




        </div>
</section>

<style type="text/css">
.table td{
  padding:10px;
}
</style>


<!-- <div class="col-xl-4 col-lg-12" style="float:left">
        <div class="card" >
            <div class="card-header">
                <h4 class="card-title">Member</h4>
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
            <div class="card-content" style="height: 611px; overflow-y: scroll;background-color: #2c3e50">
                <div id="recent-buyers" class="media-list">

                  <?php foreach ($this->model_global->showMemberForum()->result_array() as $row) { ?>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                          <?php if ($row['status_online']=='Y') {
                          ?>
                          <span class="avatar avatar-md avatar-online">
                          <?php
                          } else {
                          ?>
                            <span class="avatar avatar-md avatar-busy">
                          <?php
                          }
                          ?>
                            <img class="media-object rounded-circle" src="<?=base_url()?>assets/img/user.png" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading" style="color: #fff;"><?=$row['name']?>

                            </span>

                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"><?= ($row['status_online']=='Y') ? 'Online' : 'Offline' ; ?></span>
                            </p>
                        </div>
                    </a>
                  <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="col-xl-12 col-lg-12" style="float:left;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="la la-search"></i> Filter Forum</h4>

            </div>
            <div class="card-body">
              <div class="row match-height">
                  <div class="col-xl-3 col-lg-3">
                    <label for="recipient-name" id="ab" class="col-form-label"><b>Tgl Dibuat</b></label>
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
                  <div class="col-xl-3 col-lg-3">
                    <label for="recipient-name" class="col-form-label"><b>Petugas</b></label>
                    <select class="form-control" id="petugas_filter">
                      <option value="semua">Semua</option>
                      <?php
                        foreach ($this->model_global->getDataGlobal('tb_user','id_type_user',2)->result() as $Rptgs) {
                      ?>
                        <option value="<?=$Rptgs->id_user?>"><?=$Rptgs->username?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
              </div>
            </div>
        <div class="card-footer">
          <button class="btn btn-primary" onclick="FilterForum()"><i class="la la-search"></i> Cari</button>
        </div>
    </div>

</div>
<div class="col-xl-12 col-lg-12" style="float:left;">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive" id="filtered_forum">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 100px">No</th>
                        <th scope="col"style="width: 200px">Judul</th>
                        <th scope="col"style="width: 150px">Tgl dibuat</th>
                        <th scope="col"style="width: 150px">Tgl tutup</th>
                        <th scope="col"style="width: 120px">Durasi</th>
                        <th scope="col"style="width: 150px">Pengguna</th>
                        <th scope="col"style="width: 150px">Petugas</th>
                        <th scope="col"style="width: 150px">Status</th>
                        <th scope="col" style="width: 100px;"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->getDaftarForum() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><?=$row->title?></td>
                        <td><?=date("d-m-Y H:i", strtotime($row->date_create))?></td>
                        <td><?php if(strlen($row->date_close)>5){echo date("d-m-Y H:i", strtotime($row->date_close));}else {echo "";}?></td>
                        <td><?php

                              if(strlen($row->date_close)>3){
                                  $to_time = strtotime($row->date_create);
                                  $from_time = strtotime($row->date_close);
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
                        <td>
                          <?php
                            $name_=@$this->model_global->getDataGlobal('tb_user','id_user',$row->id_user)->row()->name;
                            echo $name_;
                          ?>
                         </td>
                        <td>
                          <?php
                            if ($row->id_petugas==0) {
                              echo 'Belum Terverifikasi';
                            } else {
                              $name=@$this->model_global->getDataGlobal('tb_user','id_user',$row->id_petugas)->row()->name;
                              if (strlen($name)>0) {
                                echo $name;
                              } else {
                                echo 'Tidak Diketahui';
                              }
                            }
                          ?>
                         </td>
                        <td style="font-weight:bold;color:
                          <?php
                            if ($row->status=='OPEN') {
                              echo "#2196f3";
                            } else if ($row->status=='APPROVED') {
                              echo "#4caf50";
                            } else if ($row->status=='REJECTED') {
                              echo "#626e82";
                            } else {
                              echo "#f44336";
                            }
                          ?>
                         "><?=$row->status?></td>
                        <td style="width: 70px;">
                          <center>
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_update<?=$no?>"><i class="la la-edit"></i></button>
                            <button class="btn btn-danger" onclick="alertdel('<?=$row->id_user?>')"><i class="la la-trash"></i></button> -->
                            <a href="<?=base_url()?>chat_forum/<?=$row->id_forum?>?id_petugas=<?=$row->id_petugas?>&status=<?=$row->status?>"><button class="btn btn-success" onclick=""><i class="la la-eye"></i></button></a>
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
              </div>
            </div>
          </div>
      </div>

        </div>
 -->
<!--/ Global settings -->
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
  function FilterForum() {
    if ($("#tgl_dibuat").val()=='') {
      swal("Informasi","Masukkan Tgl Pembuatan Forum" ,"error");
    } else if ($("#tgl_tutup").val()=='') {
      swal("Informasi","Masukkan Tgl Penutupan Forum" ,"error");
    } else if ($("#status_filter").val()=='') {
      swal("Informasi","Tentukan Salah Satu Status Forum" ,"error");
    } else if ($("#petugas_filter").val()=='') {
      swal("Informasi","Tentukan Salah Satu Petugas Forum" ,"error");
    } else {
      $("#pageloader").show();
      setTimeout(function() {
          var hps = new FormData();
          hps.append('tgl_dibuat',$("#tgl_dibuat").val());
          hps.append('tgl_tutup',$("#tgl_tutup").val());
          hps.append('status',$("#status_filter").val());
          hps.append('petugas',$("#petugas_filter").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/FilterForum',
              method:'POST',
              contentType: false,
              processData:false,
              data  :hps,
              success: function(data) {
                $("#pageloader").hide();
                console.log(data);
                $("#filtered_forum").html(data);
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
