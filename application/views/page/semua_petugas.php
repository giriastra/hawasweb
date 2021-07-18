<link link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/forum.css">
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
<section id="global-settings" class="card">
        <div class="container">




        </div>
</section>

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
<!-- <div class="col-xl-12 col-lg-12" style="float:left;">
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
                        <option value="<?=$Rptgs->id_user?>"><?=$Rptgs->name?></option>
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

</div> -->
<div class="col-xl-12 col-lg-12" style="float:left;">
        <div class="card">
            <div class="card-header">
              <div class="row match-height">
                <div class="col-xl-3 col-lg-3">
                  <label for="recipient-name" class="col-form-label"><b>Filter Status</b></label>
                </div>
                <div class="col-xl-1 col-lg-1">
                  <label for="recipient-name" class="col-form-label"><b>&nbsp;</b></label>
                </div>
                <div class="col-xl-3 col-lg-3">
                  <label for="recipient-name" class="col-form-label"><b>&nbsp;</b></label>
                </div>
              </div>
              <div class="row match-height">
                <div class="col-xl-3 col-lg-3">
                     <select class="form-control" id="filter_status">
                       <option value="semua">SEMUA</option>
                       <option value="Y">Online</option>
                       <option value="N">Offline</option>
                     </select>
                  </div>
                  <div class="col-xl-1 col-lg-1" style="padding: 0px">
                      <button class="btn btn-primary" onclick="FIlter()"><i class="la la-search"></i></button>
                  </div>
                  <div class="col-xl-3 col-lg-3">
                    <a href="<?=base_url()?>lokasi_semua_petugas"><button class="btn btn-warning"><i class="la la-group"></i>Lokasi Petugas</button></a>
                  </div>
                </div>
            </div>
            <div class="card-body" id="filter_semuaPetugas">

                <div class="table-responsive" id="filtered_forum">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 40px">Foto</th>
                        <th scope="col"style="width: 150px">Nama</th>
                        <th scope="col"style="width: 100px">Status</th>
                        <th scope="col"style="width: 100px">Last Online</th>
                        <th scope="col" style="width: 170px;"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($this->model_global->ShowDafatarSemuaPetugas()->result() as $ptgsOnline) {
                      $no++;
                      ?>
                     <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" target="_blank"><img src="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" width="32px"></a></td>
                        <td><?=$ptgsOnline->name?></td>
                        <td>
                            <?php
                                if ($ptgsOnline->status_online=='Y') {
                                    echo '<i class="la la-dot-circle-o success"></i> <span class="success">Online</span>';
                                } else {
                                    echo '<i class="la la-dot-circle-o danger"></i> <span class="danger">Offline</span>';
                                }
                            ?>
                        </td>

                        <td><?= $ptgsOnline->date_change?></td>
                        <td style="width: 300px;">
                          <center>
                          <a href="<?=base_url()?>riwayat_lokasi_petugas/<?=$ptgsOnline->id_user?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-map-marker"></i> Lokasi</button></a>
                          <a href="<?=base_url()?>riwayat_pengaduan/<?=$ptgsOnline->id_user?>"><button class="btn btn-warning" data-toggle="modal">pengaduan</button></a>
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
 date=new Date();
 date.setMonth(date.getMonth() - 1);
$j(function () {
  $j("#datepicker").datepicker({
        autoclose: true,
        todayHighlight: true
  }).datepicker('update', date.toLocaleDateString());
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
  function FIlter() {

      $("#pageloader").show();
      setTimeout(function() {
          var hps = new FormData();
          hps.append('filter_status',$("#filter_status").val());
          $.ajax({
              url   :'<?=base_url()?>Utility/FilterSemuaPetugas',
              method:'POST',
              contentType: false,
              processData:false,
              data  :hps,
              success: function(data) {
                $("#pageloader").hide();
                console.log(data);
                $("#filter_semuaPetugas").html(data);
              },error: function(data){
                $("#pageloader").hide();
                 console.log(data);
                 swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
        }, 500);
      }
</script>
