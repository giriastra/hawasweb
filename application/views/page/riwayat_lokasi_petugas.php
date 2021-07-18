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
                          
            <div class="card-body">
              
                <div class="table-responsive" id="filtered_forum">
                  <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 20px">No</th>
                        <th scope="col"style="width: 40px">Tanggal</th>
                        <th scope="col"style="width: 150px">Latitude</th>
                        <th scope="col"style="width: 100px">Longitude</th>
                        <th scope="col"style="width: 10px">Aksi</th>                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=0;
                      foreach ($SqlRiwayatLokasiPetugas->result() as $ptgsOnline) {
                      $no++;
                      ?>
                     <tr>
                        <th scope="row"><?=$no?></th>
                        <th scope="row"><?=$ptgsOnline->tgl?></th>
                        <th scope="row"><?=$ptgsOnline->latitude?></th>
                        <th scope="row"><?=$ptgsOnline->longitude?></th>
                        <th><center><a href="<?=base_url()?>lokasi_petugas/<?=$id_petugas?>/<?=$ptgsOnline->latitude?>/<?=$ptgsOnline->longitude?>"><button class="btn btn-warning"><i class="la la-map-marker"></i></button></a></center></th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>