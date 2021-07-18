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


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Suara Temporary</h4>
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
                        <th scope="col" style="width: 50px">No</th>
                        <th scope="col"style="width: 70px">Foto</th>
                        <th scope="col"style="width: 100px">No TPS - KODE INPUT</th>
                        <th scope="col"style="width: 100px">Pemilihan</th>
                        <th scope="col"style="width: 70px">Suara Sah</th>
                        <th scope="col"style="width: 70px">Suara Invalid</th>
                        <th scope="col"style="width: 70px">Total</th>
                        <th scope="col"style="width: 100px">Diajukan</th>
                        <th scope="col"style="width: 100px">Konfirmasi</th>
                        <th scope="col"style="width: 200px">Confirmer</th>
                        <th scope="col"style="width: 200px">Ket</th>
                        <th scope="col"style="width: 200px">Status</th>
                        <th scope="col" style="width: 250px;"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_hasil_temp','status',"OPEN")->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>assets/upload/doc_c1/<?=$row['foto_c1']?>" target="_blank"><img src="<?=base_url()?>assets/upload/doc_c1/<?=$row['foto_c1']?>" width="50px"></a></td>

                        <td><?=@$this->model_global->getDataGlobal('tb_tps','id_tps',$row['id_tps'])->row()->no_tps ." # ". $row['kode_input']?> </td>

                        <td>
                          <?php
                          if ($row['jenis_pemilihan']=="PILGUB") {
                            echo "<b style='color:#4caf50'>PILGUB</b>";
                          } else {
                            echo "<b style='color:#2196f3'>PILBUB</b>";
                          }

                          ?>

                        </td>
                        <td><?=$row['suara_valid']?></td>
                        <td><?=$row['suara_invalid']?></td>
                        <td><?=$row['total_suara']?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($row['date_create']))?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($row['date_confirm']))?></td>
                        <td><?=@$this->model_global->getDataGlobal('tb_user','id_user',$row['confirm_who'])->row()->name?></td>
                        <td><?=$row['note']?></td>
                        <td><?=$row['status']?></td>
                        <td style="width: 300px;">
                          <?php
                            if ($row['status']=='OPEN') {
                          ?>
                          <center>
                          <button class="btn btn-primary" onclick="AksiConfirm('<?=$row['id_hasil_temp']?>','CONFIRM')">CONFIRM</button>
                          <button class="btn btn-danger" onclick="AksiConfirm('<?=$row['id_hasil_temp']?>','REJECT')">REJECT</button>
                        </center>
                        <?php
                        } else {
                          echo "<center>-</center>";
                        }
                        ?>
                        </td>
                        </tr>
                          <?php } ?>

                    </tbody>
                  </table>
              </div>
            </div>


        </div>
</div>

<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Suara Live</h4>
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
                  <table class="table table-bordered" id="myTable2" style="table-layout: fixed;">
                    <thead>
                      <tr>

                        <th scope="col" style="width: 50px">No</th>
                        <th scope="col"style="width: 70px">Foto</th>
                        <th scope="col"style="width: 100px">No Tps</th>
                        <th scope="col"style="width: 100px">Pemilihan</th>
                        <th scope="col"style="width: 70px">Suara Sah</th>
                        <th scope="col"style="width: 70px">Suara Invalid</th>
                        <th scope="col"style="width: 70px">Total</th>
                        <th scope="col"style="width: 100px">Diajukan</th>
                        <th scope="col"style="width: 100px">Konfirmasi</th>
                        <th scope="col"style="width: 70px">Who</th>
                        <th scope="col"style="width: 200px">Ket</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $no=0;
                      foreach ($this->model_global->getDataGlobal('tb_hasil_live')->result_array() as $row) {
                      $no++;
                      ?>
                      <tr>
                        <th scope="row"><?=$no?></th>
                        <td><a href="<?=base_url()?>assets/upload/doc_c1/<?=$row['foto_c1']?>" target="_blank"><img src="<?=base_url()?>assets/upload/doc_c1/<?=$row['foto_c1']?>" width="50px"></a></td>
                        <td><?=@$this->model_global->getDataGlobal('tb_tps','id_tps',$row['id_tps'])->row()->no_tps?></td>
                        <td>
                          <?php
                          $qCalon=@$this->model_global->getDataGlobal('tb_calon','id_calon',$row['id_calon'])->row();
                          if ($qCalon->id_provinsi>0) {
                            echo "<b style='color:#4caf50'>PILGUB</b>";
                          } else {
                            echo "<b style='color:#2196f3'>PILBUB</b>";
                          }

                          ?>

                        </td>
                        <td><?=$row['suara_valid']?></td>
                        <td><?=$row['suara_invalid']?></td>
                        <td><?=$row['total_suara']?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($row['date_create']))?></td>
                        <td><?=date("d-m-Y H:i:s", strtotime($row['date_confirm']))?></td>
                        <td><?=@$this->model_global->getDataGlobal('tb_user','id_user',$row['confirm_who'])->row()->name?></td>
                        <td><?=$row['note']?></td>
                        </tr>
                          <?php } ?>

                    </tbody>
                  </table>
              </div>
            </div>


        </div>
</div>
<!--/ Global settings -->
<script type="text/javascript">

    $(document).ready(function () {
      $.noConflict();
      var table = $('#myTable').DataTable();
      var table2 = $('#myTable2').DataTable();
    });

      function AksiConfirm(id,status) {
        $("#pageloader").show();
        setTimeout(function() {
        var hps = new FormData();
        hps.append('id',id);
        hps.append('mode',status);
        $.ajax({
            url   :'<?=base_url()?>Utility/ConfirmQuickcount',
            method:'POST',
            contentType: false,
            processData:false,
            data  :hps,
            success: function(data) {
              $("#pageloader").hide();
              console.log(data);
              if (data=='sukses') {
                location.reload();
              } else {
                swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }

            },error: function(data){
              $("#pageloader").hide();
               console.log(data);
               swal("Informasi","Gagal Terhubung Ke Server" ,"error");
            }
        });
        }, 300);

    }

</script>
