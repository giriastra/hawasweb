<style type="text/css">
    body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #262d47 !important;*/
    background-image: url('<?=base_url()?>assets/img/sky3.jpg');
    background-size: cover;
}
.kotak {
  background: #fff;
  border-radius: 5px;
  padding: 5px;
  display: inline-block;
  height: auto;
  margin: 1rem;
  position: relative;
}

.kotak-2 {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}

.kotak-3 {
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
<?php date_default_timezone_set('Africa/Lagos'); ?>
</style>
<div class="row match-height">
    <div class="col-12">
        <div class="">
            <div id="gradient-line-chart" class="height-180" style="padding-top: 30px;"><center><img src="<?=base_url()?>assets/img/hawas_logo_new.png" width="400px;"></center></div>
        </div>
    </div>
</div>
<!-- Chart -->
<!-- eCommerce statistic -->
<div class="row">
    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1" style="text-align: center;">Jumlah Berita</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4" style="float: left;">
                                <i class="la la-newspaper-o" style="font-size: 32px;background-color: #fa626b ; border-radius: 100%;color: #fff;padding: 10px"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8" style="float: left;">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_news');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1" style="text-align: center;" >Jumlah Himbauan</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4">
                                <i class="la la-bullhorn" style="font-size: 32px;background-color: #28afd0  ; border-radius: 100%;color: #fff;padding: 10px;"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_announcement');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1" style="text-align: center;">Jumlah Pengguna</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4">
                                <i class="la la-user" style="font-size: 32px;background-color: #fdb901; border-radius: 100%;color: #fff;padding: 10px;"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_user');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1"  style="text-align: center;">Jumlah Pengaduan</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4" style="float: left;">
                                <i class="la la-exclamation-circle" style="font-size: 32px;background-color: #607d8b ; border-radius: 100%;color: #fff;padding: 10px"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8" style="float: left;">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_complaint');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1" >Jumlah Forum</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4">
                                <i class="la la-comments" style="font-size: 32px;background-color: #4caf50  ; border-radius: 100%;color: #fff;padding: 10px;"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_forum');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-6 col-md-12">
        <div class="card pull-up ecom-card-1 bg-white">
            <div class="card-content ecom-card2 height-150">
                <h5 class="text-muted position-absolute p-1" style="text-align: center;">Jumlah Partai</h5>

                <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-xl-4 col-lg-4">
                                <i class="la la-group" style="font-size: 32px;background-color: #9c27b0  ; border-radius: 100%;color: #fff;padding: 10px;"></i>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                               <span style="font-size: 40px;float: right;"><?=$this->model_global->CountGlobal('tb_partai');?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--
 <div class="col-xl-12 col-lg-12 col-md-12">

   <div class="row match-height" style="margin-top: ;">
       <div class="col-xl-6 col-lg-12">
           <div class="card">
               <div class="card-header" style="background-color: #ffae33; color: #fff;">
                   <h4 class="card-title" style="color: #fff"><i class="la la-star warning"></i> 5 Petugas Favorit</h4>
                   <a class="heading-elements-toggle">
                       <i class="fa fa-ellipsis-v font-medium-3"></i>
                   </a>
               </div>
               <div class="card-content">
                   <div id="recent-buyers" class="media-list">

                   </div>
               </div>

           </div>
       </div>

       <div class="col-xl-6 col-lg-12">
           <div class="card">
               <div class="card-header" style="background-color: #20add4 ; color: #fff;">
                   <h4 class="card-title" style="color: #fff"><i class="la la-dot-circle-o success"  style="color: #fff"></i> 5 Masyarakat Teraktif</h4>
                   <a class="heading-elements-toggle">
                       <i class="fa fa-ellipsis-v font-medium-3"></i>
                   </a>
               </div>
               <div class="card-content">
                   <div id="recent-buyers" class="media-list">

                   </div>
               </div>

           </div>
       </div>



     </div>  -->

   </div>



<?php
  if ($this->session->userdata('level_akses')=='1' || $this->session->userdata('level_akses')=='4') {
?>
    <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4 class="card-title"><i class="la la-circle success"></i> Daftar Petugas Online</h4>
                </div>
                <div class="card-body  border-top-blue-grey border-top-lighten-5" style="">
                    <a href="<?=base_url()?>lokasi_semua_petugas"><button class="btn btn-warning"><i class="la la-map-marker"></i><i class="la la-group"></i>Lokasi Petugas</button></a>
                    <a href="<?=base_url()?>semua_petugas"><button class="btn btn-info"><i class="la la-group"></i>Semua Petugas</button></a>
                    <div class="table-responsive" style="margin-top: 30px;">
                          <table class="table table-bordered" id="myTable" style="table-layout: fixed;">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 20px">No</th>
                                <th scope="col"style="width: 40px">Foto</th>
                                <th scope="col"style="width: 150px">Nama Petugas</th>
                                <th scope="col"style="width: 100px">No Handphone</th>
                                <th scope="col"style="width: 60px">Status</th>
                                <th scope="col"style="width: 120px">Last Online</th>
                                <th scope="col" style="width: 50px"><center>Aksi</center></th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              $no=0;
                              foreach ($this->model_global->ShowPetugasOnline()->result() as $ptgsOnline) {
                              $no++;
                              ?>
                              <tr>
                                <th scope="row"><?=$no?></th>
                                <td><a href="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" target="_blank"><img src="<?=base_url()?>assets/upload/user/<?=$ptgsOnline->foto?>" width="32px"></a></td>
                                <td><?=$ptgsOnline->name?></td>
                                <td><?=$ptgsOnline->phone?></td>
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
                                  <a href="<?=base_url()?>lokasi_petugas/<?=$ptgsOnline->id_user?>/<?=$ptgsOnline->latitude?>/<?=$ptgsOnline->longitude?>?status=<?=$ptgsOnline->status_online?>"><button class="btn btn-success" data-toggle="modal"><i class="la la-map-marker"></i></button></a>
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

 <?php
  }
 ?>

<!-- Statistics -->
<?php
	if ($this->session->userdata('level_akses')=='1') {
?>
<div class="row match-height" style="margin-top: ;">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: #fa626b">
                <h4 class="card-title" style="color: #fff"><i class="la la-exclamation-circle"></i> Pengaduan Terbaru</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
<!--                 <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="card-content">
                <div id="recent-buyers" class="media-list">
                    <?php foreach ($this->model_global->GetdataForComplaintDash()->result_array() as $rowCom) { ?>
                    <div class="card-body  border-top-blue-grey border-top-lighten-5" style="padding: 7px">
                    	<div class="row match-height">
                    		<div class="col-xl-3 col-lg-3">
                    			<span class="avatar avatar-md avatar-online">
                    				<center>
	                                <img class="media-object rounded-circle" src="<?=base_url()?>assets/upload/user/<?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->foto?>" alt="Generic placeholder image" style="width: 25px;">
	                                <span style="font-size: 10px;"><?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->name?></span>
	                            </center>
                            	</span>
                    		</div>
                    		<div class="col-xl-3 col-lg-3">
                    			<span style="font-size: 9px;color: #4caf50">
                    			<?php
                                    $tgl = $rowCom['date_request'];
                                    if(strlen($tgl)>3){
                                      $timestamp = strtotime($tgl);
                                      echo '<i class="la la-external-link" style="font-size:12px;"></i>'. date("d-m-Y H:i", strtotime( $tgl));
                                      // echo '<i class="la la-external-link" style="font-size:12px;"></i>'.$this->model_global->tgl_indo(date("Y-m-d", $timestamp));
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-external-link" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                            	</span>
                    		</div>
                    		<div class="col-xl-3 col-lg-3">
                    			<span style="font-size: 9px; color: #fa626b;">
                    			<?php

                                    $tgl2 = $rowCom['date_finish'];
                                    if(strlen($tgl2)>3){
                                      // $timestamp2 = strtotime($tgl2);
                                      echo '<i class="la la-sign-out" style="font-size:12px;"></i>'. date("d-m-Y H:i", strtotime( $tgl2));
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-sign-out" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                            	</span>
                    		</div>
                    		<div class="col-xl-3 col-lg-3">
                    			<span style="font-size: 9px; color: #0c108c;">
                    			<?php


                                    $tgl2 = $rowCom['date_finish'];
                                    if(strlen($tgl2)>3){

                                      $to_time = strtotime($rowCom['date_finish']);
                                      $from_time = strtotime($rowCom['date_request']);
                                      $duration =  round(abs($to_time - $from_time) / 60,0);

                                      if($duration>60){
                      									$jam = round($duration/60,0);
                      									$menit = $duration%60;
                      									$waktu = $jam."jam - ".$menit."menit";
                      								}else{
                                        $waktu = $duration." menit";
                      								}

                                      // $timestamp2 = strtotime($tgl2);
                                      echo '<i class="la la-time" style="font-size:12px;"></i>'. $waktu;
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-time" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                            	</span>
                    		</div>
                    		<?php
                    		if ($rowCom['status']=='CLOSE') {
                    			$color='red';
                    			$icon='la la-close';
                    		} elseif ($rowCom['status']=='OPEN') {
                    			$color='#2196f3';
                    			$icon='la la-clock-o';
                    		}elseif ($rowCom['status']=='APPROVED') {
                    			$color='#4caf50';
                    			$icon='la la-check';
                    		}elseif ($rowCom['status']=='REJECTED') {
                    			$color='#626e82';
                    			$icon='la la-exclamation-circle';
                    		} else {
                    			$color='#f44336';
                    			$icon='la la-close';
                    		}
                    		?>

                    		<?php
                    			if ($rowCom['status']=='CLOSE') {
                      			$pesanRatting='<i class="ft ft-message-square"></i> '.$rowCom['message_rating'];

                    		?>

                    		<!-- <div class="col-xl-4 col-lg-4" style="margin-top: 5px;">
                    			<span style="font-size: 11px; font-weight: bold;color: #607d8b"><i class="la la-envelope" style="font-size: 14px;"></i> Layanannya</span>
                    		</div> -->
                    		<div class="col-xl-8 col-lg-8" style="margin-top: 5px;">
                    			<?=$pesanRatting?>
                    		</div>
                    		<?php
                    		} else {
                    		$pesanRatting='';
                    		?>
                    		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;">

                    		</div>
                    		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;">

                    		</div>
                    		<?php
                    		}
                    		?>
                    		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;">
                    			<span style="font-size: 9px;background-color: <?=$color?>; border-radius: 10px; color: #fff;padding: 3px 8px;font-weight: bold;"><i class="<?=$icon?>" style="font-size: 10px;"></i> <?=$rowCom['status']?></span>
                    		</div>

                        <div class="col-xl-12 col-lg-12" style="margin-top: 5px;">

                        <?php
                    			if (strlen($rowCom['value_rating'])>0){
                            for ($x = 0; $x <= $rowCom['value_rating']-1; $x++) {
                                ?>
                                <span><i class="la la-star warning" style="font-size: 15px"></i></span>
                        <?php
                          }
                    		}
                    		?>
                        </div>
                    	</div>
                    </div>
                     <?php } ?>

                </div>
            </div>
             <!-- <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                <a href="<?=base_url()?>berita">Data Selengkapnya <i class="la la-toggle-right"></i></a>
            </div> -->
        </div>
    </div>

    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: #0a8029">
                <h4 class="card-title" style="color: #fff"><i class="la la-exclamation-circle"></i> Forum Terbaru</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
<!--                 <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="card-content">
                <div id="recent-buyers" class="media-list">
                    <?php foreach ($this->model_global->GetdataForForumDash()->result_array() as $rowCom) { ?>
                    <div class="card-body  border-top-blue-grey border-top-lighten-5" style="padding: 7px">
                    	<div class="row match-height">
                    		<div class="col-xl-3 col-lg-3">
                    			<span class="avatar avatar-md avatar-online">
                    				<center>
	                                <img class="media-object rounded-circle" src="<?=base_url()?>assets/upload/user/<?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->foto?>" alt="Generic placeholder image" style="width: 25px;">
	                                <span style="font-size: 10px;"><?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->name?></span>
	                            </center>
                            	</span>
                    		</div>
                    		<div class="col-xl-3 col-lg-3">
                    			<span style="font-size: 9px;color: #4caf50">
                    			<?php
                                    $tgl = $rowCom['date_create'];
                                    if(strlen($tgl)>3){
                                      $timestamp = strtotime($tgl);
                                      echo '<i class="la la-external-link" style="font-size:12px;"></i>'. date("d-m-Y H:i", strtotime( $tgl));
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-external-link" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                            	</span>
                    		</div>
                    		<div class="col-xl-3 col-lg-3">
                    			<span style="font-size: 9px; color: #fa626b;">
                    			<?php
                                    $tgl2 = $rowCom['date_close'];
                                    if(strlen($tgl2)>3){
                                      // $timestamp2 = strtotime($tgl2);
                                      echo '<i class="la la-sign-out" style="font-size:12px;"></i>'. date("d-m-Y H:i", strtotime( $tgl2));
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-sign-out" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                            	</span>
                    		</div>

                        <div class="col-xl-3 col-lg-3">
                          <span style="font-size: 9px; color: #0c108c;">
                          <?php


                                    $tgl2 = $rowCom['date_close'];
                                    if(strlen($tgl2)>3){

                                      $to_time = strtotime($rowCom['date_create']);
                                      $from_time = strtotime($rowCom['date_close']);
                                      $duration =  round(abs($to_time - $from_time) / 60,0);

                                      if($duration>60){
                                        $jam = round($duration/60,0);
                                        $menit = $duration%60;
                                        $waktu = $jam."jam - ".$menit."menit";
                                      }else{
                                        $waktu = $duration." menit";
                                      }

                                      // $timestamp2 = strtotime($tgl2);
                                      echo '<i class="la la-clock" style="font-size:12px;"></i>'. $waktu;
                                      echo "&nbsp;";
                                    }else{
                                      echo '<i class="la la-clock" style="font-size:12px;"></i> - ';
                                    }

                                ?>
                              </span>
                        </div>

                    		<?php
                          		if ($rowCom['status']=='CLOSE') {
                          			$color='red';
                          			$icon='la la-close';
                          		} elseif ($rowCom['status']=='OPEN') {
                          			$color='#2196f3';
                          			$icon='la la-clock-o';
                          		}elseif ($rowCom['status']=='APPROVED') {
                          			$color='#4caf50';
                          			$icon='la la-check';
                          		}elseif ($rowCom['status']=='REJECTED') {
                          			$color='#626e82';
                          			$icon='la la-exclamation-circle';
                          		} else {
                          			$color='#f44336';
                          			$icon='la la-close';
                          		}
                    		?>

                    		<?php
                    			if ($rowCom['status']=='CLOSE') {
                      			$pesanRatting='<i class="ft ft-message-square"></i> '.$rowCom['title'];
                    		?>
                            		<div class="col-xl-8 col-lg-8" style="margin-top: 5px;">
                            			<?=$pesanRatting?>
                            		</div>
                    		<?php
                    		} else {

                        		?>

                        		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;"></div>
                        		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;"></div>
                        		<?php
                    		}
                    		?>
                    		<div class="col-xl-4 col-lg-4" style="margin-top: 5px;">
                    			<span style="font-size: 9px;background-color: <?=$color?>; border-radius: 10px; color: #fff;padding: 3px 8px;font-weight: bold;"><i class="<?=$icon?>" style="font-size: 10px;"></i> <?=$rowCom['status']?></span>
                    		</div>


                        <?php

                    		?>

                    	</div>
                    </div>
                     <?php } ?>

                </div>
            </div>
             <!-- <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                <a href="<?=base_url()?>berita">Data Selengkapnya <i class="la la-toggle-right"></i></a>
            </div> -->
        </div>
    </div>

    </div>


<div class="row match-height" style="margin-top: ;">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header" style="background-color: #28afd0; color: #fff;">
                    <h4 class="card-title" style="color: #fff"><i class="la la-newspaper-o"></i> Berita Terbaru</h4>
                    <!-- <h6 class="card-subtitle text-muted">Carousel Card With Header & Footer</h6> -->
                </div>
                <?php foreach ($this->model_global->GetdataForDashboard('tb_news','id_news','5')->result_array() as $rowDS) {
                ?>
                <div class="card-body  border-top-blue-grey border-top-lighten-5" style="padding:10px;">
                    <h5 class="card-title" style="text-transform: uppercase; color: #000; font-size:12px;font-weight:bold;"><?=$rowDS['title']?></h5>
                    <h6 class="card-subtitle text-muted">
                        <?php
                            $tgl = $rowDS['create_date'];
                            $timestamp = strtotime($tgl);
                            echo '<i class="la la-calendar"></i> '.$this->model_global->tgl_indo(date("Y-m-d", $timestamp));
                            echo "&nbsp;";
                        ?>
                        <div style="float: right;">
                        <?php
                            $jam = $rowDS['create_date'];
                            $timestamp2 = strtotime($jam);
                            echo '<i class="la la-clock-o"></i> '.date("H:i:s", $timestamp2);
                        ?>
                    </div>
                    </h6>
                </div>
                <?php } ?>
            </div>
           <!--  <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                <a href="<?=base_url()?>berita">Data Selengkapnya <i class="la la-toggle-right"></i></a>
            </div> -->
        </div>
    </div>

    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: #fdb901">
                <h4 class="card-title" style="color: #fff"><i class="la la-comments"></i> Komentar Terbaru</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
<!--                 <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="card-content">
                <div id="recent-buyers" class="media-list" style="padding:3px">
                    <?php foreach ($this->model_global->GetdataForDashboard('tb_news_comment','id_comment','5')->result_array() as $rowCom) { ?>
                    <a href="#" class="media border-0 " style="padding:inherit" >
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object rounded-circle" src="<?=base_url()?>assets/upload/user/<?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->foto?>" alt="image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading"> <?=$this->model_global->getDataGlobal('tb_user','id_user',$rowCom['id_user'])->row()->name?>

                            </span>
                            <div class="list-unstyled users-list m-0 float-right" style="font-size: 9px;">

                                    <?php
                                        $tgl = $rowCom['date'];
                                        $timestamp = strtotime($tgl);
                                        echo ''.$this->model_global->tgl_indo(date("Y-m-d", $timestamp));
                                        echo "&nbsp;";
                                    ?>
                            </div>
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"><i class="la la-comments"></i> " <?=substr($rowCom['comment'], 0,150)?> " </span>
                            </p>
                            <p class="card-title" style="color: #000;text-transform: uppercase;font-size: 10px;margin-bottom: 0px"> <i class="la la-newspaper-o"></i>
                            <?=$this->model_global->getDataGlobal('tb_news','id_news',$rowCom['id_news'])->row()->title?>                     </p>

                        </div>
                    </a>
                     <?php } ?>

                </div>
            </div>
             <!-- <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted" style="cursor: pointer;"> -->
                <!-- <a href="<?=base_url()?>complaint">Data Selengkapnya <i class="la la-toggle-right"></i></a> -->
            </div>
        </div>
    </div>




</div>
</div>
<?php
}
?>

 <script>$(document).ready(function () {
    $.noConflict();
    var table = $('#myTable').DataTable();
});</script>
